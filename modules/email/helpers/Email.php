<?php
namespace app\modules\email\helpers;

use app\modules\email\models\EmailAddress;
use app\modules\email\models\EmailMailbox;
use app\modules\email\models\EmailMailboxAddress;
use app\modules\email\models\EmailMailboxAttachment;
use app\modules\email\models\EmailUserFolder;
use app\modules\email\models\EmailUserSetting;
use kekaadrenalin\imap\ImapConnection;
use kekaadrenalin\imap\Mailbox;
use Yii;
use yii\base\BaseObject;

/**
 * contoh koneksi
 * $email = new Email();
 * $email->connect()->initMailbox();
 * $email->reloadEmail(); // untuk reload data email
 * $email->reloadFodler(); // untuk reload data folder
 *
 * @property $con ImapConnection
 * @property $mailbox Mailbox
 */
class Email extends BaseObject
{
    public $con = null;
    public $mailbox = null;


    public function connect($folder = ''){
        $host = EmailUserSetting::getSettingUser(EmailUserSetting::SET_IMAP_HOST);
        $port = EmailUserSetting::getSettingUser(EmailUserSetting::SET_IMAP_PORT);
        $email = EmailUserSetting::getSettingUser(EmailUserSetting::SET_IMAP_EMAIL_ADDRESS);
        $password = EmailUserSetting::getSettingUser(EmailUserSetting::SET_IMAP_EMAIL_PASSWORD);

        $this->con = new ImapConnection();
        $this->con->imapPath = '{'.$host.':'.$port.'/imap/ssl}INBOX'.$folder;
        $this->con->imapLogin = $email;
        $this->con->imapPassword = $password;
        $this->con->serverEncoding = 'utf-8'; // utf-8 default.
        $this->con->attachmentsDir = Yii::getAlias('@app/runtime/imap/');
        $this->con->decodeMimeStr = true;

        return $this;
    }

    public function initMailbox(){
        $this->mailbox = new Mailbox($this->con);
    }

    public function reloadEmail(){
        $mailIds = $this->mailbox->searchMailBox();

        foreach($mailIds as $mailId)
        {
            // Returns Mail contents
            $mail = $this->mailbox->getMail($mailId);

            // Read mail parts (plain body, html body and attachments
            $mailObject = $this->mailbox->getMailParts($mail);

            // Array with IncomingMail objects
            $model = EmailMailbox::find()->where([
                'user_id'=>Yii::$app->user->id,
                'uid'=>$mailObject->id
            ])->one();

            if(!$model){
                $model = new EmailMailbox();
                $model->user_id = Yii::$app->user->id;
                $model->uid = $mailObject->id;
            }

            $model->date = $mailObject->date;
            $model->subject = $mailObject->subject;
            $model->fromName = $mailObject->fromName;
            $model->fromAddress = $mailObject->fromAddress;
            $model->toString = $mailObject->toString;
            $model->textPlain = $mailObject->textPlain;
            $model->textHtml = $mailObject->textHtml;
            $model->messageId = $mailObject->messageId;

            $model->save();

            foreach($mailObject->to as $add=>$name){
                $this->saveEmailMailboxAddress($model->id, $add, $name, EmailMailboxAddress::TYPE_TO);
            }


            foreach($mailObject->replyTo as $add=>$name){
                $this->saveEmailMailboxAddress($model->id, $add, $name, EmailMailboxAddress::TYPE_REPLY_TO);
            }
            foreach($mailObject->cc as $add=>$name){
                $this->saveEmailMailboxAddress($model->id, $add, $name, EmailMailboxAddress::TYPE_CC);
            }
//            foreach($mailObject->bcc as $add=>$name){
//                $this->saveEmailMailboxAddress($model->id, $add, $name, EmailMailboxAddress::TYPE_CC);
//            }



            // Returns mail attachements if any or else empty array
            $attachments = $mailObject->getAttachments();
            foreach($attachments as $attachment){
                $att = EmailMailboxAttachment::findOne([
                    'email_mailbox_id'=>$model->id,
                    'uid'=>$attachment->id
                ]);
                if(!$att){
                    $att = new EmailMailboxAttachment();
                    $att->email_mailbox_id = $model->id;
                    $att->uid = $attachment->id;
                    $att->name = $attachment->name;
                    $att->filePath = $attachment->filePath;
                    $att->save();
                }
            }
        }


        $mailInfos = $this->mailbox->getMailsInfo($mailIds);
        foreach($mailInfos as $info){
            $model = EmailMailbox::findOne(['user_id'=>Yii::$app->user->id, 'uid'=>$info->uid]);
            if(!$model) continue;

            $model->references = isset($info->references) ? $info->references : null;
            $model->in_reply_to = isset($info->in_reply_to) ? $info->in_reply_to : null;
            $model->size = isset($info->size) ? $info->size : null;
            $model->msgno = isset($info->msgno) ? $info->msgno : null;
            $model->recent = isset($info->recent) ? $info->recent : null;
            $model->flagged = isset($info->flagged) ? $info->flagged : null;
            $model->answered = isset($info->answered) ? $info->answered : null;
            $model->deleted = isset($info->deleted) ? $info->deleted : null;
            $model->seen = isset($info->seen) ? $info->seen : null;
            $model->draft = isset($info->draft) ? $info->draft : null;

            $model->save();
        }

    }

    public function saveEmailMailboxAddress($email_mailbox_id, $add, $name, $type){
        $mdlAdd = EmailAddress::findone(['address'=>$add]);
        if(!$mdlAdd){
            $mdlAdd = new EmailAddress();
            $mdlAdd->address = $add;
        }
        $mdlAdd->name = $name;
        $mdlAdd->save();

        $ema = EmailMailboxAddress::find()
            ->where([
                'email_mailbox_id'=>$email_mailbox_id,
                'email_address_id'=>$mdlAdd->id,
                'type'=>$type
            ])
            ->one();

        if(!$ema){
            $ema = new EmailMailboxAddress();
            $ema->email_mailbox_id =$email_mailbox_id;
            $ema->email_address_id =$mdlAdd->id;
            $ema->type =$type;
            $ema->save();
        }
    }

    public function reloadFolder(){
        $folders = $this->mailbox->getListingFolders();
//        print_r($folders);exit();
        foreach($folders as $folder){
            $model = EmailUserFolder::find()
                ->where(['user_id'=>Yii::$app->user->id, 'name'=>$folder])
                ->one();
            if(!$model){
                $model = new EmailUserFolder();
                $model->user_id = Yii::$app->user->id;
                $model->name = $folder;
                $model->save();
            }
        }
    }

}