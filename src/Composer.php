<?php

namespace Aetonsi\Utils;

class Composer
{
    private static string $projectRootPath;

    public static function writeline(string $msg)
    {
        echo ">> $msg\n";
    }

    public static function thrower(string $msg)
    {
        throw new \Exception(">> $msg");
    }

    public static function getProjectRootPath()
    {
        return self::$projectRootPath ??= realpath(dirname(\Composer\Factory::getComposerFile()));
    }

    public static function postAutoloadDump(\Composer\Script\Event $event)
    {
        $projectRootPath = self::getProjectRootPath();
        $mode = $event->isDevMode() ? 'DEV' : 'PROD';
        self::writeline("COMPOSER IN $mode MODE");
        self::writeline("PROJECT ROOT PATH: $projectRootPath");
        if (file_exists("$projectRootPath/.env.sample")) {
            self::writeline(".env file management");
            if (!file_exists("$projectRootPath/.env")) {
                if ($event->isDevMode()) {
                    self::writeline("copying .env.sample to .env");
                    if (!copy("$projectRootPath/.env.sample", "$projectRootPath/.env")) {
                        self::thrower('cannot create .env file!');
                    }
                } else {
                    self::thrower('file .env missing!');
                }
            }
        }
    }
}
