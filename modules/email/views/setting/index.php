<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Setting Email";

$this->params['breadcrumbs'][] = ['label' => 'Email', 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;

if(!isset($tab)){
    $tab = 'general';
}
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
            <a href="<?= Url::current(['tab' => 'general']) ?>" class="list-group-item list-group-item-action<?= $tab == 'general' ? ' active' : ''?>"
               aria-current="true">
                General Setting
            </a>
            <a href="<?= Url::current(['tab' => 'folder']) ?>" class="list-group-item list-group-item-action<?= $tab == 'folder' ? ' active' : ''?>">Folder</a>
            <a href="<?= Url::current(['tab' => 'email-address']) ?>" class="list-group-item list-group-item-action<?= $tab == 'email-address' ? ' active' : ''?>">Email
                Address</a>
            <a href="<?= Url::current(['tab' => 'reply-forward']) ?>" class="list-group-item list-group-item-action<?= $tab == 'reply-forward' ? ' active' : ''?>">Reply
                & Forward</a>
        </div>
    </div>
    <div class="col-md-9">
        <?= $this->render('tab/'.$tab, [

        ]) ?>
    </div>
</div>
