<?php
namespace app\modules\email\helpers;

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
        /* @todo Save Email */

        foreach($mailIds as $mailId)
        {
            // Returns Mail contents
            $mail = $this->mailbox->getMail($mailId);

            // Read mail parts (plain body, html body and attachments
            $mailObject = $this->mailbox->getMailParts($mail);

            // Array with IncomingMail objects
            print_r($mailObject->fromName);
            exit();

            // Returns mail attachements if any or else empty array
//            $attachments = $mailObject->getAttachments();
//            foreach($attachments as $attachment){
//                echo ' Attachment:' . $attachment->name . PHP_EOL;
//
//                // Delete attachment file
//                unlink($attachment->filePath);
//            }
        }
    }

    public function saveMail(){

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