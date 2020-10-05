<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 19:46
 */

namespace app\modules\news\application\services\news\impls;


use app\modules\news\application\services\news\INewsQueryService;
use app\modules\news\domain\exceptions\DomainNotFoundException;
use app\modules\news\domain\models\News;
use app\modules\news\domain\repositories\INewsRepository;
use app\modules\news\domain\repositories\IRubricRepository;
use yii\db\ActiveQueryInterface;

class NewsQueryService implements INewsQueryService
{
    private $_newsRepository;
    private $_rubricRepository;

    /**
     * NewsQueryService constructor.
     * @param $_newsRepository
     */
    public function __construct(
        INewsRepository $newsRepository,
        IRubricRepository $rubricRepository)
    {
        $this->_newsRepository = $newsRepository;
        $this->_rubricRepository = $rubricRepository;
    }

    function createQueryByRubricIds(array $rubricIds): ActiveQueryInterface
    {
        return $this->_newsRepository->createQueryByRubricIds($rubricIds);
    }


    function findAllByIds(array $ids): array
    {
        return $this->_newsRepository->findAllByIds($ids);
    }

    /**
     * @param int $id
     * @return News
     * @throws DomainNotFoundException
     */
    function findById(int $id): News
    {
        return $this->_newsRepository->findById($id);
    }

    function findAllByRubricId(int $rubricId): array
    {
        $rubricChildrenIds = $this->_rubricRepository->findChildrenIdsById($rubricId);

        return $this->_newsRepository->findAllByRubricIds($rubricChildrenIds);
    }
}