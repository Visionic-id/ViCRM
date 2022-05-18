<?php

use app\modules\email\models\EmailUserFolder;
use yii\helpers\Html;
use yii\helpers\Url;

$folders = EmailUserFolder::find()->where(['user_id'=>Yii::$app->user->id])->all();
?>

    <div class="card mb-4">
        <div class="card-header">Kelola Folder</div>
        <div class="card-body">
            <div class="mb-3">
            <?= Html::beginForm(Url::current(), 'post') ?>
            <button type="submit" name="action" value="reload" class="btn btn-primary">
                <i class="fa fa-refresh"></i> Reload Folder
            </button>
            <?= Html::endForm() ?>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th width="50">#</th>
                    <th>Folder</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($folders as $n=>$folder): ?>
                <tr>
                    <td><?= $n+1 ?></td>
                    <td><?= $folder->name ?></td>
                    <td class="text-right">
                        <a href="<?= Url::to(['/email/index', 'folder'=>$folder->name]) ?>">
                            <i class="fa fa-envelope"></i> Lihat Email
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
