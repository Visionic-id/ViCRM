<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_mailbox".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $mid
 * @property string|null $date
 * @property string|null $subject
 * @property string|null $fromName
 * @property string|null $fromAddress
 * @property string|null $toString
 * @property string|null $textPlain
 * @property string|null $textHtml
 * @property string|null $messageId
 * @property int|null $is_read
 * @property string|null $read_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property EmailMailboxAddress[] $emailMailboxAddresses
 * @property User $user
 */
class EmailMailbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_mailbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'mid', 'is_read'], 'integer'],
            [['date', 'read_at', 'created_at', 'updated_at'], 'safe'],
            [['toString', 'textPlain', 'textHtml'], 'string'],
            [['subject', 'fromName', 'fromAddress', 'messageId'], 'string', 'max' => 250],
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
            'mid' => 'Mid',
            'date' => 'Date',
            'subject' => 'Subject',
            'fromName' => 'From Name',
            'fromAddress' => 'From Address',
            'toString' => 'To String',
            'textPlain' => 'Text Plain',
            'textHtml' => 'Text Html',
            'messageId' => 'Message ID',
            'is_read' => 'Is Read',
            'read_at' => 'Read At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[EmailMailboxAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailMailboxAddresses()
    {
        return $this->hasMany(EmailMailboxAddress::className(), ['email_mailbox_id' => 'id']);
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
}
