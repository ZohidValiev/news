<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 18:10
 */

namespace app\modules\news\forms;


use app\modules\news\domain\dto\NewsDto;
use yii\base\Model;
use yii\helpers\HtmlPurifier;

class NewsForm extends Model
{
    const SCENARIO_CREATE = 'CREATE';
    const SCENARIO_UPDATE = 'UPDATE';

    public $title;
    public $content;
    public $rubrics;

    public function rules()
    {
        return [
            [
                ['title', 'content'],
                'required',
                'message' => 'Введите значение',
                'on' => [
                    self::SCENARIO_CREATE,
                    self::SCENARIO_UPDATE
                ],
            ],
            [
                ['title'],
                'filter',
                'filter' => function($value) {
                    return strip_tags($value);
                },
                'on' => [
                    self::SCENARIO_CREATE,
                    self::SCENARIO_UPDATE
                ],
            ],
            [
                ['content'],
                'filter',
                'filter' => function($value) {
                    return HtmlPurifier::process($value);
                },
                'on' => [
                    self::SCENARIO_CREATE,
                    self::SCENARIO_UPDATE
                ],
            ],
            [
                'title',
                'string',
                'min' => 1,
                'max' => 100,
                'tooShort' => 'Введите значение',
                'tooLong' => 'Введите не более 100 символов',
                'on' => [
                    self::SCENARIO_CREATE,
                    self::SCENARIO_UPDATE
                ],
            ],
            [
                'rubrics',
                'required',
                'message' => 'Задайте рубрики',
                'on' => [
                    self::SCENARIO_CREATE
                ],
            ],
            [
                'rubrics',
                'validateRubrics',
                'on' => [
                    self::SCENARIO_CREATE
                ],
            ],
        ];
    }

    public function validateRubrics($attribute, $params)
    {
        if (!is_array($this->rubrics)) {
            $this->addError('rubrics', 'Рубрики должны быть массивом целочисленных занчений.');
            return;
        }

        $validRubricsIds = [];
        foreach ($this->rubrics as $rubricId) {
            $rubricId = (integer) $rubricId;
            if (is_integer($rubricId) && $rubricId > 0) {
                $validRubricsIds[] = $rubricId;
            }
        }

        if (empty($validRubricsIds)) {
            $this->addError('rubrics', 'Рубрики должны быть массивом целочисленных занчений.');
        }

        $this->rubrics = $validRubricsIds;
    }

    public function getDto(): NewsDto
    {
        $dto = new NewsDto();
        $dto->title   = $this->title;
        $dto->content = $this->content;

        return $dto;
    }
}