<?php

namespace App\Helpers;

use Exception;

class ImageHelper
{
    public static function imageToDataUrl(string $filename): string
    {
        if (!file_exists($filename)) {
            throw new Exception('File not found.');
        }

        $mime = mime_content_type($filename);
        if ($mime === false) {
            throw new Exception('Illegal MIME type.');
        }

        $raw_data = file_get_contents($filename);
        if (empty($raw_data)) {
            throw new Exception('File not readable or empty.');
        }

        return "data:{$mime};base64," . base64_encode($raw_data);
    }
}
