<?php

namespace app\modules\email\controllers;

use kekaadrenalin\imap\ImapConnection;
use kekaadrenalin\imap\Mailbox;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `email` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $imapConnection = new ImapConnection();

        $imapConnection->imapPath = '{mail.visionic.id:993/imap/ssl}INBOX';
        $imapConnection->imapLogin = 'attok@visionic.id';
        $imapConnection->imapPassword = '7=5ynN=kEkDC';
        $imapConnection->serverEncoding = 'utf-8'; // utf-8 default.
        $imapConnection->attachmentsDir = Yii::getAlias('@app/runtime/imap/');
        $imapConnection->decodeMimeStr = true;
//        $imapConnection->imapPath = ;

        $mailbox = new Mailbox($imapConnection);
        $mailIds = $mailbox->searchMailBox(); // Gets all Mail ids.
//        print_r($mailIds);

        $folders = $mailbox->getListingFolders();
        print_r($folders);
        exit();

        foreach($mailIds as $mailId)
        {
            // Returns Mail contents
            $mail = $mailbox->getMail($mailId);

            // Read mail parts (plain body, html body and attachments
            $mailObject = $mailbox->getMailParts($mail);

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
        exit();
    }
}
