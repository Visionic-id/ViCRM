<?php

namespace app\components\queue;

use app\components\helpers\FlashHelper;
use app\controllers\EventController;
use app\models\master\Event;
use app\models\master\User;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\httpclient\Client;
use yii\queue\JobInterface;
use yii\web\Controller;
use yii\web\View;

class SendEmailQueue extends BaseObject implements JobInterface
{
    public $event_id;
    public $type;
    private $list_type = ['peserta', 'panitia', 'pembicara', 'moderator'];

    public function execute($queue)
    {
        $event = Event::findOne($this->event_id);
        if (empty($event)) {
            throw new Exception('Event not found');
        }
        if(empty($event->no) || empty($event->image_path)){
            throw new Exception('No event / gambar event tidak ditemukan');
        }

        try {
            if ($event->is_send_email_queue_start) {
                throw new Exception('Send Email Queue sedang berjalan');
            }
            $event->is_send_email_queue_start = 1;
            $event->save();

            if (!in_array($this->type, $this->list_type, true)) {
                throw new Exception('Tipe Event Tidak Benar');
            }

            if ($this->type === 'peserta') {
                $semua_event_relation = $event->getEventPesertas()->andWhere(['status_sent' => 1, 'status_email_sent' => 0])->all();
            } else if ($this->type === 'panitia') {
                $semua_event_relation = $event->getEventPanitias()->andWhere(['status_sent' => 1, 'status_email_sent' => 0])->all();
            } else if ($this->type === 'pembicara') {
                $semua_event_relation = $event->getEventPembicaras()->andWhere(['status_sent' => 1, 'status_email_sent' => 0])->all();
            } else if ($this->type === 'moderator') {
                $semua_event_relation = $event->getEventModerators()->andWhere(['status_sent' => 1, 'status_email_sent' => 0])->all();
            } else {
                throw new Exception('Tipe Event Tidak Benar');
            }

            $client = new Client();
            foreach ($semua_event_relation as $event_relation) {
                $event_relation->sendEmail();
                sleep(1);
            }

            $event->is_send_email_queue_start = 0;
            $event->save();
        }catch (\Exception $e) {
            $event->is_send_email_queue_start = 0;
            $event->save();
            throw $e;
        }
    }
}