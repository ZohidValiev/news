<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 11:51
 */

namespace app\modules\news\domain\repositories;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;

interface IRubricRepository
{
    /**
     * @throws DomainNotFoundException
     */
    function findById(int $id): Rubric;

    /**
     * @param array $ids
     * @return array
     */
    function findAllByIds(array $ids): array;

    function findChildrenIdsById(int $id): array;
}