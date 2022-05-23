<?php

namespace app\modules\email\helpers;

use app\modules\email\models\EmailAddress;
use yii\helpers\Url;

class Format
{
    public static function emailFromModel(EmailAddress $address)
    {
        return self::email($address->address, $address->name);
    }


    public static function email($address, $name = null)
    {
        $html = '<a href="'.Url::to(['/email/default/compose', 'email'=>$address]).'">';
        if($name){
            $html .= '<b>'.$name.'</b><br />';
        }
        $html .= $address;
        $html .= '</a>';

        return $html;
    }
}