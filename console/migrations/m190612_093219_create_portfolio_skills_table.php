<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio_skills}}`.
 */
class m190612_093219_create_portfolio_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio_skills}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%portfolio_skills}}');
    }
}
