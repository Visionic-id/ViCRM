<?php

use yii\db\Migration;

/**
 * Class m220425_073607_user_seed
 */
class m220425_073607_user_seed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'id'=>1,
            'username'=>'admin',
            'password_hash'=>Yii::$app->security->generatePasswordHash('vfr4bgt5'),
            'email'=>'admin@example.com',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220425_073607_user_seed cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220425_073607_user_seed cannot be reverted.\n";

        return false;
    }
    */
}
