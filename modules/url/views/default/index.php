<?php

use app\modules\url\models\UrlShortener;
use app\modules\url\models\UrlShortenerLog;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\url\models\UrlShortenerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Url Shorteners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-shortener-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Url Shortener', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'url:url',
            [
                'attribute' => 'short_url',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::button($model->short_url,
                        ['class' => 'btn btn-primary', 'onclick' => 'navigator.clipboard.writeText("' . Url::to(['default/get', 'short_url' => $model->short_url], true) . '");alert("URL Telah di Copy");']
                    );
                },
            ],
            [
                'label' => 'Visitor',
                'format' => ['decimal', 0],
                'value' => function ($model) {
                    return UrlShortenerLog::find()->where(['url_shortener_id' => $model->id])->count();
                },
            ],
//            'created_at',
//            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UrlShortener $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
