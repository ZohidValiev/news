<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 16:30
 */

namespace app\modules\news\application\services\rubric\impls;


use app\modules\news\application\services\rubric\IRubricQueryService;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\repositories\IRubricRepository;

class RubricQueryService implements IRubricQueryService
{
    private $_rubricRepository;

    /**
     * RubricQueryService constructor.
     * @param $rubricRepository
     */
    public function __construct(IRubricRepository $rubricRepository)
    {
        $this->_rubricRepository = $rubricRepository;
    }

    /**
     * @param int $id
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function findById(int $id): Rubric
    {
        return $this->_rubricRepository->findById($id);
    }

    function findChildrenIdsById(int $id): array
    {
        return $this->_rubricRepository->findChildrenIdsById($id);
    }

}