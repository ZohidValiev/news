<?php

namespace app\modules\news\domain\models;


/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function extraFields()
    {
        return [
            'content',
        ];
    }

    public function createRubricRelation(Rubric $rubric): RubricNews
    {
        $relation = new RubricNews();
        $relation->rubricId = $rubric->id;
        $relation->newsId   = $this->id;

        return $relation;
    }

    public function getContent()
    {
        return $this->hasOne(NewsContent::class, ['newsId' => 'id']);
    }
}
