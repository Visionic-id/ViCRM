<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Login Vi CRM';
//$this->params['breadcrumbs'][] = $this->title;
?>
<br />
<br />
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card card-body">

            <div class="site-login">
                <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
                <br />

                <p>Masukan username & password untuk login :</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
//        'layout' => 'horizontal',
//        'fieldConfig' => [
//            'template' => "{label}\n{input}\n{error}",
//            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
//            'inputOptions' => ['class' => 'col-lg-3 form-control'],
//            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
//        ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
//        'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block',
                                                     'name'  => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>