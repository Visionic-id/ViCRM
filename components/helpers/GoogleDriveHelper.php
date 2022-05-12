<?php

namespace app\components\helpers;

use app\models\master\User;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Yii;

class GoogleDriveHelper
{

    public static function findFolderByName($name = null, $parent_id = null)
    {
        $service = self::checkToken(true);
        if ($parent_id == null)
            $parent_id = Yii::$app->params['rootForlderId'];

        $q = "mimeType='application/vnd.google-apps.folder' and trashed=false";

        if (!empty($parent_id))
            $q .= " and '$parent_id' in parents";
        if (!empty($name))
            $q .= " and name contains '$name'";

        $files = $service->files
            ->listFiles(['q' => $q])
            ->getFiles();
        echo '<pre>';
        print_r($files);
        die();
    }

    /**
     * @param $redirect_login
     * @return Google_Service_Drive|void|\yii\console\Response|\yii\web\Response
     * @throws \Google\Exception
     */
    public static function checkToken($redirect_login = false)
    {
        $client = new Google_Client();
        $client->setAuthConfig(Yii::getAlias('@app/commands/client_secret.json'));
        $client->addScope("https://www.googleapis.com/auth/drive");
        $service = new Google_Service_Drive($client);

        if (Yii::$app instanceof \yii\console\Application) {
            $user = User::findOne(1);
        } else {
            $user = Yii::$app->user->identity;
        }
        /* @var $user User */
        $token = json_decode($user->google_drive_token, true);

        // proses membaca token pasca login
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            // simpan token ke session
//            print_r($token);die();
            $user->google_drive_token = json_encode($token);
//            print_r($user->google_drive_token);die();
            if (!$user->save()) {
                print_r($user->getErrors());
                die();
            }
        }


//        print_r($token);die();
        if (!empty($token) && !isset($token['error']) && $redirect_login) {
            $client->setAccessToken($token);
            // membaca token respon dari google drive

//            var_dump($client->isAccessTokenExpired());die();
            if ($client->isAccessTokenExpired()) {
                $authUrl = $client->createAuthUrl();

                Yii::$app->getResponse()->redirect($authUrl);
                Yii::$app->end();
            }
        }

        // mengecek keberadaan token session
        if ((empty($token) || isset($token['error'])) && $redirect_login) {
            // jika token belum ada, maka lakukan login via oauth
            $authUrl = $client->createAuthUrl();

            Yii::$app->getResponse()->redirect($authUrl);
            Yii::$app->end();
        }

        return $service;
    }

    public static function findPdfByName($name = null, $parent_id = null)
    {
        $service = self::checkToken(true);
        if ($parent_id === null)
            $parent_id = Yii::$app->params['rootForlderId'];

        $q = "mimeType='application/pdf' and trashed=false";

        if (!empty($parent_id))
            $q .= " and '$parent_id' in parents";
        if (!empty($name))
            $q .= " and name contains '$name'";

        $files = $service->files
            ->listFiles(['q' => $q])
            ->getFiles();
        echo '<pre>';
        print_r($files);
        die();
    }

    public static function createFolder($name, $parent_id = null)
    {
        $service = self::checkToken(true);
        if ($parent_id === null)
            $parent_id = Yii::$app->params['rootForlderId'];

        $file = new Google_Service_Drive_DriveFile();
        $file->setParents([$parent_id]);
        // set nama file di Google Drive disesuaikan dg nama file aslinya
        $file->setName($name);
        $file->setMimeType('application/vnd.google-apps.folder');
        // proses upload file ke Google Drive dg multipart
        $service = $service->files->create($file);

//        echo '<pre>';
//        print_r($service);
//        die();

        return $service;
    }

    public static function uploadFile($file_path, $file_name, $parent_id = null)
    {
        $service = self::checkToken(true);
        if ($parent_id === null)
            $parent_id = Yii::$app->params['rootForlderId'];


        $file = new Google_Service_Drive_DriveFile();
        $file->setParents([$parent_id]);
        // set nama file di Google Drive disesuaikan dg nama file aslinya
        $file->setName($file_name);
        // proses upload file ke Google Drive dg multipart
        return $service->files->create($file, [
            'data' => file_get_contents($file_path),
//                'data' => file_get_contents($_FILES["fileToUpload"]["tmp_name"]),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart']);
    }
}
