<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 02.10.2020
 * Time: 12:04
 */

namespace app\modules\news;


use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $rules = [
            [
                'class' => \yii\rest\UrlRule::class,
                'pluralize' => false,
                'controller' => [
                    'news/rubric',
                ],
                'extraPatterns' => [
                    'GET {id}/news' => 'news',
                    'GET {id}/news-grid' => 'news-grid',
                ]
            ],
            [
                'class' => \yii\rest\UrlRule::class,
                'pluralize' => false,
                'controller' => [
                    'news/news',
                ]
            ],
        ];

        $app->getUrlManager()->addRules($rules);
    }
}