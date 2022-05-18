<?php

use app\modules\email\models\EmailUserFolder;
use yii\helpers\Url;

$folders = EmailUserFolder::find()->where(['user_id'=>Yii::$app->user->id])->all();
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

                <?php foreach($folders as $n=>$folder): ?>
                <a class="dropdown-item" href="<?= Url::current(['folder'=>$folder->name]) ?>"><?= $folder->name ?></a>
                <?php endforeach; ?>
            </div>

            <a href="<?= Url::to(['/email/reload']) ?>" class="btn btn-info">
                <i class="fa fa-refresh"></i> Reload Email
            </a>
        </div>

        <div class="">
            <form class="d-flex">
                <input type="search" class="form-control mr-2" placeholder="Pencarian "/>
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
        <tr>
            <td class="align-middle">
                <div class="text-muted">
                Senin,
                12 Mar 2022<br/>
                12:00 AM
                </div>
            </td>
            <td class="align-middle">
                <a href="" class="font-weight-bold text-primary">
                    Penawaran Pengembangan Sistem Informasi Pengelolaan Jadwal Sertifikasi dari Visionic
                </a>
            </td>
            <td class="align-middle">
                <a href="">
                    Surya Eko Indrawan
                </a>
                <div>surya@visionic.co.id</div>
            </td>
            <td class="align-middle">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-mail-reply"></i> Reply
                </a>

                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                    <i class="fa fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-mail-forward"></i>
                        Forward
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-eye"></i>
                        Detail
                    </a>
                </div>
            </td>
        </tr>

        <tr>
            <td class="align-middle">
                <div class="text-muted">
                    Senin,
                    12 Mar 2022<br/>
                    12:00 AM
                </div>
            </td>
            <td class="align-middle">
                <a href="" class="font-weight-bold text-secondary">
                    Penawaran Pengembangan Sistem Informasi Pengelolaan Jadwal Sertifikasi dari Visionic
                </a>
            </td>
            <td class="align-middle">
                <a href="">
                    Surya Eko Indrawan
                </a>
                <div>surya@visionic.co.id</div>
            </td>
            <td class="align-middle">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-mail-reply"></i> Reply
                </a>

                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                    <i class="fa fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-mail-forward"></i>
                        Forward
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-eye"></i>
                        Detail
                    </a>
                </div>
            </td>
        </tr>

        <tr>
            <td class="align-middle">
                <div class="text-muted">
                    Senin,
                    12 Mar 2022<br/>
                    12:00 AM
                </div>
            </td>
            <td class="align-middle">
                <a href="" class="font-weight-bold text-secondary">
                    Penawaran Pengembangan Sistem Informasi Pengelolaan Jadwal Sertifikasi dari Visionic
                </a>
            </td>
            <td class="align-middle">
                <a href="">
                    Surya Eko Indrawan
                </a>
                <div>surya@visionic.co.id</div>
            </td>
            <td class="align-middle">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-mail-reply"></i> Reply
                </a>

                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                    <i class="fa fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-mail-forward"></i>
                        Forward
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-eye"></i>
                        Detail
                    </a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>