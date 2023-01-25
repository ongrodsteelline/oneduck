<?php

namespace App\Modules\Woocommerce\Models;

use App\Modules\Woocommerce\Exchange\CurrencyBYN;
use App\Modules\Woocommerce\Exchange\CurrencyEUR;
use App\Modules\Woocommerce\Exchange\CurrencyRUB;
use App\Modules\Woocommerce\Exchange\CurrencyUSD;
use App\Modules\Woocommerce\Exchange\Helper;
use Illuminate\Support\Arr;
use WC_Product;
use WP_Post;

class Product
{
    public $id;
    public $name;
    public $description;
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
    public $priceForCash;
    public $priceForCashless;
    public $productCode1C;
    public $brandCountry;
    public $countryProduction;
    public $weight;
    public $volume;
    public $shk1;
    public $shk2;
    public $shk3;
    public $warehouses;
    public $attributes;
    public $related;

    protected $source;
    protected $post;
    protected $nested;

    public function __construct(WP_Post $post, $nested = false)
    {
        $this->post = $post;
        $this->source = wc_get_product($post->ID);
        $this->nested = $nested;
        $this->fill();
    }

    protected function fill()
    {
        $properties = get_object_vars($this);
        unset($properties['source']);
        unset($properties['post']);

        foreach ($properties as $property => $value) {
            if ($this->nested && $property === 'related') {
                continue;
            }

            $method = 'set' . ucfirst($property);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }
    }

    public function setDescription()
    {
        $this->description = $this->getSource()->get_description();
    }

    /**
     * @return WC_Product
     * */
    public function getSource()
    {
        return $this->source;
    }

    public function setProductCode1C()
    {
        $this->productCode1C = get_post_meta($this->post->ID, 'product_code_1c', true);
    }

    public function setBrandCountry()
    {
        $this->brandCountry = get_post_meta($this->post->ID, 'brand_country', true);
    }

    public function setCountryProduction()
    {
        $this->countryProduction = get_post_meta($this->post->ID, 'country_production', true);
    }

    public function setWeight()
    {
        $this->weight = get_post_meta($this->post->ID, 'weight', true);
    }

    public function setVolume()
    {
        $this->volume = get_post_meta($this->post->ID, 'volume', true);
    }

    public function setShk2()
    {
        $this->shk2 = get_post_meta($this->post->ID, 'shk2', true);
    }

    public function setShk3()
    {
        $this->shk3 = get_post_meta($this->post->ID, 'shk3', true);
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

    public function setGallery()
    {
        $this->gallery = $this->getGallery('woocommerce_thumbnail');
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

    public function setWarehouses()
    {
        $terms = wc_get_product_terms($this->post->ID, 'product_warehouse');

        if ($terms) {
            $this->warehouses = $terms;
        }
    }

    public function setMultiplicity()
    {
        $multiplicity = get_field('multiplicity', $this->post->ID);
        if ($multiplicity) {
            $this->multiplicity = Arr::pluck($multiplicity, 'number');
        }
    }

    public function getFirstMultiplicity()
    {
        return ($this->multiplicity) ? $this->multiplicity[0] : 0;
    }

    public function setRrp()
    {
        $manual = get_field('rrp', $this->post->ID);

        if ($manual) {
            $this->rrp = $manual;
        } else {
            $calc = $this->getContractPrice() + (($this->getContractPrice() / 100) * $this->getRrpMargin());

            $this->rrp = Helper::calculate($calc, $this->getContractCurrency());
        }
    }

    public function getContractPrice()
    {
        return get_field('contract_price', $this->id);
    }

    public function getRrpMargin()
    {
        return get_field('rrp_margin', $this->id);
    }

    public function getContractCurrency()
    {
        $currency = get_field('contract_currency', $this->id);

        switch ($currency) {
            case 'byn':
                return new CurrencyBYN();
            case 'rub':
                return new CurrencyRUB();
            case 'usd':
                return new CurrencyUSD();
            case 'eur':
                return new CurrencyEUR();
            default:
                return new CurrencyBYN();
        }
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

    public function getAttributes()
    {
        return $this->source->get_attributes();
    }

    public function getCashMargin()
    {
        return get_field('cash_margin', $this->id);
    }

    public function getCashlessMargin()
    {
        return get_field('cashless_margin', $this->id);
    }

    public function getPriceForCash()
    {
        $calc = $this->getContractPrice() + (($this->getContractPrice() / 100) * $this->getCashMargin());

        return Helper::calculate($calc, $this->getContractCurrency());
    }

    public function setPriceForCash()
    {
        $this->priceForCash = $this->getPriceForCash();
    }

    public function getPriceForCashless()
    {
        $calc = $this->getContractPrice() + (($this->getContractPrice() / 100) * $this->getCashlessMargin());
        return Helper::calculate($calc, $this->getContractCurrency());
    }

    public function setPriceForCashless()
    {
        $this->priceForCashless = $this->getPriceForCashless();
    }

    public function getProductCode()
    {
        return get_field('product_code', $this->id);
    }

    public function getShk1()
    {
        return get_field('shk1', $this->id);
    }

    public function setShk1()
    {
        $this->shk1 = get_post_meta($this->post->ID, 'shk1', true);
    }

    public function setAttributes()
    {
        $attributes = [];
        $taxonomies = wc_get_attribute_taxonomies();

        foreach ($this->source->get_attributes() as $name => $attribute) {
            $tax = $taxonomies['id:' . $attribute->get_id()];

            $args = [
                'key' => $name,
                'label' => wc_attribute_label($name),
                'type' => $tax->attribute_type,
                'values' => null
            ];

            if ($tax->attribute_type === 'select') {
                $args['values'] = array_map(function (\WP_Term $term) {
                    return $term->name;
                }, $attribute->get_terms());
            } else {
                if (count($attribute->get_terms())) {
                    $args['values'] = $attribute->get_terms()[0]->slug === '1' ? true : false;
                }
            }

            $attributes[] = $args;
        }

        $this->attributes = $attributes;
    }

    public function setRelated()
    {
        $this->related = array_map(function ($id) {
            return new Product(get_post($id), true);
        }, $this->source->get_upsell_ids());
    }
}
