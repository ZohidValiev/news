<?php

namespace app\modules\news\domain\models;


/**
 * This is the model class for table "{{%rubric_relation}}".
 *
 * @property int $rubricId
 * @property int $parentId
 */
class RubricRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rubric_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rubricId', 'parentId'], 'required'],
            [['rubricId', 'parentId'], 'integer'],
            [['rubricId', 'parentId'], 'unique', 'targetAttribute' => ['rubricId', 'parentId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rubricId' => 'Rubric ID',
            'parentId' => 'Parent ID',
        ];
    }
}
