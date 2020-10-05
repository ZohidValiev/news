<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 12:01
 */

namespace app\modules\news\domain\repositories\impls;


use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\RubricRelation;
use app\modules\news\domain\repositories\IRubricRepository;

class RubricRepository implements IRubricRepository
{

    /**
     * @param int $id
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function findById(int $id): Rubric
    {
        $rubric = $id > 0 ? Rubric::findOne($id) : null;

        if (!$rubric) {
            throw new DomainNotFoundException("Рубрика не найдена.");
        }

        return $rubric;
    }

    function findAllByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        return Rubric::findAll([
            'id' => $ids,
        ]);
    }

    function findChildrenIdsById(int $id): array
    {
        return RubricRelation::find()
            ->select('rubricId')
            ->where(['parentId' => $id])
            ->column();
    }

}