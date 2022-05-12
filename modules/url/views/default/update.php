<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\url\models\UrlShortener */

$this->title = 'Update Url Shortener: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Url Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="url-shortener-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
