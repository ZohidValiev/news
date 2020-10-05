<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 11:56
 */

namespace app\modules\news\application\services\rubric;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;

interface IDeleteRubricService
{
    /**
     * @param int $id
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function execute(int $id): Rubric;
}