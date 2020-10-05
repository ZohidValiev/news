<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 28.09.2020
 * Time: 20:19
 */

namespace app\modules\news\domain\services\rubric\impls;


use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\services\rubric\ICreateRubricChildService;

class CreateRubricChildService implements ICreateRubricChildService
{
    function execute(Rubric $parentRubric, string $title): Rubric
    {
        // create child rubric
        $rubric = new Rubric();
        $rubric->title = $title;
        $rubric->parentId = $parentRubric->id;
        $rubric->save(false);

        // create relations
        $ancestors = $parentRubric->ancestors;
        $ancestors[] = $rubric;
        $relations = [];
        foreach ($ancestors as $ancestor) {
            $relation = $rubric->createRelation($ancestor);
            $relation->save(false);
            $relations[] = $relation;
        }

        $rubric->populateRelation('relations', $relations);

        return $rubric;
    }
}