<?php

namespace app\modules\news\domain\models;

/**
 * This is the model class for table "{{%rubric_news}}".
 *
 * @property int $rubricId
 * @property int $newsId
 *
 * @property News $news
 * @property Rubric $rubric
 */
class RubricNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rubric_news}}';
    }

    public function getNews()
    {
        return $this->hasOne(News::class, ['id' => 'newsId']);
    }
}
