<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_address".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 *
 * @property EmailMailboxAddress[] $emailMailboxAddresses
 */
class EmailAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'string', 'max' => 250],
            [['address'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[EmailMailboxAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailMailboxAddresses()
    {
        return $this->hasMany(EmailMailboxAddress::className(), ['email_address_id' => 'id']);
    }
}
