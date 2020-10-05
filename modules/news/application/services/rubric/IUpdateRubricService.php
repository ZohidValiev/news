<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 14:00
 */

namespace app\modules\news\application\services\rubric;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;

interface IUpdateRubricService
{
    /**
     * @param int $id
     * @param string $title
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function execute(int $id, string $title): Rubric;
}