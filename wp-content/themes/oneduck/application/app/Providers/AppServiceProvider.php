<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        add_theme_support('woocommerce');
        add_action('init', [$this, 'disableScheduleDelete']);

        if (defined('SMTP_USERNAME')) {
            add_action('phpmailer_init', [$this, 'smtp_setup']);
        }
    }

    public function smtp_setup($phpmailer)
    {
        $phpmailer->Host = SMTP_HOST;
        $phpmailer->Port = SMTP_PORT;
        $phpmailer->Username = SMTP_USERNAME;
        $phpmailer->Password = SMTP_PASSWORD;
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = SMTP_SECURE;

        $phpmailer->IsSMTP();
    }

    /*
     * Отключаем автоматическую очистку корзин
     * */
    public function disableScheduleDelete()
    {
        remove_action('wp_scheduled_delete', 'wp_scheduled_delete');
    }
}