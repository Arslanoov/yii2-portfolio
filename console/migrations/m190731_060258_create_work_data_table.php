<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_data}}`.
 */
class m190731_060258_create_work_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_data}}', [
            'id' => $this->primaryKey(),
            'work_id' => $this->integer()->notNull(),
            'lang_id' => $this->integer()->notNull(),
            'content' => $this->text()
        ]);

        $this->addForeignKey('{{%fk-work_data-work_id}}', '{{%work_data}}', 'work_id', '{{%portfolio_works}}', 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('{{%idx-work_data-work_id}}', '{{%work_data}}', 'work_id');

        $this->addForeignKey('{{%fk-work_data-lang_id}}', '{{%work_data}}', 'lang_id', '{{%languages}}', 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('{{%idx-work_data-lang_id}}', '{{%work_data}}', 'lang_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-work_data-work_id}}', '{{%work_data}}');
        $this->dropIndex('{{%idx-work_data-work_id}}', '{{%work_data}}');

        $this->dropForeignKey('{{%fk-work_data-lang_id}}', '{{%work_data}}');
        $this->dropIndex('{{%idx-work_data-lang_id}}', '{{%work_data}}');

        $this->dropTable('{{%work_data}}');
    }
}
