<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 10:40
 */

namespace app\modules\news\application\services\rubric;


use app\modules\news\domain\models\Rubric;

interface ICreateRubricService
{
    function execute(int $parentId, string $title): Rubric;
}