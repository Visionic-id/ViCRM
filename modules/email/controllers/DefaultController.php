<?php

namespace app\modules\email\controllers;

use app\modules\email\helpers\Email;
use app\modules\email\models\EmailMailbox;
use app\modules\email\models\EmailMailboxAttachment;
use kekaadrenalin\imap\ImapConnection;
use kekaadrenalin\imap\Mailbox;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
            $query->orFilterWhere(['date'=> $q])
                ->orFilterWhere(['like', 'subject', $q])
                ->orFilterWhere(['like', 'fromName', $q])
                ->orFilterWhere(['like', 'fromAddress', $q])
                ->orFilterWhere(['like', 'textPlain', $q]);
        }

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'sort'=>[
                'defaultOrder'=>[
                    'date'=>SORT_DESC
                ]
            ]
        ]);

        return $this->render('index', [
            'q'=>$q,
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);

        return $this->render('view', [
            'model'=>$model
        ]);
    }
    public function actionViewRaw($id){
        $model = $this->findModel($id);
        /* @var $model EmailMailbox */

        return $model->textHtml;
    }

    public function actionDownloadAttachment($id){
        $model = EmailMailboxAttachment::findOne($id);
        if(!$model){
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }

        $this->response->sendFile($model->filePath, $model->name, [
            'inline'=>true
        ]);
    }

    public function actionCompose(){

    }

    private function findModel($id){
        $model = EmailMailbox::find()->where([
            'id'=>$id,
            'user_id'=>Yii::$app->user->id
        ])->one();

        if(!$model) throw new NotFoundHttpException('Email tidak ditemukan.');

        return $model;
    }
}
