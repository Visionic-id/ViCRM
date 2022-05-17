<?php

namespace app\modules\email\controllers;

use app\modules\email\models\EmailUserSetting;
use Yii;
use yii\web\Controller;

class SettingController extends Controller
{

    public function actionIndex(){
        $tab_list = [
            'general',
            'folder',
            'email-address',
            'reply-forward',
        ];
        $tab = $this->request->get('tab', 'general');

        if(!in_array($tab, $tab_list)){
            $tab = 'general';
        }


        if($tab == 'general'){
            if($this->request->isPost){
                $settings = $this->request->post('setting');
                if(is_array($settings)){
                    foreach($settings as $name=>$value){
                        EmailUserSetting::setSettingUser($name, $value);
                    }

                    Yii::$app->session->setFlash('success', 'Berhasil menyimpan setting');

                    return $this->refresh();
                }
            }
        }

        return $this->render('index', [
            'tab'=>$tab
        ]);
    }

}