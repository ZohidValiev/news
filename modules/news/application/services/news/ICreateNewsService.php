<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 17:02
 */

namespace app\modules\news\application\services\news;


use app\modules\news\domain\dto\NewsDto;
use app\modules\news\domain\models\News;

interface ICreateNewsService
{
    function execute(NewsDto $dto, array $rubricIds): News;
}