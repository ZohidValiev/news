<?php

namespace app\modules\news\domain\models;
use app\modules\news\domain\exceptions\DomainException;


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


    /**
     * @throws DomainException
     */
    private function _checkPersistentState()
    {
        if ($this->isNewRecord) {
            $class = static::class;
            throw new DomainException("Объект класса $class должен быть сохраненной сущностью");
        }
    }

    public function assignToRubrics(array $rubrics): array
    {
        $this->_checkPersistentState();

        if (empty($rubric)) {
            throw new \InvalidArgumentException('Аргумент $rubrics не должен быть пустым массивом.');
        }

        $relations = [];
        foreach($rubrics as $rubric){
        	$relations[] = $this->assignToRubric($rubric);
        }

        return $relations;
    }

    public function assignToRubric(Rubric $rubric): RubricNews
    {
        $this->_checkPersistentState();

        if ($rubric->isNewRecord) {
            throw new \InvalidArgumentException('Аргумент $rubric должен быть сохраненной сущностью.');
        }

        $relation = new RubricNews();
        $relation->rubricId = $rubric->id;
        $relation->newsId   = $this->id;
        $relation->insert(false);

        return $relation;
    }

    public function getContent()
    {
        return $this->hasOne(NewsContent::class, ['newsId' => 'id']);
    }
}
