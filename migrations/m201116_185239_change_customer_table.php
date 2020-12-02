<?php

use yii\db\Migration;

/**
 * Class m201116_185239_change_customer_table
 */
class m201116_185239_change_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%customer}}', 'birth_date', 'datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%customer}}', 'birth_date', 'date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201116_185239_change_customer_table cannot be reverted.\n";

        return false;
    }
    */
}
