<?php

namespace app\modules\email\models;

use app\models\User;
use Yii;
use yii\web\UnauthorizedHttpException;

/**
 * This is the model class for table "email_user_setting".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $value
 *
 * @property User $user
 */
class EmailUserSetting extends \yii\db\ActiveRecord
{
    const SET_FROM_EMAIL_ADDRESS = 'from_email_address';
    const SET_FROM_NAMA_PENGIRIM = 'nama_pengirim';

    // INCOMING
    const SET_IMAP_HOST = 'imap_host';
    const SET_IMAP_EMAIL_ADDRESS = 'imap_email_address';
    const SET_IMAP_EMAIL_PASSWORD = 'imap_email_password';
    const SET_IMAP_PORT = 'imap_port';

    // SMPTP ( Out Going )
    const SET_SMTP_HOST = 'smtp_host';
    const SET_SMTP_EMAIL_ADDRESS = 'smtp_email_address';
    const SET_SMTP_EMAIL_PASSWORD = 'smtp_email_password';
    const SET_SMTP_PORT = 'smtp_port';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_user_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name'], 'required'],
            [['value'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public static function getSettingUser($name, $user = null){
        if($user == null){
            $user = Yii::$app->user->identity;
        }

        if(!$user)
            throw new UnauthorizedHttpException('Anda tidak memilik hak akses halaman ini. Silahkan login dahulu,');

        $setting = self::findOne([
            'user_id'=>$user->id,
            'name'=>$name
        ]);

        return $setting ? $setting->value : null;
    }

    public static function setSettingUser($name, $value = null, $user = null){
        if($user == null){
            $user = Yii::$app->user->identity;
        }

        if(!$user)
            throw new UnauthorizedHttpException('Anda tidak memilik hak akses halaman ini. Silahkan login dahulu,');

        $setting = self::findOne([
            'user_id'=>$user->id,
            'name'=>$name
        ]);

        if($setting) {
            $setting->value = $value;
            $setting->save();
        }
    }

    public static function getAndSetSettingUser($name, $value = null, $user = null){
        if($user == null){
            $user = Yii::$app->user->identity;
        }

        if(!$user)
            throw new UnauthorizedHttpException('Anda tidak memilik hak akses halaman ini. Silahkan login dahulu,');

        $setting = self::findOne([
            'user_id'=>$user->id,
            'name'=>$name
        ]);

        if(!$setting){
            $setting = new EmailUserSetting();
            $setting->user_id= $user->id;
            $setting->name = $name;
            $setting->value = $value;
            $setting->save();
        }

        return $setting->value;
    }
}
