<?php
namespace  app\modules\email\migrations;

use yii\db\Migration;

/**
 * Class m220425_074400_email_init_table
 */
class m220425_074400_email_init_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('email_general_setting',[
            'id'=>$this->primaryKey(),
            'name'=>$this->char(200)->notNull()->unique(),
            'value'=>$this->text(),
        ]);

        $this->createTable('email_user_setting', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(),
            'name'=>$this->char(200)->notNull()->unique(),
            'value'=>$this->text(),
        ]);



        $this->createTable('email_user_folder', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(),
            'name'=>$this->char(200)->notNull()
        ]);

        $this->addForeignKey(
            'fk-email_user_setting-user_id',
            'email_user_setting',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('email_address', [
            'id'=>$this->primaryKey(),
            'name'=>$this->char(250),
            'address'=>$this->char(250)->unique(),
        ]);

        $this->createTable('email_mailbox', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(),
            'mid'=>$this->integer(),
            'date'=>$this->date(),
            'subject'=>$this->char(250),
            'fromName'=>$this->char(250),
            'fromAddress'=>$this->char(250),
            'toString'=>'LONGTEXT',
            'textPlain'=>'LONGTEXT',
            'textHtml'=>'LONGTEXT',
            'messageId'=>$this->char(250),
            'is_read'=>$this->integer()->defaultValue(0),
            'read_at'=>$this->dateTime()->null(),
            'created_at'=>$this->dateTime(), // Sync time
            'updated_at'=>$this->dateTime(),
        ]);
        $this->addForeignKey(
            'fk-email_mailbox-user_id',
            'email_mailbox',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('email_mailbox_address', [
            'id'=>$this->primaryKey(),
            'type'=>$this->integer(), // 0 => to, 1 => cc, 2 => replyTo
            'email_mailbox_id'=>$this->integer(),
            'email_address_id'=>$this->integer(),
        ]);

        $this->addForeignKey(
            'fk-email_mailbox_address-email_address_id',
            'email_mailbox_address',
            'email_address_id',
            'email_address',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-email_mailbox_address-email_mailbox_id',
            'email_mailbox_address',
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
        echo "m220425_074400_email_init_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220425_074400_email_init_table cannot be reverted.\n";

        return false;
    }
    */
}
