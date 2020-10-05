<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 01.10.2020
 * Time: 19:23
 */

use yii\helpers\Json;
use app\modules\news\assets\NewsAsset2;

NewsAsset2::register($this);

/**
 * @var yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var $rubricId int
 * @var $links array
 */
?>

<div>
    <div id="grid-container" class="grid-container" data-rubricId="<?= $rubricId ?>" data-links='<?= Json::encode($links) ?>'>
        <table id="news-grid" class="grid-container__table c-grid grid">
            <thead>
            <tr class="c-grid__head-row">
                <th class="grid__cell-ix">#</th>
                <th class="grid__cell-title">Название</th>
                <th class="grid__cell-content">Описание</th>
            </tr>
            </thead>
            <tbody>
                <?php if (!empty($models)): ?>
                    <?php foreach($models as $ix => $news): ?>
                        <?= $this->render('_grid-row', ['ix' => $ix, 'news' => $news]) ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr class="c-grid__row">
                        <td colspan="3"></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <div id="loader-container" class="grid-container_loader grid-loader">
            <img id="loader" class="loader" src="/images/ajax-loader.gif">
        </div>
    </div>
</div>
