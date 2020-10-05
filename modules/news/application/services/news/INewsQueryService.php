<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 19:45
 */

namespace app\modules\news\application\services\news;


use app\modules\news\domain\models\News;
use yii\db\ActiveQueryInterface;

interface INewsQueryService
{
    function createQueryByRubricIds(array $rubricIds): ActiveQueryInterface;

    /**
     * @param array $ids
     * @return array
     */
    function findAllByIds(array $ids): array;

    /**
     * @param int $id
     * @return News
     */
    function findById(int $id): News;

    /**
     * @param int $rubricId
     * @return array
     */
    function findAllByRubricId(int $rubricId): array;
}