<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Setting Email";

$this->params['breadcrumbs'][] = ['label' => 'Email', 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="mb-0 mt-1">Attok Rintawan</h5>
                <div class="text-secondary">
                    attok@visionic.id
                </div>
            </div>
            <div class="align-middle">
                <a href="" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Edit Profile
                </a>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="<?= Url::current(['tab' => 'general']) ?>" class="list-group-item list-group-item-action active"
               aria-current="true">
                General Setting
            </a>
            <a href="<?= Url::current(['tab' => 'folder']) ?>" class="list-group-item list-group-item-action">Folder</a>
            <a href="<?= Url::current(['tab' => 'email-address']) ?>" class="list-group-item list-group-item-action">Email
                Address</a>
            <a href="<?= Url::current(['tab' => 'reply-forward']) ?>" class="list-group-item list-group-item-action">Reply
                & Forward</a>
        </div>
    </div>
    <div class="col-md-9">
        <?= Html::beginForm() ?>
        <div class="card mb-4">
            <div class="card-header">Setting Imap (Incoming)</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="setting-1">Email address</label>
                    <input type="email" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                    <small id="setting-1-help" class="form-text text-muted">Alamat Email Pengirim</small>
                </div>
                <div class="form-group">
                    <label for="setting-1">Nama Pengirim</label>
                    <input type="text" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                    <small id="setting-1-help" class="form-text text-muted">Nama Pengirim yang akan muncul pada metadata
                        email.</small>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Setting SMTP (Outgoing)</div>
            <div class="card-body">

                <div class="form-group">
                    <label for="setting-1">URL Host</label>
                    <input type="text" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                    <small id="setting-1-help" class="form-text text-muted">Sebagai contoh : <code>mail.visionic.id</code></small>
                </div>
                <div class="form-group">
                    <label for="setting-1">Email address (username)</label>
                    <input type="email" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                </div>
                <div class="form-group">
                    <label for="setting-1">Password (credential email)</label>
                    <input type="password" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="setting-1">Port : </label>
                            <input type="email" class="form-control" id="setting-1" aria-describedby="setting-1-help">
                            <small id="setting-1-help" class="form-text text-muted">Default port :
                                <code>993</code></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>
        <?= Html::endForm(); ?>
    </div>
</div>
