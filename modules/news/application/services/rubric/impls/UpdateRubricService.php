<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 14:00
 */

namespace app\modules\news\application\services\rubric\impls;


use app\modules\news\application\services\BaseService;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\repositories\IRubricRepository;
use app\modules\news\application\services\rubric\IUpdateRubricService;

class UpdateRubricService extends BaseService implements IUpdateRubricService
{
    private $_rubricRepository;

    /**
     * UpdateRubricService constructor.
     * @param $rubricRepository
     */
    public function __construct(IRubricRepository $rubricRepository)
    {
        $this->_rubricRepository = $rubricRepository;
    }


    /**
     * @param int $id
     * @param string $title
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function execute(int $id, string $title): Rubric
    {
        return $this->transaction(function() use ($id, $title) {
            $rubric = $this->_rubricRepository->findById($id);

            $rubric->title = $title;
            $rubric->update(false);

            return  $rubric;
        });
    }
}