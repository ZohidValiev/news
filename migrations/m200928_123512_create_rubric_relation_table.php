<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rubric_relation}}`.
 */
class m200928_123512_create_rubric_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%rubric_relation}}';

        $this->createTable($table, [
            'rubricId' => $this->integer(10)->notNull()->unsigned(),
            'parentId' => $this->integer(10)->notNull()->unsigned(),
        ], 'engine=InnoDB');

        $this->addPrimaryKey('pk_rubric_relation', $table, ['rubricId', 'parentId']);
        $this->addForeignKey('fk_rubricId', $table, 'rubricId', '{{%rubric}}', 'id', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric_relation}}');
    }
}
