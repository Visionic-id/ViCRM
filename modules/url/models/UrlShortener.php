<?php

namespace app\modules\url\models;

use Yii;

/**
 * This is the model class for table "url_shortener".
 *
 * @property int $id
 * @property string $url
 * @property string $short_url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UrlShortenerLog[] $urlShortenerLogs
 */
class UrlShortener extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_shortener';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'short_url'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['url', 'short_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'short_url' => 'Short Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[UrlShortenerLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrlShortenerLogs()
    {
        return $this->hasMany(UrlShortenerLog::className(), ['url_shortener_id' => 'id']);
    }
}
