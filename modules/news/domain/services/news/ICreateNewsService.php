<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:50
 */

namespace app\modules\news\domain\services\news;


use app\modules\news\domain\models\News;
use app\modules\news\domain\dto\NewsDto;

interface ICreateNewsService
{
    function execute(NewsDto $dto, array $rubrics): News;
}