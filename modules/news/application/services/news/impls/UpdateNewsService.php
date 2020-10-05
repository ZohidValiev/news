<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 17:07
 */

namespace app\modules\news\application\services\news\impls;


use app\modules\news\application\services\BaseService;
use app\modules\news\application\services\news\IUpdateNewsService;
use app\modules\news\domain\dto\NewsDto;
use app\modules\news\domain\models\News;
use app\modules\news\domain\repositories\INewsRepository;
use app\modules\news\domain\services\news as newsServices;

class UpdateNewsService extends BaseService implements IUpdateNewsService
{
    private $_newsRepository;
    private $_updateNewsService;

    /**
     * UpdateNewsService constructor.
     * @param $_newsRepository
     */
    public function __construct(
        INewsRepository $newsRepository,
        newsServices\IUpdateNewsService $updateNewsService)
    {
        $this->_newsRepository = $newsRepository;
        $this->_updateNewsService = $updateNewsService;
    }


    function execute(int $id, NewsDto $dto): News
    {
        return $this->transaction(function() use ($id, $dto) {
            $news = $this->_newsRepository->findById($id);

            $this->_updateNewsService->execute($news, $dto);

            return $news;
        });
    }

}