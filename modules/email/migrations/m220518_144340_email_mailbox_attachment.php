<?php
namespace app\modules\email\migrations;

use yii\db\Migration;

/**
 * Class m220518_144340_email_mailbox_attachment
 */
class m220518_144340_email_mailbox_attachment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('email_mailbox_attachment', [
            'id'=>$this->primaryKey(),
            'email_mailbox_id'=>$this->integer(),
            'uid'=>$this->bigInteger(),
            'name'=>$this->char(250),
            'filePath'=>$this->text()
        ]);

        $this->addForeignKey(
            'fk-email_mailbox_attachment-email_mailbox_id',
            'email_mailbox_attachment',
            'email_mailbox_id',
            'email_mailbox',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220518_144340_email_mailbox_attachment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_144340_email_mailbox_attachment cannot be reverted.\n";

        return false;
    }
    */
}
