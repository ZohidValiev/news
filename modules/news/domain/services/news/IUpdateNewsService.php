<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 17:21
 */

namespace app\modules\news\domain\services\news;


use app\modules\news\domain\dto\NewsDto;
use app\modules\news\domain\models\News;

interface IUpdateNewsService
{
    function execute(News $news, NewsDto $dto): void;
}