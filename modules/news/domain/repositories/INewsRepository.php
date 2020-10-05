<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:58
 */

namespace app\modules\news\domain\repositories;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\News;
use yii\db\ActiveQueryInterface;

interface INewsRepository
{

    /**
     * @param array $rubricIds
     * @return ActiveQueryInterface
     */
    function createQueryByRubricIds(array $rubricIds): ActiveQueryInterface;

    /**
     * @param array $ids
     * @return array
     */
    function findAllByIds(array $ids): array;

    /**
     * @param int $id
     * @return News
     * @throws DomainNotFoundException
     */
    function findById(int $id): News;

    /**
     * @param array $rubricIds
     * @return array
     */
    function findAllByRubricIds(array $rubricIds): array;

    /**
     * @param array $rubricIds
     * @return int
     */
    function getCountByRubricIds(array $rubricIds): int;

    /**
     * @param array $rubricIds
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    function findNewsIdsByRubricIds(array $rubricIds, int $offset = 0, int $limit = 0);
}