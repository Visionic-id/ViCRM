<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\url\models\UrlShortener */
/* @var $dataProviderLog yii\data\ActiveDataProvider */
/* @var $searchModelLog app\modules\url\models\UrlShortenerLogSearch */

$this->title = $model->short_url;
$this->params['breadcrumbs'][] = ['label' => 'Url Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="url-shortener-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Copy Short URL',
            ['class' => 'btn btn-primary', 'onclick' => 'navigator.clipboard.writeText("' . Url::to(['default/get', 'short_url' => $model->short_url], true) . '");alert("URL Telah di Copy");']
        ) ?>
        <?= Html::a('Update', ['default/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['default/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="card card-body mb-3">
        <h4>Detail URL</h4>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'url:url',
                'short_url',
            ],
        ]) ?>
    </div>

    <?= $this->render('_log', [
        'dataProviderLog' => $dataProviderLog,
        'searchModelLog' => $searchModelLog,
    ]) ?>

</div>
