<?php

namespace app\modules\url\models;

use Yii;

/**
 * This is the model class for table "url_shortener_log".
 *
 * @property int $id
 * @property int $url_shortener_id
 * @property string $user_agent
 * @property string $ip
 * @property string $browser
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $os
 * @property string|null $device
 * @property string|null $engine
 *
 * @property UrlShortener $urlShortener
 */
class UrlShortenerLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_shortener_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url_shortener_id', 'user_agent', 'ip', 'browser'], 'required'],
            [['url_shortener_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_agent', 'ip', 'browser'], 'string', 'max' => 255],
            [['os', 'device', 'engine'], 'string', 'max' => 45],
            [['url_shortener_id'], 'exist', 'skipOnError' => true, 'targetClass' => UrlShortener::className(), 'targetAttribute' => ['url_shortener_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_shortener_id' => 'Url Shortener ID',
            'user_agent' => 'User Agent',
            'ip' => 'Ip',
            'browser' => 'Browser',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'os' => 'Os',
            'device' => 'Device',
            'engine' => 'Engine',
        ];
    }

    /**
     * Gets query for [[UrlShortener]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrlShortener()
    {
        return $this->hasOne(UrlShortener::className(), ['id' => 'url_shortener_id']);
    }
}
