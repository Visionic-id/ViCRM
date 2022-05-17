<?php

use app\modules\email\models\EmailUserSetting;
use yii\helpers\Html;

?>

<?= Html::beginForm() ?>
    <div class="card mb-4">
        <div class="card-header">Setting Pengirim</div>
        <div class="card-body">
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_FROM_EMAIL_ADDRESS ?>">Email address</label>
                <input type="email"
                       name="setting[<?= EmailUserSetting::SET_FROM_EMAIL_ADDRESS ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_FROM_EMAIL_ADDRESS) ?>"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_FROM_EMAIL_ADDRESS ?>"
                       aria-describedby="<?= EmailUserSetting::SET_FROM_EMAIL_ADDRESS ?>-help">
                <small id="<?= EmailUserSetting::SET_FROM_EMAIL_ADDRESS ?>-help"
                       class="form-text text-muted">
                    Alamat Email Pengirim
                </small>
            </div>
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_FROM_NAMA_PENGIRIM ?>">Nama Pengirim</label>
                <input type="text"
                       name="setting[<?= EmailUserSetting::SET_FROM_NAMA_PENGIRIM ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_FROM_NAMA_PENGIRIM) ?>"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_FROM_NAMA_PENGIRIM ?>"
                       aria-describedby="<?= EmailUserSetting::SET_FROM_NAMA_PENGIRIM ?>-help">
                <small id="<?= EmailUserSetting::SET_FROM_NAMA_PENGIRIM ?>-help"
                       class="form-text text-muted">Nama Pengirim yang akan muncul pada metadata
                    email.</small>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Setting IMAP (Income)</div>
        <div class="card-body">

            <div class="form-group">
                <label for="setting-<?= EmailUserSetting::SET_IMAP_HOST ?>">URL Host</label>
                <input name="setting[<?= EmailUserSetting::SET_IMAP_HOST ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_IMAP_HOST) ?>"
                       type="text"
                       class="form-control"
                       id="setting-<?= EmailUserSetting::SET_IMAP_HOST ?>"
                       aria-describedby="setting-<?= EmailUserSetting::SET_IMAP_HOST ?>-help">
                <small id="setting-<?= EmailUserSetting::SET_IMAP_HOST ?>-help"
                       class="form-text text-muted">
                    Sebagai contoh :
                    <code>mail.visionic.id</code>
                </small>
            </div>
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_IMAP_EMAIL_ADDRESS ?>">Email address (username)</label>
                <input name="setting[<?= EmailUserSetting::SET_IMAP_EMAIL_ADDRESS ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_IMAP_EMAIL_ADDRESS) ?>"
                       type="email"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_IMAP_EMAIL_ADDRESS ?>"
                       aria-describedby="<?= EmailUserSetting::SET_IMAP_EMAIL_ADDRESS ?>-help">
            </div>
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_IMAP_EMAIL_PASSWORD ?>">Password (credential email)</label>
                <input name="setting[<?= EmailUserSetting::SET_IMAP_EMAIL_PASSWORD ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_IMAP_EMAIL_PASSWORD) ?>"
                       type="password"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_IMAP_EMAIL_PASSWORD ?>"
                       aria-describedby="<?= EmailUserSetting::SET_IMAP_EMAIL_PASSWORD ?>-help">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="<?= EmailUserSetting::SET_IMAP_PORT ?>">Port : </label>
                        <input name="setting[<?= EmailUserSetting::SET_IMAP_PORT ?>]"
                               value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_IMAP_PORT) ?>"
                               type="number"
                               class="form-control"
                               id="<?= EmailUserSetting::SET_IMAP_PORT ?>"
                               aria-describedby="<?= EmailUserSetting::SET_IMAP_PORT ?>-help">
                        <small id="<?= EmailUserSetting::SET_IMAP_PORT ?>-help"
                               class="form-text text-muted">
                            Default port :
                            <code>993</code>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Setting SMTP (Outgoing)</div>
        <div class="card-body">

            <div class="form-group">
                <label for="setting-<?= EmailUserSetting::SET_SMTP_HOST ?>">URL Host</label>
                <input name="setting[<?= EmailUserSetting::SET_SMTP_HOST ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_SMTP_HOST) ?>"
                       type="text"
                       class="form-control"
                       id="setting-<?= EmailUserSetting::SET_SMTP_HOST ?>"
                       aria-describedby="setting-<?= EmailUserSetting::SET_SMTP_HOST ?>-help">
                <small id="setting-<?= EmailUserSetting::SET_SMTP_HOST ?>-help"
                       class="form-text text-muted">
                    Sebagai contoh :
                    <code>mail.visionic.id</code>
                </small>
            </div>
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_SMTP_EMAIL_ADDRESS ?>">Email address (username)</label>
                <input name="setting[<?= EmailUserSetting::SET_SMTP_EMAIL_ADDRESS ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_SMTP_EMAIL_ADDRESS) ?>"
                       type="email"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_SMTP_EMAIL_ADDRESS ?>"
                       aria-describedby="<?= EmailUserSetting::SET_SMTP_EMAIL_ADDRESS ?>-help">
            </div>
            <div class="form-group">
                <label for="<?= EmailUserSetting::SET_SMTP_EMAIL_PASSWORD ?>">Password (credential email)</label>
                <input name="setting[<?= EmailUserSetting::SET_SMTP_EMAIL_PASSWORD ?>]"
                       value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_SMTP_EMAIL_PASSWORD) ?>"
                       type="password"
                       class="form-control"
                       id="<?= EmailUserSetting::SET_SMTP_EMAIL_PASSWORD ?>"
                       aria-describedby="<?= EmailUserSetting::SET_SMTP_EMAIL_PASSWORD ?>-help">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="<?= EmailUserSetting::SET_SMTP_PORT ?>">Port : </label>
                        <input name="setting[<?= EmailUserSetting::SET_SMTP_PORT ?>]"
                               value="<?= EmailUserSetting::getAndSetSettingUser(EmailUserSetting::SET_SMTP_PORT) ?>"
                               type="number"
                               class="form-control"
                               id="<?= EmailUserSetting::SET_SMTP_PORT ?>"
                               aria-describedby="<?= EmailUserSetting::SET_SMTP_PORT ?>-help">
                        <small id="<?= EmailUserSetting::SET_SMTP_PORT ?>-help"
                               class="form-text text-muted">
                            Default port :
                            <code>465</code>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">
        Simpan
    </button>
<?= Html::endForm(); ?>