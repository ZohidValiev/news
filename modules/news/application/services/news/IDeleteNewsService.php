<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 11:41
 */

namespace app\modules\news\application\services\news;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\News;

interface IDeleteNewsService
{
    /**
     * @param int $id
     * @return News
     * @throws DomainNotFoundException
     */
    function execute(int $id): News;
}