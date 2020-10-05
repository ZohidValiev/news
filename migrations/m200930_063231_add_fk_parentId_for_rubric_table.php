<?php

use yii\db\Migration;

/**
 * Class m200930_063231_add_fk_parentId_for_rubric_table
 */
class m200930_063231_add_fk_parentId_for_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $table = '{{%rubric}}';
        $this->addForeignKey('fk_parentId', $table, 'parentId', $table, 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $table = '{{%rubric}}';
        $this->dropForeignKey('fk_parentId', $table);
    }
}
