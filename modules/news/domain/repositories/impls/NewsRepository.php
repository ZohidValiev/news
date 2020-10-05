<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:59
 */

namespace app\modules\news\domain\repositories\impls;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\News;
use app\modules\news\domain\models\RubricNews;
use app\modules\news\domain\repositories\INewsRepository;
use yii\db\ActiveQueryInterface;

class NewsRepository implements INewsRepository
{
    function createQueryByRubricIds(array $rubricIds): ActiveQueryInterface
    {
        return News::find()
            ->innerJoin(RubricNews::tableName(), 'newsId = id')
            ->with('content')
            ->where(['rubricId' => $rubricIds]);
    }

    function findAllByIds(array $ids): array
    {
        return News::findAll(['id' => $ids]);
    }

    function findById(int $id): News
    {
        $news = null;

        if ($id > 0) {
            $news = News::find()
                ->with('content')
                ->where(['id' => $id])
                ->one();
        }

        if (!$news) {
            throw new DomainNotFoundException("Новость не найдена.");
        }

        return $news;
    }

    function findAllByRubricIds(array $rubricIds): array
    {
        if (empty($rubricIds)) {
            return [];
        }

        $newsIds = $this->findNewsIdsByRubricIds($rubricIds);

        if (empty($newsIds)) {
            return [];
        }

        return News::findAll(['id' => $newsIds]);
    }

    function getCountByRubricIds(array $rubricIds): int
    {
        return RubricNews::find()
            ->where(['rubricId' => $rubricIds])
            ->count();
    }

    function findNewsIdsByRubricIds(array $rubricIds, int $offset = 0, int $limit = 0)
    {
        $query = RubricNews::find()
            ->select('newsId')
            ->where(['rubricId' => $rubricIds]);

        if ($offset > 0) {
            $query->offset($offset);
        }

        if ($limit > 0) {
            $query->limit($limit);
        }

        return $query->column();
    }
}