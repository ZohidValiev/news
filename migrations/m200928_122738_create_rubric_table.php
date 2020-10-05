<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rubric}}`.
 */
class m200928_122738_create_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%rubric}}';

        $this->createTable($table, [
            'id' => $this->primaryKey(10)->notNull()->unsigned(),
            'title' => $this->string(50)->notNull(),
            'parentId' => $this->integer(10)->null()->unsigned(),
        ], 'engine=InnoDB');

        $this->createIndex('ix_parentId', $table, 'parentId');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric}}');
    }
}
