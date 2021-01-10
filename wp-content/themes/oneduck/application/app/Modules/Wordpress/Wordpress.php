<?php

namespace App\Modules\Wordpress;

use App\Core\Module;

class Wordpress extends Module
{
    function providers()
    {
        return [
            Http\AjaxController::class
        ];
    }
}