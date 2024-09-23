<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $due_date
 * @property integer $status
 * @property integer $priority
 * @property integer $created_at
 */
class Task extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title', 'description'], 'string'],
            [['due_date', 'status', 'priority', 'created_at'], 'integer'],
        ];
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'due_date' => 'Дедлайн',
            'status' => 'Статус',
            'priority' => 'Приоритет',
            'created_at' => 'Создано',
        ];
    }
}