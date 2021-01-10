<?php

namespace App\Console\Commands\WoocommerceSeed;

use App\Modules\Wordpress\Helpers\Uploader;
use Illuminate\Console\Command;
use Faker\Factory as Faker;

class Products
{
    protected $faker;
    protected $console;

    public function __construct(Command $console)
    {
        $this->faker = Faker::create();
        $this->console = $console;
    }

    public function handle()
    {
        $products = $this->generateList();

        foreach ($products as $product) {
            $this->insert($product);
        }
    }

    /*
     * Импортируем товары
     * */
    public function insert(ProductEntity $product)
    {
        $model = wc_get_product_object('simple');

        $model->set_name($product->title);
        $model->set_sku($product->sku);
        $model->set_regular_price($product->price);

        $attachId = Uploader::uploadFromPath($product->photo);
        $model->set_image_id($attachId);

        $modelId = $model->save();

        wp_set_post_terms($modelId, [$product->brand], 'product_brand');
        wp_set_post_terms($modelId, [$product->category], 'product_cat');

        update_post_meta($modelId, '_manage_stock', 'yes');
        update_post_meta($modelId, '_stock_status', ($product->stock > 0) ? 'instock' : 'outofstock');
        update_post_meta($modelId, '_stock', $product->stock);

        update_post_meta($modelId, 'unit', $product->unit);
        update_post_meta($modelId, 'rrp', $product->rrp);
        update_field('multiplicity', $product->multiplicity, $modelId);

        $this->console->info('Добавлен товар: ' . $modelId);
    }

    /*
     * Удаляем все товары
     * */
    public function truncate()
    {
        $products = wc_get_products([
            'post_status' => get_post_types('', 'names'),
            'posts_per_page' => -1
        ]);

        foreach ($products as $product) {
            $product->delete(true);
        }

        $this->console->info(sprintf('Удалено товаров: '.count($products)));
    }

    /*
     * Формируем список для импорта
     * */
    protected function generateList()
    {
        $products = [];

        for ($i = 0; $i++ < 15;) {
            $products[] = $this->generateEntity();
        }

        return $products;
    }

    /*
     * Создаем товар
     * */
    protected function generateEntity()
    {
        $entity = new ProductEntity();

        return $entity;
    }
}