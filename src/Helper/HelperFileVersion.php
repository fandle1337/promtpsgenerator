<?php

namespace App\Helper;

class HelperFileVersion
{
    public static function get($filePath): string
    {
        $path = $_ENV['WORK_DIRECTORY'] . $filePath;
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
            return $path . "?v=" . filemtime($_SERVER['DOCUMENT_ROOT'] . $path);
        }
        return "";
    }
}