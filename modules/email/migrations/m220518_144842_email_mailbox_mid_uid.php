<?php
namespace app\modules\email\migrations;

use yii\db\Migration;

/**
 * Class m220518_144842_email_mailbox_mid_uid
 */
class m220518_144842_email_mailbox_mid_uid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('email_mailbox', 'mid', 'uid');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220518_144842_email_mailbox_mid_uid cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_144842_email_mailbox_mid_uid cannot be reverted.\n";

        return false;
    }
    */
}
