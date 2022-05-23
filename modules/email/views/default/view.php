<?php
/* @var $model EmailMailbox */

use app\modules\email\helpers\Format;
use app\modules\email\models\EmailMailbox;
use yii\helpers\Url;

$this->title = 'View Email : ' . $model->subject;

$this->params['breadcrumbs'][] = ['label' => 'Mailbox', 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="text-muted">
    View Email :
</div>
<h1 class="h4"><?= $model->subject ?></h1>


<div class="mb-4 mt-2 d-flex justify-content-between">
    <div>
        <a href="<?= Url::to(['/email/compose', 'reply-from'=>$model->id]) ?>" class="btn btn-success">
            <i class="fa fa-reply"></i> Reply
        </a>
        <a href="<?= Url::to(['/email/compose', 'forward-from'=>$model->id]) ?>" class="btn btn-info">
            <i class="fa fa-forward"></i> Forward
        </a>
    </div>
    <a href="<?= Url::to(['/email/compose']) ?>" class="btn btn-danger">
        <i class="fa fa-trash"></i> Delete
    </a>
</div>

<div class="row">
    <div class="col-md-8">

        <div class="card mb-4">
            <div class="card-header">Email Body:</div>
            <div class="card-body">
                <div class="embed-responsive embed-responsive-1by1">
                    <iframe class="embed-responsive-item"
                            src="<?= Url::to(['view-raw', 'id' => $model->id]) ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">

        <div class="card mb-4">
            <div class="card-header">Sender Info</div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">From</dt>
                    <dd class="col-sm-8">
                        <?= Format::email($model->fromAddress, $model->fromName); ?>
                    </dd>
                    <dt class="col-sm-4">Send At
                    <dt>
                    <dd class="col-sm-8">
                        <?= Yii::$app->formatter->asDatetime($model->date) ?>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Send To</div>
            <div class="card-body">

                <?php
                foreach ($model->emailMailboxAddressesTo as $address) {
                    echo Format::emailFromModel($address->emailAddress);
                }
                ?>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Reply To</div>
            <div class="card-body">

                <?php
                foreach ($model->emailMailboxAddressesReplyTo as $address) {
                    echo Format::emailFromModel($address->emailAddress);
                }
                ?>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">CC / BCC</div>
            <div class="card-body">

                <?php
                foreach ($model->emailMailboxAddressesCC as $address) {
                    echo Format::emailFromModel($address->emailAddress);
                }
                ?>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">Attachment (<?= count($model->emailMailboxAttachments) ?>)</div>
            <div class="card-body">
                <ol class="list-group list-group-flush">
                    <?php
                    foreach ($model->emailMailboxAttachments as $attachment) {
                        ?>
                        <li class="list-group-item"><a href="<?= Url::to(['/email/default/download-attachment',
                                'id' => $attachment->id]) ?>"><?= $attachment->name ?></a></li>
                        <?php
                    }
                    ?>
                </ol>
            </div>
        </div>

    </div>
</div>
