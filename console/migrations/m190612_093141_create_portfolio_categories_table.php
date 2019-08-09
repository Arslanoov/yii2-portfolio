<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio_categories}}`.
 */
class m190612_093141_create_portfolio_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL'
        ]);

        $this->createIndex('{{%idx-portfolio_works-category_id}}', '{{%portfolio_works}}', 'category_id');
        $this->addForeignKey('{{%fk-portfolio_works-category_id}}', '{{%portfolio_works}}', 'category_id', '{{%portfolio_categories}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-portfolio_works-category_id}}', '{{%portfolio_works}}');

        $this->dropTable('{{%portfolio_categories}}');
    }
}
