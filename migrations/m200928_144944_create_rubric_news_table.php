<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rubric_news}}`.
 */
class m200928_144944_create_rubric_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%rubric_news}}';

        $this->createTable($table, [
            'rubricId' => $this->integer(10)->notNull()->unsigned(),
            'newsId' => $this->integer(10)->notNull()->unsigned(),
        ], 'engine=InnoDB');

        $this->addPrimaryKey('pk_rubricId_newsid', $table, ['rubricId', 'newsId']);
        $this->createIndex('ix_newsId_rubricId', $table, ['newsId', 'rubricId']);
        $this->addForeignKey('fk_rubricId_', $table, 'rubricId', '{{%rubric}}', 'id', 'restrict');
        $this->addForeignKey('fk_newsId_', $table, 'newsId', '{{%news}}', 'id', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric_news}}');
    }
}
