<?php

namespace app\modules\news\domain\models;

/**
 * This is the model class for table "{{%news_content}}".
 *
 * @property int $newsId
 * @property string|null $content
 */
class NewsContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['newsId', 'content'], 'required'],
            [['newsId'], 'integer'],
            [['content'], 'string'],
            [['newsId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'newsId' => 'News ID',
            'content' => 'Content',
        ];
    }

    public function fields()
    {
        return [
            'content',
        ];
    }
}
