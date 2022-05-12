<?php

namespace app\modules\url\migrations;

use yii\db\Migration;

/**
 * Class m220512_053024_url_shortener
 */
class m220512_053024_url_shortener extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('url_shortener', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'short_url' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createTable('url_shortener_log', [
            'id' => $this->primaryKey(),
            'url_shortener_id' => $this->integer()->notNull(),
            'user_agent' => $this->string(255)->notNull(),
            'ip' => $this->string(255)->notNull(),
            'browser' => $this->string(255)->notNull(),
            'platform' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->addForeignKey(
            'fk_url_shortener_id', 'url_shortener_log', 'url_shortener_id', 'url_shortener', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_053024_url_shortener cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220512_053024_url_shortener cannot be reverted.\n";

        return false;
    }
    */
}
