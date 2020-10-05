<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 17:03
 */

namespace app\modules\news\application\services\news\impls;


use app\modules\news\application\services\BaseService;
use app\modules\news\application\services\news\ICreateNewsService;
use app\modules\news\domain\dto\NewsDto;
use app\modules\news\domain\models\News;
use app\modules\news\domain\repositories\IRubricRepository;
use app\modules\news\domain\services\news as newsServices;

class CreateNewsService extends BaseService implements ICreateNewsService
{
    private $_rubricRepository;
    private $_createNewsService;

    /**
     * CreateNewsService constructor.
     * @param $_createNewsService
     */
    public function __construct(
        IRubricRepository $rubricRepository,
        newsServices\ICreateNewsService $createNewsService)
    {
        $this->_rubricRepository = $rubricRepository;
        $this->_createNewsService = $createNewsService;
    }


    function execute(NewsDto $dto, array $rubcricIds): News
    {
        return $this->transaction(function() use ($dto, $rubcricIds) {
            $rubrics = $this->_rubricRepository->findAllByIds($rubcricIds);

            return $this->_createNewsService->execute($dto, $rubrics);
        });
    }

}