<?php

namespace app\modules\news\domain\models;

/**
 * This is the model class for table "{{%rubric}}".
 *
 * @property int $id
 * @property string $title
 * @property int|null $parentId
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rubric}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentId'], 'integer'],
            [['title'], 'string', 'max' => 50],
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
            'parentId' => 'Parent ID',
        ];
    }

    public function createRelation(Rubric $parentRubric = null): RubricRelation
    {
        $relation = new RubricRelation();
        $relation->rubricId = $this->id;

        if ($parentRubric) {
            $relation->parentId = $parentRubric->id;
        } else {
            $relation->parentId = $this->id;
        }

        return $relation;
    }

    public function getChildren()
    {
        return $this->hasMany(Rubric::class, ['parentId' => 'id']);
    }

    public function getAncestors()
    {
        return $this
            ->hasMany(Rubric::class, ['id' => 'parentId'])
            ->via('relations');
    }

    public function getRelations()
    {
        return $this->hasMany(RubricRelation::class, ['rubricId' => 'id']);
    }
}
