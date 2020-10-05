<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 17:22
 */

namespace app\modules\news\domain\services\news\impls;


use app\modules\news\domain\dto\NewsDto;
use app\modules\news\domain\models\News;
use app\modules\news\domain\services\news\IUpdateNewsService;

class UpdateNewsService implements IUpdateNewsService
{
    function execute(News $news, NewsDto $dto): void
    {
        $news->title = $dto->title;
        $news->update(false);

        $news->content->content = $dto->content;
        $news->content->update(false);
    }
}