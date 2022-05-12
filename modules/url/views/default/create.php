<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\url\models\UrlShortener */

$this->title = 'Create Url Shortener';
$this->params['breadcrumbs'][] = ['label' => 'Url Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-shortener-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
