<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 01.10.2020
 * Time: 20:52
 */

/**
 * @var $models array
 * @var $offset int
 */
?>

<?php foreach($models as $ix => $news): ?>
    <?= $this->render('_grid-row', ['ix' => $offset + $ix, 'news' => $news]) ?>
<?php endforeach ?>
