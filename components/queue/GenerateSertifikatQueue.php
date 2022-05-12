<?php

namespace app\components\queue;

use app\components\helpers\FlashHelper;
use app\models\master\Event;
use app\models\master\User;
use Exception;
use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class GenerateSertifikatQueue extends BaseObject implements JobInterface
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
            if ($event->is_generate_certificate_queue_started) {
                throw new Exception('Generate Sertifikat Queue sedang berjalan');
            }
            $event->is_generate_certificate_queue_started = 1;
            $event->save();

            if (!in_array($this->type, $this->list_type, true)) {
                throw new Exception('Tipe Event Tidak Benar');
            }

            if ($this->type === 'peserta') {
                $event->generateCertificatePeserta();
            } else if ($this->type === 'panitia') {
                $event->generateCertificatePanitia();
            } else if ($this->type === 'pembicara') {
                $event->generateCertificatePembicara();
            } else if ($this->type === 'moderator') {
                $event->generateCertificateModerator();
            } else {
                throw new Exception('Tipe Event Tidak Benar');
            }

            $event->is_generate_certificate_queue_started = 0;
            $event->save();
        }catch (\Exception $e) {
            $event->is_generate_certificate_queue_started = 0;
            $event->save();
            throw $e;
        }
    }
}