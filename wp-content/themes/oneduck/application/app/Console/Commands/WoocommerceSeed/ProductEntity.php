<?php

namespace App\Console\Commands\WoocommerceSeed;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class ProductEntity
{
    private $faker;

    public $title;
    public $sku;
    public $photo;
    public $brand;
    public $multiplicity;
    public $rrp;
    public $unit;
    public $stock;
    public $price;
    public $category;

    public function __construct()
    {
        $this->faker = Faker::create();

        $this->generate();
    }

    /*
     * Формируем модель
     * */
    protected function generate()
    {
        $this->setTitle(ucfirst($this->faker->unique()->words(2, true)));
        $this->setSku($this->faker->unique()->uuid);
        $this->setPhoto($this->generatePhoto());
        $this->setBrand($this->generateBrand());
        $this->setMultiplicity($this->generateMultiplicity());
        $this->setRrp($this->faker->randomFloat(2, 0, 1000));
        $this->setUnit($this->faker->randomElement([
            'шт.',
            'компл.'
        ]));
        $this->setStock(rand(0, 10));
        $this->setPrice($this->faker->randomFloat(2, 0, 1000));
        $this->setCategory($this->generateCategory());
    }

    /**
     * @param  mixed  $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param  mixed  $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    protected function generatePhoto()
    {
        $random = rand(1, 5);
        $photo = storage_path('placeholders/'.$random.'.jpg');

        return $photo;
    }

    /**
     * @param  mixed  $photo
     */
    public function setPhoto($photo): void
    {

        $this->photo = $photo;
    }

    /*
     * Получаем список всех брендов
     * Переводим айди брендов в массив и случайным образом выбираем айди для товара
     * */
    protected function generateBrand()
    {
        $brands = get_terms([
            'taxonomy' => 'product_brand',
            'hide_empty' => false
        ]);

        $brandsId = Arr::pluck($brands, 'term_id');

        return $this->faker->randomElement($brandsId);
    }

    /**
     * @param  mixed  $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /*
     * Формируем кратность
     * */
    protected function generateMultiplicity()
    {
        $random = $this->faker->randomElement([
            [3, 15, 150],
            [2, 14, 150],
            [15, 30, 150]
        ]);

        $multiplicity = array_map(function($value) {
            return ['number' => $value];
        }, $random);

        return $multiplicity;
    }

    /**
     * @param  mixed  $multiplicity
     */
    public function setMultiplicity($multiplicity): void
    {
        $this->multiplicity = $multiplicity;
    }

    /**
     * @param  mixed  $rrp
     */
    public function setRrp($rrp): void
    {
        $this->rrp = $rrp;
    }

    /**
     * @param  mixed  $unit
     */
    public function setUnit($unit): void
    {
        $this->unit = $unit;
    }

    /**
     * @param  mixed  $stock
     */
    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @param  mixed  $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /*
     * Получаем список всех категорий
     * Переводим айди категорий в массив и случайным образом выбираем айди для товара
     * */
    protected function generateCategory()
    {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => 0
        ]);

        $categoriesId = Arr::pluck($categories, 'term_id');

        return $this->faker->randomElement($categoriesId);
    }

    /**
     * @param  mixed  $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }
}