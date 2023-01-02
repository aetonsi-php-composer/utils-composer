<?php

namespace Aetonsi\Utils;

use \Exception;

class Composer
{
    private static string $projectRootPath;

    public static function getProjectRootPath()
    {
        return self::$projectRootPath ??= realpath(dirname(\Composer\Factory::getComposerFile()));
    }

    public static function postAutoloadDump(\Composer\Script\Event $event)
    {
        $projectRootPath = self::getProjectRootPath();
        $mode = $event->isDevMode() ? 'DEV' : 'PROD';
        echo ">> COMPOSER IN $mode MODE\n";
        echo ">> COMPOSER ROOT PATH: $projectRootPath\n";
        if (file_exists("$projectRootPath/.env.sample")) {
            echo ">> .env file management";
            if ($event->isDevMode()) {
                if (!file_exists("$projectRootPath/.env")) {
                    echo ">> copying .env.sample to .env\n";
                    copy("$projectRootPath/.env.sample", "$projectRootPath/.env");
                }
            } else {
                if (!file_exists("$projectRootPath/.env")) {
                    throw new Exception('>> file .env missing!');
                }
            }
        }
    }
}
