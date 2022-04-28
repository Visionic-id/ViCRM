<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_mailbox_address".
 *
 * @property int $id
 * @property int|null $type
 * @property int|null $email_mailbox_id
 * @property int|null $email_address_id
 *
 * @property EmailAddress $emailAddress
 * @property EmailMailbox $emailMailbox
 */
class EmailMailboxAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_mailbox_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'email_mailbox_id', 'email_address_id'], 'integer'],
            [['email_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmailAddress::className(), 'targetAttribute' => ['email_address_id' => 'id']],
            [['email_mailbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmailMailbox::className(), 'targetAttribute' => ['email_mailbox_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'email_mailbox_id' => 'Email Mailbox ID',
            'email_address_id' => 'Email Address ID',
        ];
    }

    /**
     * Gets query for [[EmailAddress]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAddress()
    {
        return $this->hasOne(EmailAddress::className(), ['id' => 'email_address_id']);
    }

    /**
     * Gets query for [[EmailMailbox]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailMailbox()
    {
        return $this->hasOne(EmailMailbox::className(), ['id' => 'email_mailbox_id']);
    }
}
