<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%customer}}`
 */
class m201027_212935_create_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phone}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->unique(),
            'number' => $this->string()->notNull(),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-phone-customer_id}}',
            '{{%phone}}',
            'customer_id'
        );

        // add foreign key for table `{{%customer}}`
        $this->addForeignKey(
            '{{%fk-phone-customer_id}}',
            '{{%phone}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%customer}}`
        $this->dropForeignKey(
            '{{%fk-phone-customer_id}}',
            '{{%phone}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-phone-customer_id}}',
            '{{%phone}}'
        );

        $this->dropTable('{{%phone}}');
    }
}
