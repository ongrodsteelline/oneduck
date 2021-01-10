<?php

namespace App\Modules\Wordpress;

class Helper
{
    public static function disableCacheResponse()
    {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0 ");
    }
}