<?php

namespace App\Core\Wordpress;

class RegisterTaxonomy
{
    protected $taxonomy;
    protected $singular;
    protected $plural;
    protected $args = [];
    protected $postTypes = [];

    public function __construct($taxonomy, $singular, $plural, $settings = [])
    {
        $this->taxonomy = $taxonomy;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->args = $settings;
    }

    public function setPostTypes($types = [])
    {
        $this->postTypes = $types;

        return $this;
    }

    public function register()
    {
        $args = [
            'labels' => [
                'name' => $this->plural,
                'singular_name' => $this->singular,
            ],
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'capabilities' => array(),
            'meta_box_cb' => null,
            'show_admin_column' => false,
            'show_in_rest' => null,
            'rest_base' => null
        ];

        register_taxonomy($this->taxonomy, $this->postTypes, array_replace($args, $this->args));
    }

    public function hideMetabox()
    {
        $this->args['meta_box_cb'] = false;

        return $this;
    }
}