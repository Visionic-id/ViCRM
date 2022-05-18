<?php

use app\modules\email\models\EmailMailbox;
use app\modules\email\models\EmailUserFolder;
use yii\bootstrap4\LinkPager;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $dataProvider ActiveDataProvider */
/* @var $q string */

$this->title = 'Email - Mailbox';
$this->params['breadcrumbs'][] = $this->title;

$folders = EmailUserFolder::find()->where(['user_id' => Yii::$app->user->id])->all();
?>
<div class="mb-4 mt-2 d-flex justify-content-between">
    <a href="<?= Url::to(['/email/compose']) ?>" class="btn btn-success">
        <i class="fa fa-file-circle-plus"></i> Compose Email
    </a>
    <a href="<?= Url::to(['/email/setting']) ?>" class="btn btn-secondary">
        <i class="fa fa-gear"></i> Setting
    </a>
</div>
<div class="">
    <h6>Filter</h6>
    <div class="d-flex mb-3 justify-content-between">
        <div class="mr-3">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-expanded="false">Pilih Folder (Inbox)
            </button>
            <div class="dropdown-menu">

                <?php foreach ($folders as $n => $folder): ?>
                    <a class="dropdown-item"
                       href="<?= Url::current(['folder' => $folder->name]) ?>"><?= $folder->name ?></a>
                <?php endforeach; ?>
            </div>

            <?= Html::beginForm(Url::current(), 'post', ['class' => 'form-inline d-inline-block']) ?>
            <button type="submit" name="action" value="reload" class="btn btn-info">
                <i class="fa fa-refresh"></i> Reload Email
            </button>
            <?= Html::endForm() ?>
        </div>

        <div class="">
            <form method="get" action="<?= Url::current(['q' => false]) ?>" class="d-flex">
                <input type="search" name="q" value="<?= $q ?>" class="form-control mr-2" placeholder="Pencarian "/>
                <button class="btn btn-primary d-inline-flex align-content-center justify-content-center align-middle">
                    <i class="fa fa-search mr-2 align-self-center"></i>
                    <span>Cari</span>
                </button>
            </form>
        </div>
    </div>

    <table class="table table-hover table-striped">
        <thead class="thead-light">
        <tr>
            <th width="170">Date</th>
            <th>Title</th>
            <th width="250">From</th>
            <th width="175">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getModels() as $model) :
            /* @var $model EmailMailbox */
            ?>
            <tr>
                <td class="align-middle">
                    <div class="text-muted">
                        <?= Yii::$app->formatter->asDatetime($model->date) ?>
                    </div>
                </td>
                <td class="align-middle">
                    <a href="<?= Url::to(['view', 'id'=>$model->id]) ?>" class="font-weight-bold text-primary">
                        <?= $model->subject ?>
                    </a>
                </td>
                <td class="align-middle">
                    <a href="<?= Url::to(['compose', 'toAddress'=>$model->fromAddress, 'toName'=>$model->fromName]) ?>">
                        <?= $model->fromName ?>
                    </a>
                    <div><?= $model->fromAddress ?></div>
                </td>
                <td class="align-middle">
                    <a href="<?= Url::to(['reply', 'id'=>$model->id]) ?>" class="btn btn-primary">
                        <i class="fa fa-mail-reply"></i> Reply
                    </a>

                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= Url::to(['forward', 'id'=>$model->id]) ?>">
                            <i class="fa fa-mail-forward"></i>
                            Forward
                        </a>
                        <a class="dropdown-item" href="<?= Url::to(['view', 'id'=>$model->id]) ?>">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <div class="mt-4">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination()
        ]) ?>
    </div>
</div>