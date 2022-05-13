<?php

use yii\grid\GridView;

/* @var $dataProviderLog yii\data\ActiveDataProvider */
/* @var $searchModelLog app\modules\url\models\UrlShortenerLogSearch */
?>

<div class="card card-body">
    <h4>Log URL</h4>
    <?= GridView::widget([
        'dataProvider' => $dataProviderLog,
        'filterModel' => $searchModelLog,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ip',
            'browser',
            'os',
            'device',
            'engine',
        ],
    ]); ?>
</div>
