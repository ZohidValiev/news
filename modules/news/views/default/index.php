<?php

use app\modules\news\assets\NewsAsset;

/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 18:55
 */

NewsAsset::register($this);

?>
<div>
    <div id="grid-container" class="grid-container">
        <table id="news-grid" class="grid-container__table c-grid grid">
            <thead>
            <tr class="c-grid__head-row">
                <th class="grid__cell-ix">#</th>
                <th class="grid__cell-title">Название</th>
                <th class="grid__cell-content">Описание</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div id="loader-container" class="grid-container_loader grid-loader">
            <img id="loader" class="loader" src="/images/ajax-loader.gif">
        </div>
    </div>

    <script id="template" type="template">
        <tr class="c-grid__row">
            <td id="_ix" class="c-grid__cell-center"></td>
            <td id="_title"></td>
            <td id="_content"></td>
        </tr>
    </script>
</div>