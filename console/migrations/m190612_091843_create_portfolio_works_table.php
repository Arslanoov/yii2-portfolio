<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio_works}}`.
 */
class m190612_091843_create_portfolio_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio_works}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()->unsigned(),
            'link' => $this->string()->notNull()->defaultValue('#'),
            'slug' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'client' => $this->string(),
            'photo' => $this->string(),
            'meta_json' => 'JSON NOT NULL',
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%portfolio_works}}');
    }
}
