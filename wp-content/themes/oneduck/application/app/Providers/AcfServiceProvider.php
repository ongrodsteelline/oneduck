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
        $parent = acf_add_options_page(
            [
                'page_title' => 'Настройки сайта',
                'menu_title' => 'Настройки сайта',
                'menu_slug' => 'cf-options',
                'capability' => 'edit_posts',
                'redirect' => false,
                'position' => 3.14,
                'icon_url' => 'dashicons-admin-settings',
            ]
        );

        acf_add_options_sub_page([
            'page_title' => 'Курс валют',
            'menu_title' => 'Курс валют',
            'parent_slug' => $parent['menu_slug'],
            'menu_slug' => 'cf-currencies',
        ]);
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