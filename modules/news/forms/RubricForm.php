<?php
/**
 * Created by PhpStorm.
 * User: Zohid
 * Date: 29.09.2020
 * Time: 13:37
 */

namespace app\modules\news\forms;


use yii\base\Model;

class RubricForm extends Model
{
    public $title;

    public function rules()
    {
        return [
            [
                ['title'],
                'required',
                'message' => 'Введите значение',
            ],
            [
                ['title'],
                'filter',
                'filter' => function($value) {
                    return strip_tags($value);
                },
            ],
            [
                ['title'],
                'string',
                'min' => 1,
                'max' => 50,
                'tooShort' => 'Введите значение',
                'tooLong' => 'Введите не болле 50 символов',
            ],
        ];
    }
}