<?php

/** @var yii\web\View $this */

/** @var User $user */

use app\models\User;
use yii\helpers\Url;

$this->title = 'Profil Saya';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Profil Saya</h4>

    <div class="mb-2">
        <a href="<?= Url::to(['/site/ganti-password']) ?>" class="btn btn-primary">
            <i class="fa fa-cog"></i> Ganti Password
        </a>
    </div>

        <table class="table table-bordered table-striped table-sm">
            <tr>
                <th width="250">Username</th>
                <td><?= $user->username ?></td>
            </tr>
            <tr>
                <th width="250">Role</th>
                <td><?= $user->getRoleString() ?></td>
            </tr>
        </table>
    </div>
</div>
