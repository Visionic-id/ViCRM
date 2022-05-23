<?php

namespace app\modules\email;

/**
 * email module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\email\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->setComponents([
            ''
        ]);

        // custom initialization code goes here
    }
}
