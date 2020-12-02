<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%service}}`.
 */
class m201124_082431_add_created_at_column_and_add_updated_at_column_to_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%service}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%service}}', 'updated_at', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%service}}', 'created_at');
        $this->dropColumn('{{%service}}', 'updated_at');
    }
}
