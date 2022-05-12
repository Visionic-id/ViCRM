<?php
namespace app\modules\url\migrations;

use yii\db\Migration;

/**
 * Class m220512_090845_url_shortener_log_new_colom
 */
class m220512_090845_url_shortener_log_new_colom extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('url_shortener_log', 'os', $this->string(45));
        $this->addColumn('url_shortener_log', 'device', $this->string(45));
        $this->addColumn('url_shortener_log', 'engine', $this->string(45));
        $this->dropColumn('url_shortener_log', 'platform');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_090845_url_shortener_log_new_colom cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220512_090845_url_shortener_log_new_colom cannot be reverted.\n";

        return false;
    }
    */
}
