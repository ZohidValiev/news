<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 10:42
 */

namespace app\modules\news\application\services;

use Yii;

abstract class BaseService
{
    protected function transaction(callable $callback, $isolationLevel = null)
    {
        return Yii::$app->db->transaction($callback, $isolationLevel);
    }
}