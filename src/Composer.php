<?php

namespace Aetonsi\Utils;

use \Exception;

class Composer
{
    public static function postAutoloadDump(\Composer\Script\Event $event)
    {
        $root = dirname(__DIR__);
        $mode = $event->isDevMode() ? 'DEV' : 'PROD';
        echo ">> COMPOSER IN $mode MODE\n";
        if (file_exists("$root/.env.sample")) {
            echo ">> .env file management";
            if ($event->isDevMode()) {
                if (!file_exists("$root/.env")) {
                    echo ">> copying .env.sample to .env\n";
                    copy("$root/.env.sample", "$root/.env");
                }
            } else {
                if (!file_exists("$root/.env")) {
                    throw new Exception('>> file .env missing!');
                }
            }
        }
    }
}
