<?php

namespace app\components\baseController;


use app\components\helpers\GoogleDriveHelper;
use Yii;

class BaseController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest)
            $this->redirect(['/auth']);

//        GoogleDriveHelper::checkToken();

        return parent::beforeAction($action);
    }
}