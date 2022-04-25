<?php

/** @var yii\web\View $this */

/** @var User $user */

/** @var GantiPasswordForm $model */

use app\models\GantiPasswordForm;
use app\models\User;
use kartik\form\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Ganti PAssword';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ganti Password</h4>

                <div class="mb-2">
                    <a href="<?= Url::to(['/site/profile']) ?>" class="btn btn-light">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'old_password')->passwordInput() ?>
                <?= $form->field($model, 'new_password')->passwordInput() ?>
                <?= $form->field($model, 'repeat_new_password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Ganti Password', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>