<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 11:57
 */

namespace app\modules\news\application\services\rubric\impls;


use app\modules\news\application\services\BaseService;
use app\modules\news\application\services\rubric\IDeleteRubricService;
use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\repositories\IRubricRepository;

class DeleteRubricService extends BaseService implements IDeleteRubricService
{
    private $_rubricRepository;

    /**
     * DeleteRubricService constructor.
     * @param $rubricRepository
     */
    public function __construct(IRubricRepository $rubricRepository)
    {
        $this->_rubricRepository = $rubricRepository;
    }

    /**
     * @inheritdoc
     */
    function execute(int $id): Rubric
    {
        return $this->transaction(function() use ($id) {
            $rubric = $this->_rubricRepository->findById($id);

            $rubric->delete();

            return $rubric;
        });
    }
}