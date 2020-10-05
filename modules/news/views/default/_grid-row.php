<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 01.10.2020
 * Time: 19:28
 */

/**
 * @var $news \app\modules\news\domain\models\News
 * @var $ix int
 */
?>

<tr class="c-grid__row">
    <td class="c-grid__cell-center">
        <?= $ix + 1 ?>
    </td>
    <td>
        <?= $news->title ?>
    </td>
    <td>
        <?= $news->content->content?>
    </td>
</tr>
