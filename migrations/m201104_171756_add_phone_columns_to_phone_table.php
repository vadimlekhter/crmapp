<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%phone}}`.
 */
class m201104_171756_add_phone_columns_to_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%phone}}', 'home_number', $this->string());
        $this->addColumn('{{%phone}}', 'work_number', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%phone}}', 'home_number');
        $this->dropColumn('{{%phone}}', 'work_number');
    }
}
