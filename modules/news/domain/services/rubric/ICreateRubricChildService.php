<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 28.09.2020
 * Time: 20:18
 */

namespace app\modules\news\domain\services\rubric;


use app\modules\news\domain\models\Rubric;

interface ICreateRubricChildService
{
    function execute(Rubric $parentRubric, string $title): Rubric;
}