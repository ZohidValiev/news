<?php

namespace app\modules\news;

use app\modules\news\application\services as applicationServices;
use app\modules\news\domain\services as domainServices;
use app\modules\news\domain\repositories as domainRepositories;
use Yii;

/**
 * news module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\news\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->_initDI();
    }

    private function _initDI()
    {
        Yii::$container->setSingletons([
            // define application services
            applicationServices\rubric\IRubricQueryService::class =>
                applicationServices\rubric\impls\RubricQueryService::class,
            applicationServices\rubric\ICreateRubricService::class =>
                applicationServices\rubric\impls\CreateRubricService::class,
            applicationServices\rubric\IUpdateRubricService::class =>
                applicationServices\rubric\impls\UpdateRubricService::class,
            applicationServices\rubric\IDeleteRubricService::class =>
                applicationServices\rubric\impls\DeleteRubricService::class,

            applicationServices\news\INewsQueryService::class =>
                applicationServices\news\impls\NewsQueryService::class,
            applicationServices\news\ICreateNewsService::class =>
                applicationServices\news\impls\CreateNewsService::class,
            applicationServices\news\IUpdateNewsService::class =>
                applicationServices\news\impls\UpdateNewsService::class,
            applicationServices\news\IDeleteNewsService::class =>
                applicationServices\news\impls\DeleteNewsService::class,

            // define domain services
            domainServices\rubric\ICreateRubricRootService::class =>
                domainServices\rubric\impls\CreateRubricRootService::class,
            domainServices\rubric\ICreateRubricChildService::class =>
                domainServices\rubric\impls\CreateRubricChildService::class,

            domainServices\news\ICreateNewsService::class =>
                domainServices\news\impls\CreateNewsService::class,
            domainServices\news\IUpdateNewsService::class =>
                domainServices\news\impls\UpdateNewsService::class,


            // define domain repositories
            domainRepositories\IRubricRepository::class =>
                domainRepositories\impls\RubricRepository::class,

            domainRepositories\INewsRepository::class =>
                domainRepositories\impls\NewsRepository::class
        ]);
    }
}
