<?php
namespace app\modules\email\helpers;

use kekaadrenalin\imap\ImapConnection;
use kekaadrenalin\imap\Mailbox;
use Yii;
use yii\base\BaseObject;

/**
 * @property $con ImapConnection
 * @property $mailbox Mailbox
 */
class Email extends BaseObject
{
    public $con = null;
    public $mailbox = null;

    public function connect(){
        $this->con = new ImapConnection();
        $this->con->imapPath = '{mail.visionic.id:993/imap/ssl}INBOX';
        $this->con->imapLogin = 'attok@visionic.id';
        $this->con->imapPassword = '7=5ynN=kEkDC';
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
    }

}