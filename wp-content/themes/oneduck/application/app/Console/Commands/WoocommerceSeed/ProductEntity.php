<?php

namespace App\Console\Commands\WoocommerceSeed;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class ProductEntity
{
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
    public $contractCurrency;
    public $contractPrice;
    public $cashMargin;
    public $cashlessMargin;
    public $rrpMargin;
    public $productCode;
    public $nameOfSupplier;
    public $productCode1C;
    public $shk1;
    public $shk2;
    public $shk3;
    public $brandCountry;
    public $countryProduction;
    public $weight;
    public $volume;
    public $provider;
    private $faker;

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

        $this->contractCurrency = $this->faker->randomElement([
            'byn',
            'rub',
            'usd',
            'eur'
        ]);
        $this->contractPrice = $this->faker->randomFloat(2, 0, 1000);
        $this->cashMargin = $this->faker->randomFloat(2, 0, 100);
        $this->cashlessMargin = $this->faker->randomFloat(2, 0, 100);
        $this->rrpMargin = $this->faker->randomFloat(2, 0, 100);
        $this->productCode = $this->faker->unique()->uuid;
        $this->productCode1C = $this->faker->unique()->uuid;
        $this->nameOfSupplier = ucfirst($this->faker->unique()->words(2, true));
        $this->shk1 = $this->faker->unique()->hexColor;
        $this->shk2 = $this->faker->unique()->hexColor;
        $this->shk3 = $this->faker->unique()->hexColor;
        $this->brandCountry = $this->faker->unique()->country;
        $this->countryProduction = $this->faker->unique()->country;
        $this->weight = rand(0, 100);
        $this->volume = rand(0, 100);
        $this->provider = $this->faker->unique()->company;
    }

    public function setContractCurrency()
    {
        $this->contractCurrency = $this->faker->randomElement([
            'byn',
            'rub',
            'usd',
            'eur'
        ]);
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

    /**
     * @param  mixed  $photo
     */
    public function setPhoto($photo): void
    {

        $this->photo = $photo;
    }

    protected function generatePhoto()
    {
        $random = rand(1, 5);
        $photo = storage_path('placeholders/'.$random.'.jpg');

        return $photo;
    }

    /*
     * Получаем список всех брендов
     * Переводим айди брендов в массив и случайным образом выбираем айди для товара
     * */

    /**
     * @param  mixed  $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    protected function generateBrand()
    {
        $brands = get_terms([
            'taxonomy' => 'product_brand',
            'hide_empty' => false
        ]);

        $brandsId = Arr::pluck($brands, 'term_id');

        return $this->faker->randomElement($brandsId);
    }

    /*
     * Формируем кратность
     * */

    /**
     * @param  mixed  $multiplicity
     */
    public function setMultiplicity($multiplicity): void
    {
        $this->multiplicity = $multiplicity;
    }

    protected function generateMultiplicity()
    {
        $random = $this->faker->randomElement([
            [3, 15, 150],
            [2, 14, 150],
            [15, 30, 150]
        ]);

        $multiplicity = array_map(function ($value) {
            return ['number' => $value];
        }, $random);

        return $multiplicity;
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

    /**
     * @param  mixed  $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

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
}