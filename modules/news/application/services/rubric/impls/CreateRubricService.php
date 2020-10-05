<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 11:40
 */

namespace app\modules\news\application\services\rubric\impls;


use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\Rubric;
use app\modules\news\domain\services\rubric\ICreateRubricChildService;
use app\modules\news\domain\services\rubric\ICreateRubricRootService;
use app\modules\news\application\services\BaseService;
use app\modules\news\application\services\rubric\ICreateRubricService;
use app\modules\news\domain\repositories\IRubricRepository;

class CreateRubricService extends BaseService implements ICreateRubricService
{
    private $_rubricRepository;
    private $_rubricCreateRootService;
    private $_rubricCreateChildService;

    /**
     * CreateRubricService constructor.
     * @param $rubricCreateRootService
     * @param $rubricCreateChildService
     */
    public function __construct(
        IRubricRepository $rubricRepository,
        ICreateRubricRootService $rubricCreateRootService,
        ICreateRubricChildService $rubricCreateChildService)
    {
        $this->_rubricRepository = $rubricRepository;
        $this->_rubricCreateRootService = $rubricCreateRootService;
        $this->_rubricCreateChildService = $rubricCreateChildService;
    }


    /**
     * @param int $parentId
     * @param string $title
     * @return Rubric
     * @throws DomainNotFoundException
     */
    function execute(int $parentId, string $title): Rubric
    {
        return $this->transaction(function() use ($parentId, $title) {
            if ($parentId > 0) {
                return $this->_createChild($parentId, $title);
            } else {
                return $this->_createRoot($title);
            }
        });
    }

    private function _createRoot(string $title): Rubric
    {
        return $this->_rubricCreateRootService->execute($title);
    }

    private function _createChild(int $parentId, string $title): Rubric
    {
        $parentRubric = $this->_rubricRepository->findById($parentId);
        return $this->_rubricCreateChildService->execute($parentRubric, $title);
    }
}