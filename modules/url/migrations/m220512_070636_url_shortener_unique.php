<?php

namespace app\modules\url\migrations;

use yii\db\Migration;

/**
 * Class m220512_070636_url_shortener_unique
 */
class m220512_070636_url_shortener_unique extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('url_shortener', 'short_url', $this->string(255)->unique());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_070636_url_shortener_unique cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220512_070636_url_shortener_unique cannot be reverted.\n";

        return false;
    }
    */
}
