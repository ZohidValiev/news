<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 28.09.2020
 * Time: 20:00
 */

namespace app\modules\news\domain\services\rubric;


use app\modules\news\domain\models\Rubric;

interface ICreateRubricRootService
{
    function execute(string $title): Rubric;
}