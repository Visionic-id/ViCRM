<?php

use yii\db\Migration;

/**
 * Class m220425_054607_users
 */
class m220425_054607_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id'=>$this->primaryKey(),
            'username'=>$this->char(100)->unique(),
            'email'=>$this->char(100)->unique(),
            'password_hash'=>$this->text(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220425_054607_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220425_054607_users cannot be reverted.\n";

        return false;
    }
    */
}
