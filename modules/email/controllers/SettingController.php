<?php

namespace app\modules\email\controllers;

use yii\web\Controller;

class SettingController extends Controller
{

    public function actionIndex(){
        return $this->render('index');
    }

}