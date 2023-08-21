<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_lesson}}`.
 */
class m230821_000841_create_user_lesson_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_lesson}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'lesson_id' => $this->integer()->notNull(),
            'status' => $this->boolean()->notNull()->defaultValue(0)
        ]);

        $this->createIndex(
            'idx-user_lesson-user_id',
            'user_lesson',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_lesson-user_id',
            'user_lesson',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_lesson-lesson_id',
            'user_lesson',
            'lesson_id'
        );

        $this->addForeignKey(
            'fk-user_lesson-lesson_id',
            'user_lesson',
            'lesson_id',
            'lesson',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_lesson-user_id',
            'user_lesson'
        );

        $this->dropIndex(
            'idx-user_lesson-user_id',
            'user_lesson'
        );

        $this->dropForeignKey(
            'fk-user_lesson-lesson_id',
            'user_lesson'
        );

        $this->dropIndex(
            'idx-user_lesson-lesson_id',
            'user_lesson'
        );

        $this->dropTable('{{%user_lesson}}');
    }
}
