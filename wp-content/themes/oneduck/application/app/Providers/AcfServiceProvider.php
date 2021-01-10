<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AcfServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        add_filter('acf/json_directory', [$this, 'jsonDir']);
        add_filter('acf/settings/save_json', [$this, 'saveJson']);
        add_filter('acf/settings/load_json', [$this, 'loadJson']);
        add_action('init', [$this, 'acfPages']);
    }

    /*
    * Регистрируем страницу настроек
    * */
    public function acfPages()
    {
        acf_add_options_page(
            [
                'page_title' => 'Настройки сайта',
                'menu_title' => 'Настройки сайта',
                'menu_slug' => 'cf-options',
                'capability' => 'edit_posts',
                'redirect' => true,
                'position' => 3.14,
                'icon_url' => 'dashicons-admin-settings',
            ]
        );
    }

    public function jsonDir()
    {
        return storage_path('acf');
    }

    public function saveJson($path)
    {
        return apply_filters('acf/json_directory', null);
    }

    public function loadJson($paths)
    {
        return [
            apply_filters('acf/json_directory', null)
        ];
    }
}