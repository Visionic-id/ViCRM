<?php

namespace app\components\baseModel;

use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
//    public function behaviors()
//    {
//        return [
//            'bedezign\yii2\audit\AuditTrailBehavior'
//        ];
//    }

    public function beforeSave($insert)
    {
        if (Yii::$app instanceof \yii\console\Application) {
            $user_id = 1;
        } else {
            $user = @Yii::$app->user->identity;
            $user_id = @$user->id;
        }
        if (!$user_id) {
            return parent::beforeSave($insert);
        }
        $this->updated_at = new \yii\db\Expression('NOW()');
        if ($insert) {
            $this->created_at = new \yii\db\Expression('NOW()');
            $this->updated_by = $user_id;
            $this->created_by = $user_id;
        }

        if ($this->updated_by != $user_id) {
            $this->updated_by = $user_id;
        }
        return parent::beforeSave($insert);
    }
}
