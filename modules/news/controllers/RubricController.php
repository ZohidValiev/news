<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 12:32
 */

namespace app\modules\news\controllers;


use app\modules\news\application\services\news\INewsQueryService;
use app\modules\news\application\services\rubric\ICreateRubricService;
use app\modules\news\application\services\rubric\IDeleteRubricService;
use app\modules\news\application\services\rubric\IRubricQueryService;
use app\modules\news\application\services\rubric\IUpdateRubricService;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\forms\RubricForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class RubricController extends Controller
{
    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'news-grid' => ['GET'],
            'news'   => ['GET'],
            'view'   => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PUTCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionNewsGrid(
        int $id,
        INewsQueryService $newsQueryService,
        IRubricQueryService $rubricQueryService)
    {
        try {
            $rubricIds = $rubricQueryService->findChildrenIdsById($id);

            return new ActiveDataProvider([
                'query' => $newsQueryService->createQueryByRubricIds($rubricIds),
                'pagination' => [
                    'pageSize' => 22,
                ],
            ]);
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }
    }

    public function actionNews(int $id, INewsQueryService $newsQueryService)
    {
        try {
            return $newsQueryService->findAllByRubricId($id);
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }
    }

    public function actionView(int $id, IRubricQueryService $rubricQueryService)
    {
        try {
            return $rubricQueryService->findById($id);
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }
    }

    public function actionCreate(ICreateRubricService $createRubricService)
    {
        $request  = Yii::$app->request;
        $parentId = $request->getBodyParam('parentId', 0);
        $form     = new RubricForm([
            'title' => $request->getBodyParam('title'),
        ]);

        if ($form->validate()) {
            try {
                $rubric = $createRubricService->execute($parentId, $form->title);

                $response = Yii::$app->response;
                $response->setStatusCode(201);
                $response->headers->set('Location', Url::toRoute(['view', 'id' => $rubric->id], true));

                return $rubric;
            } catch (DomainNotFoundException $e) {
                throw new NotFoundHttpException($e->getMessage());
            } catch (\Exception $e) {
                throw new ServerErrorHttpException("Произошла ошибка на сервере.");
            }
        }

        return $form;
    }

    public function actionUpdate(int $id, IUpdateRubricService $updateRubricService)
    {
        $request = Yii::$app->request;
        $form    = new RubricForm([
            'title' => $request->getBodyParam('title'),
        ]);

        if ($form->validate()) {
            try {
                return $updateRubricService->execute($id, $form->title);
            } catch (DomainNotFoundException $e) {
                throw new NotFoundHttpException($e->getMessage());
            } catch (\Exception $e) {
                throw new ServerErrorHttpException("Произошла ошибка на сервере.");
            }
        }

        return $form;
    }

    public function actionDelete(int $id, IDeleteRubricService $deleteRubricService)
    {
        try {
            $deleteRubricService->execute($id);
        } catch (DomainNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        } catch (\Exception $e) {
            throw new ServerErrorHttpException("Произошла ошибка на сервере.");
        }

        Yii::$app->response->setStatusCode(204);
    }
}