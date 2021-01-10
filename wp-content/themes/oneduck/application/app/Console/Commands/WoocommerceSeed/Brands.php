<?php

namespace App\Console\Commands\WoocommerceSeed;

use Illuminate\Console\Command;
use Faker\Factory as Faker;

class Brands
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
        $brands = $this->generateList();

        foreach ($brands as $brand) {
            $this->insert($brand['name']);
        }
    }

    /*
     * Импортируем бренды
     * */
    public function insert($title)
    {
        $term = wp_insert_term($title, 'product_brand');

        if (is_wp_error($term)) {
            $this->console->error($term->get_error_message());
            die;
        }

        $this->console->info(sprintf('Добавлен бренд: %s', $term['term_id']));

        return $term['term_id'];
    }

    /*
     * Удаляем все бренды
     * */
    public function truncate()
    {
        $args = [
            'hide_empty' => 0,
            'taxonomy' => 'product_brand'
        ];
        $brands = get_categories($args);

        foreach ($brands as $brand) {
            wp_delete_term($brand->term_id, 'product_brand');
        }

        $this->console->info(sprintf('Удалено брендов: ' . count($brands)));
    }

    /*
     * Формируем список для импорта
     * */
    protected function generateList()
    {
        $brands = [];

        for ($i = 0; $i++ < 5;) {
            $brands[] = $this->generateEntity();
        }

        return $brands;
    }

    /*
     * Создаем бренд
     * */
    protected function generateEntity()
    {
        $name = ucfirst($this->faker->unique()->word);
        $entity = [
            'name' => $name
        ];

        return $entity;
    }
}