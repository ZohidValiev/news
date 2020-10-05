<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_content}}`.
 */
class m200928_124609_create_news_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%news_content}}';

        $this->createTable($table, [
            'newsId' => $this->integer(10)->notNull()->unsigned(),
            'content' => $this->text(),
        ], 'engine=InnoDB');

        $this->addPrimaryKey('pk_news_content', $table, 'newsId');
        $this->addForeignKey('fk_newsId', $table, 'newsId', '{{%news}}', 'id', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_content}}');
    }
}
