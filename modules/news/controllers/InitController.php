<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 18:03
 */

namespace app\modules\news\controllers;


use app\modules\news\application\services\news\ICreateNewsService;
use app\modules\news\application\services\rubric\ICreateRubricService;
use app\modules\news\domain\dto\NewsDto;
use yii\helpers\Url;
use yii\web\Controller;

class InitController extends Controller
{
    public function actionInit(ICreateRubricService $createRubricService, ICreateNewsService $createNewsService)
    {
        $rubrics = [
            [
                'title' => 'Общество',
                'children' => [
                    [
                        'title' => 'Городская жизнь',
                        'news'  => $this->_buildNewsArray(),
                    ],
                    [ 'title' => 'Выборы' ],
                ],
            ],
            [
                'title' => 'День города',
                'children' => [
                    [ 'title' => 'Салюты' ],
                    [ 'title' => 'Детская площадка' ],
                ],
            ],
            [
                'title' => '0-3 года',
            ],
            [
                'title' => '3-7 года',
            ],
            [
                'title' => 'Спорт',
            ],
        ];

        foreach ($rubrics as $rubric) {
            $_rubric = $createRubricService->execute(0, $rubric['title']);

            if (isset($rubric['children'])) {
                foreach ($rubric['children'] as $childRubric) {
                    $_childRubric = $createRubricService->execute($_rubric->id, $childRubric['title']);

                    if (isset($childRubric['news'])) {
                        foreach ($childRubric['news'] as $news) {
                            $dto = new NewsDto();
                            $dto->title = $news['title'];
                            $dto->content = $news['content'];
                            $createNewsService->execute($dto, [$_childRubric->id]);
                        }
                    }
                }
            }
        }

        return $this->redirect(Url::home());
    }

    private function _buildNewsArray()
    {
        $max = 50;
        $result = [];

        $ix = 0;

        while(++$ix <= $max) {
            $result[] = [
                'title' => str_repeat($ix, 4),
                'content' => str_repeat($ix, 4) . ' ' . str_repeat($ix, 4),
            ];
        }

        return $result;
    }
}