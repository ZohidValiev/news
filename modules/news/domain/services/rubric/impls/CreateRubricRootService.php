<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 28.09.2020
 * Time: 20:02
 */

namespace app\modules\news\domain\services\rubric\impls;


use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\services\rubric\ICreateRubricRootService;

class CreateRubricRootService implements ICreateRubricRootService
{
    function execute(string $title): Rubric
    {
        $rubric = new Rubric();
        $rubric->title = $title;
        $rubric->save(false);

        $relation = $rubric->createRelation();
        $relation->save(false);
        $rubric->populateRelation('relations', [$relation]);

        return $rubric;
    }
}