<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m240923_055612_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'due_date' => $this->integer(),
            'status' => $this->tinyInteger()->defaultValue(0),
            'priority' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
