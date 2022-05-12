<?php

namespace app\components\helpers;

use Hidehalo\Nanoid\Client;

class NanoIdHelper
{
    protected static function getClient()
    {
        $client = new Client();
        $client->formattedId('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-.~_',5);
        return $client;
    }

    public static function generate()
    {
        return self::getClient()->generateId(5);
    }
}