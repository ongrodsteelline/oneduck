<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AssetServiceProvider extends ServiceProvider
{
    public $css = [
        [
            'src' => 'static/alt.css',
            'depends' => []
        ],
        [
            'src' => 'assets/css/main.css',
            'depends' => []
        ],
    ];

    public $js = [
        [
            'src' => 'static/alt.js',
            'footer' => true
        ],
        [
            'src' => 'assets/js/chunk-vendors.js',
            'footer' => true
        ],
        [
            'src' => 'assets/js/main.js',
            'footer' => true
        ]
    ];

    public $adminCss = [];

    public $adminJs = [];

    public function register()
    {
        $this->bootstrap();
    }

    public function bootstrap()
    {
        add_action('wp_enqueue_scripts', [$this, 'render']);
        add_action('admin_enqueue_scripts', [$this, 'adminRender']);
    }

    public function render()
    {
        wp_deregister_script('jquery');

        $version = '0.1';
        foreach ($this->css as $handle => $data) {
            $handle = $this->updateHandle($handle);
            $src    = $this->generateUrl($data['src']);
            wp_enqueue_style($handle, $src, $data['depends'], $version);
        }

        foreach ($this->js as $handle => $data) {
            $handle = $this->updateHandle($handle);
            $src    = $this->generateUrl($data['src']);
            wp_enqueue_script($handle, $src, $data['depends'], $version, $data['footer']);
        }

        wp_localize_script('cf-app', 'cf_vars', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    public function adminRender()
    {
        $version = '0.1';
        foreach ($this->adminCss as $handle => $data) {
            $handle = $this->updateHandle($handle);
            $src    = $this->generateUrl($data['src']);
            wp_enqueue_style($handle, $src, $data['depends'], $version);
        }

        foreach ($this->adminJs as $handle => $data) {
            $handle = $this->updateHandle($handle);
            $src    = $this->generateUrl($data['src']);
            wp_enqueue_script($handle, $src, $data['depends'], $version, $data['footer']);
        }
    }

    public function updateHandle($handle)
    {
        // Remove formation service scripts
        $allowed = preg_match("/^((?!wp-).)*$/", $handle);
        if ($allowed) {
            $handle = sprintf('%s-%s', 'cf', $handle);
        }

        return $handle;
    }

    public function generateUrl($src)
    {
        if (filter_var($src, FILTER_VALIDATE_URL) == false && isset($src)) {
            $src = asset($src);
        }

        return $src;
    }
}