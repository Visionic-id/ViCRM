<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\url\models\UrlShortener */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Url Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="url-shortener-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ToUrl', ['default/get', 'short_url' => $model->short_url], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['default/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['default/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:url',
            'short_url:url',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
