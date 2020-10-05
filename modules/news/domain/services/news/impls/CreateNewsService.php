<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:52
 */

namespace app\modules\news\domain\services\news\impls;


use app\modules\news\domain\models\News;
use app\modules\news\domain\models\NewsContent;
use app\modules\news\domain\services\news\ICreateNewsService;
use app\modules\news\domain\dto\NewsDto;

class CreateNewsService implements ICreateNewsService
{
    function execute(NewsDto $dto, array $rubrics): News
    {
        if (empty($rubrics)) {
            throw new \InvalidArgumentException("Argument rubrics connot be empty array.");
        }

        $news = new News();
        $news->title = $dto->title;
        $news->insert(false);

        $content = new NewsContent();
        $content->newsId  = $news->id;
        $content->content = $dto->content;
        $content->insert(false);
        $news->populateRelation('content', $content);

        foreach ($rubrics as $rubric) {
            $relation = $news->createRubricRelation($rubric);
            $relation->insert(false);
        }

        return $news;
    }
}