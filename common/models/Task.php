<?php

namespace common\models;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $due_date
 * @property integer $status
 * @property integer $priority
 * @property integer $created_at
 * @property integer $updated_at
 */
class Task
{
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['title', 'description'], 'string'],
            [['due_date', 'status', 'priority', 'created_at', 'updated_at'], 'integer'],
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
            'updated_at' => 'Обновлено',
        ];
    }
}