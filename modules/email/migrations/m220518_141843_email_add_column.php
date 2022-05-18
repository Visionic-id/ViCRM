<?php
namespace app\modules\email\migrations;
use yii\db\Migration;

/**
 * Class m220518_141843_email_add_column
 */
class m220518_141843_email_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('email_mailbox', 'references', $this->char(250));
        $this->addColumn('email_mailbox', 'in_reply_to', $this->char(250));
        $this->addColumn('email_mailbox', 'size', $this->bigInteger());
        $this->addColumn('email_mailbox', 'msgno', $this->bigInteger());
        $this->addColumn('email_mailbox', 'recent', $this->integer());
        $this->addColumn('email_mailbox', 'flagged', $this->integer());
        $this->addColumn('email_mailbox', 'answered', $this->integer());
        $this->addColumn('email_mailbox', 'deleted', $this->integer());
        $this->addColumn('email_mailbox', 'seen', $this->integer());
        $this->addColumn('email_mailbox', 'draft', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220518_141843_email_add_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_141843_email_add_column cannot be reverted.\n";

        return false;
    }
    */
}
