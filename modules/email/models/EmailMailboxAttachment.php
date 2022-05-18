<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_mailbox_attachment".
 *
 * @property int $id
 * @property int|null $email_mailbox_id
 * @property int|null $uid
 * @property string|null $name
 * @property string|null $filePath
 *
 * @property EmailMailbox $emailMailbox
 */
class EmailMailboxAttachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_mailbox_attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_mailbox_id', 'uid'], 'integer'],
            [['filePath'], 'string'],
            [['name'], 'string', 'max' => 250],
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
            'email_mailbox_id' => 'Email Mailbox ID',
            'uid' => 'Uid',
            'name' => 'Name',
            'filePath' => 'File Path',
        ];
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
