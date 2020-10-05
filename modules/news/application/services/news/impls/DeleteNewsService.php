<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 11:43
 */

namespace app\modules\news\application\services\news\impls;


use app\modules\news\application\services\BaseService;
use app\modules\news\application\services\news\IDeleteNewsService;
use app\modules\news\domain\models\News;
use app\modules\news\domain\repositories\INewsRepository;

class DeleteNewsService extends BaseService implements IDeleteNewsService
{
    private $_newsRepository;

    /**
     * DeleteNewsService constructor.
     * @param $_newsRepository
     */
    public function __construct(INewsRepository $newsRepository)
    {
        $this->_newsRepository = $newsRepository;
    }


    /**
     * @inheritdoc
     */
    function execute(int $id): News
    {
        return $this->transaction(function() use ($id) {
            $news = $this->_newsRepository->findById($id);

            $news->delete();

            return $news;
        });
    }
}