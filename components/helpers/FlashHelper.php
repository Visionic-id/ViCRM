<?php

namespace app\components\helpers;

use Yii;

class FlashHelper
{
    public static function flashErrorModel($model)
    {
        foreach ($model->getErrors() as $errors) {
            foreach ($errors as $error) {
                Yii::$app->session->addFlash('warning', $error);
            }
        }
    }

    public static function addFlashSuccess($message)
    {
        Yii::$app->session->addFlash('success', $message);
    }

    public static function addFlashError($message)
    {
        Yii::$app->session->addFlash('error', $message);
    }

    public static function addFlashWarning($message)
    {
        Yii::$app->session->addFlash('warning', $message);
    }
}
