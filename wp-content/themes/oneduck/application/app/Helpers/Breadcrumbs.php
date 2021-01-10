<?php

namespace App\Helpers;

class Breadcrumbs
{
    protected $items = [];

    public function addItem($name, $url, $active = false)
    {
        $this->items[] = [
            'name' => $name,
            'url' => $url,
            'active' => $active
        ];
    }

    public function get()
    {
        return $this->items;
    }
}