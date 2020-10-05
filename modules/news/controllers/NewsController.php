<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 18:08
 */

namespace app\modules\news\controllers;


use app\modules\news\application\services\news\ICreateNewsService;
use app\modules\news\application\services\news\IDeleteNewsService;
use app\modules\news\application\services\news\INewsQueryService;
use app\modules\news\application\services\news\IUpdateNewsService;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\forms\NewsForm;
use Yii;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class NewsController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'index'  => ['GET'],
            'view'   => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PUTCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionView($id, INewsQueryService $newsQueryService)
    {
        try {
            return $newsQueryService->findById($id);
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }
    }

    public function actionCreate(ICreateNewsService $createNewsService)
    {
        $request = Yii::$app->request;
        $form = new NewsForm([
            'scenario' => NewsForm::SCENARIO_CREATE
        ]);
        $form->load($request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $news = $createNewsService->execute($form->getDto(), $form->rubrics);

                $response = Yii::$app->response;
                $response->setStatusCode(201);
                $response->headers->set('Location', Url::toRoute(['view', 'id' => $news->id], true));

                return $news;
            } catch (\Exception $e) {
                throw new ServerErrorHttpException("Произошла ошибка на сервере.");
            }
        }

        return $form;
    }

    public function actionUpdate(int $id, IUpdateNewsService $updateNewsService)
    {
        $request = Yii::$app->request;
        $form = new NewsForm([
            'scenario' => NewsForm::SCENARIO_UPDATE
        ]);
        $form->load($request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                return $updateNewsService->execute($id, $form->getDto());
            } catch (DomainNotFoundException $e) {
                throw new NotFoundHttpException($e->getMessage());
            } catch (\Exception $e) {
                throw new ServerErrorHttpException("Произошла ошибка на сервере.");
            }
        }

        return $form;
    }

    public function actionDelete(int $id, IDeleteNewsService $deleteNewsService)
    {
        try {
            $deleteNewsService->execute($id);
        } catch (DomainNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }

        Yii::$app->response->setStatusCode(204);
    }
}