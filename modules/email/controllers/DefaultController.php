<?php

namespace app\modules\email\controllers;

use app\modules\email\helpers\Email;
use app\modules\email\models\EmailMailbox;
use kekaadrenalin\imap\ImapConnection;
use kekaadrenalin\imap\Mailbox;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `email` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     */
    public function actionIndex()
    {
        if($this->request->isPost){
            $action = $this->request->post('action');
            if($action == 'reload'){
                $email = new Email();
                $email->connect()->initMailbox();
                $email->reloadEmail();
                Yii::$app->session->setFlash('success', 'Berhasil memuat ulang email');
                return $this->refresh();
            }
        }

        $query = EmailMailbox::find()->where(['user_id'=>Yii::$app->user->id]);

        $q = $this->request->get('q');
        if($q){
            $query->orFilterWhere(['like', 'date', $q])
                ->orFilterWhere(['like', 'subject', $q])
                ->orFilterWhere(['like', 'fromName', $q])
                ->orFilterWhere(['like', 'fromAddress', $q])
                ->orFilterWhere(['like', 'textPlain', $q]);
        }

        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);

        return $this->render('index', [
            'q'=>$q,
            'dataProvider'=>$dataProvider
        ]);
    }
}
