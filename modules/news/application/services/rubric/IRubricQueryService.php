<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:28
 */

namespace app\modules\news\application\services\rubric;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;

interface IRubricQueryService
{
    /**
     * @param int $id
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function findById(int $id): Rubric;

    /**
     * @param $id
     * @return array
     */
    function findChildrenIdsById(int $id): array;
}