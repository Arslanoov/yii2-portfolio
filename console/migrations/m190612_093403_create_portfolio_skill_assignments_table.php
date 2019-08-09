<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio_skill_assignments}}`.
 */
class m190612_093403_create_portfolio_skill_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio_skill_assignments}}', [
            'work_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-portfolio_skill_assignments}}', '{{%portfolio_skill_assignments}}', ['work_id', 'skill_id']);

        $this->createIndex('{{%idx-portfolio_skill_assignments-work_id}}', '{{%portfolio_skill_assignments}}', 'work_id');
        $this->createIndex('{{%idx-portfolio_skill_assignments-skill_id}}', '{{%portfolio_skill_assignments}}', 'skill_id');

        $this->addForeignKey('{{%fk-portfolio_skill_assignments-work_id}}', '{{%portfolio_skill_assignments}}', 'work_id', '{{%portfolio_works}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-portfolio_skill_assignments-skill_id}}', '{{%portfolio_skill_assignments}}', 'skill_id', '{{%portfolio_skills}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-portfolio_skill_assignments-work_id}}', '{{%portfolio_skill_assignments}}');
        $this->dropForeignKey('{{%fk-portfolio_skill_assignments-skill_id}}', '{{%portfolio_skill_assignments}}');

        $this->dropTable('{{%portfolio_skill_assignments}}');
    }
}
