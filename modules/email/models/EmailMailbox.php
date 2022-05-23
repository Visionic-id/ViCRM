<?php

namespace app\modules\email\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "email_mailbox".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $uid
 * @property string|null $date
 * @property string|null $subject
 * @property string|null $fromName
 * @property string|null $fromAddress
 * @property string|null $toString
 * @property string|null $textPlain
 * @property string|null $textHtml
 * @property string|null $messageId
 * @property string|null $references
 * @property string|null $in_reply_to
 * @property int|null $size
 * @property int|null $msgno
 * @property int|null $recent
 * @property int|null $flagged
 * @property int|null $answered
 * @property int|null $deleted
 * @property int|null $seen
 * @property int|null $draft
 * @property int|null $is_read
 * @property string|null $read_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property EmailMailboxAddress[] $emailMailboxAddresses
 * @property EmailMailboxAddress[] $emailMailboxAddressesCC
 * @property EmailMailboxAddress[] $emailMailboxAddressesTo
 * @property EmailMailboxAddress[] $emailMailboxAddressesReplyTo
 * @property EmailMailboxAttachment[] $emailMailboxAttachments
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
            [['user_id', 'uid', 'is_read', 'size', 'msgno', 'recent', 'flagged', 'answered', 'deleted', 'seen', 'draft'], 'integer'],
            [['date', 'read_at', 'created_at', 'updated_at' ,'references', 'in_reply_to'], 'safe'],
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
            'uid' => 'uid',
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

    public function getEmailMailboxAddressesCC()
    {
        return $this->getEmailMailboxAddresses()->where(['type'=>EmailMailboxAddress::TYPE_CC]);
    }

    public function getEmailMailboxAddressesTo()
    {
        return $this->getEmailMailboxAddresses()->where(['type'=>EmailMailboxAddress::TYPE_TO]);
    }


    public function getEmailMailboxAddressesReplyTo()
    {
        return $this->getEmailMailboxAddresses()->where(['type'=>EmailMailboxAddress::TYPE_REPLY_TO]);
    }

    /**
     * Gets query for [[EmailMailboxAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailMailboxAttachments()
    {
        return $this->hasMany(EmailMailboxAttachment::className(), ['email_mailbox_id' => 'id']);
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
