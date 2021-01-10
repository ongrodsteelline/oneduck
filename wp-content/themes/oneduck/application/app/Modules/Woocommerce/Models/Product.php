<?php

namespace App\Modules\Woocommerce\Models;

use Illuminate\Support\Arr;

class Product
{
    protected $source;
    protected $post;

    public $id;
    public $name;
    public $image;
    public $gallery;
    public $slug;
    public $status;
    public $sku;
    public $regularPrice;
    public $brand;
    public $multiplicity;
    public $rrp;
    public $unit;
    public $category;
    public $stockQuantity;
    public $url;

    public function __construct(\WP_Post $post)
    {
        $this->post = $post;
        $this->source = wc_get_product($post->ID);
        $this->fill();
    }

    protected function fill()
    {
        $properties = get_object_vars($this);
        unset($properties['source']);
        unset($properties['post']);

        foreach ($properties as $property => $value) {
            $method = 'set' . ucfirst($property);
            $this->{$method}();
        }
    }

    public function setId()
    {
        $this->id = $this->post->ID;
    }

    public function setName()
    {
        $this->name = $this->post->post_title;
    }

    /**
     * @param string $size set thumbnail name
     * @return array
     */
    public function getImage($size)
    {
        return [
            'id' => get_post_thumbnail_id($this->post->ID),
            'url' => wp_get_attachment_image_url(get_post_thumbnail_id($this->post->ID), $size)
        ];
    }

    public function setImage()
    {
        $this->image = $this->getImage('woocommerce_thumbnail');
    }

    public function setGallery()
    {
        $this->gallery = $this->getGallery('woocommerce_thumbnail');
    }

    public function getGallery($size)
    {
        $gallery = [];
        $images = $attachment_ids = $this->source->get_gallery_image_ids();

        $gallery[] = $this->getImage($size);

        foreach ($images as $image) {
            $gallery[] = [
                'id' => $image,
                'url' => wp_get_attachment_image_url($image, $size)
            ];
        }

        return $gallery;
    }

    public function setSlug()
    {
        $this->slug = $this->post->post_name;
    }

    public function setStatus()
    {
        $this->status = $this->post->post_status;
    }

    public function setSku()
    {
        $this->sku = get_post_meta($this->post->ID, '_sku', true);
    }

    public function setRegularPrice()
    {
        $this->regularPrice = get_post_meta($this->post->ID, '_regular_price', true);
    }

    public function setBrand()
    {
        $terms = wc_get_product_terms($this->post->ID, 'product_brand');

        if ($terms) {
            $this->brand = $terms[0];
        }
    }

    public function setMultiplicity()
    {
        $multiplicity = get_field('multiplicity', $this->post->ID);
        $this->multiplicity = Arr::pluck($multiplicity, 'number');
    }

    public function getFirstMultiplicity()
    {
        return ($this->multiplicity) ? $this->multiplicity[0] : 0;
    }

    public function setRrp()
    {
        $this->rrp = get_field('rrp', $this->post->ID);
    }

    public function setUnit()
    {
        $this->unit = get_field('unit', $this->post->ID);
    }

    public function setCategory()
    {
        $this->category = wc_get_product_terms($this->post->ID, 'product_cat');
    }

    public function setStockQuantity()
    {
        $this->stockQuantity = (int)get_post_meta($this->post->ID, '_stock', true);
    }

    public function getStockClass()
    {
        if ($this->stockQuantity >= 0 && $this->stockQuantity <= 3) {
            return 'table__scale_min';
        }

        if ($this->stockQuantity >= 4 && $this->stockQuantity <= 6) {
            return 'table__scale_sr';
        }

        if ($this->stockQuantity >= 7) {
            return 'table__scale_max';
        }
    }

    public function setUrl()
    {
        $this->url = get_permalink($this->post);
    }
}