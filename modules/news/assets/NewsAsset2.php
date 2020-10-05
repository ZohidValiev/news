<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 30.09.2020
 * Time: 19:10
 */

namespace app\modules\news\assets;


use yii\web\AssetBundle;

class NewsAsset2 extends AssetBundle
{
    public $sourcePath = '@app/modules/news/web';

    public $js = [
        'js/news-grid2.js',
    ];

    public $css = [
        'css/grid.css',
        'css/style.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}