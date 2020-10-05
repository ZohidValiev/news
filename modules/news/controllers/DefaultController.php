<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 18:54
 */

namespace app\modules\news\controllers;


use app\modules\news\application\services\news\INewsQueryService;
use app\modules\news\application\services\rubric\IRubricQueryService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNewsGrid(
        INewsQueryService $newsQueryService,
        IRubricQueryService $rubricQueryService)
    {
        $id = 1;

        $rubricIds = $rubricQueryService->findChildrenIdsById($id);

        $dataProvider = new ActiveDataProvider([
            'query' => $newsQueryService->createQueryByRubricIds($rubricIds),
            'pagination' => [
                'pageSize' => 22,
            ],
        ]);

        $models = $dataProvider->getModels();
        $links  = $dataProvider->getPagination()->getLinks();
        $links  = ArrayHelper::filter($links, ['next']);

        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $offset = $dataProvider->getPagination()->getOffset();

            return [
                '_links' => $links,
                'content' => $this->renderPartial('_ajax-grid-rows', [
                    'models' => $models,
                    'offset' => $offset,
                ]),
            ];
        }

        return $this->render('news-grid', [
            'models' => $models,
            'links' => $links,
            'rubricId' => $id,
        ]);
    }
}