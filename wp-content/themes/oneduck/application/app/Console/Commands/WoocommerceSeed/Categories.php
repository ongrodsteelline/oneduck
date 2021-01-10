<?php

namespace App\Console\Commands\WoocommerceSeed;

use Illuminate\Console\Command;
use Faker\Factory as Faker;

class Categories
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
        $categories = $this->generateList();

        foreach ($categories as $category) {
            $this->insert($category['name'], $category['description'], 0, $category['children']);
        }
    }

    /*
     * Импортируем категорию
     * Если есть дети - включаем рекурсию
     * */
    public function insert($title, $description, $parent = 0, $children = [], $level = 0)
    {
        $term = wp_insert_term($title, 'product_cat', [
            'description' => $description,
            'parent' => $parent
        ]);

        if (is_wp_error($term)) {
            $this->console->error($term->get_error_message());
            die;
        }

        /*
         * Выводим сообщение в консоль
         * Добавляем тире для вывода иерархии импорта
         * */
        $consoleSeparate = str_repeat('—', $level);
        $this->console->info(sprintf('%sДобавлена категория: %s', $consoleSeparate, $term['term_id']));

        $level = $level + 1;

        foreach ($children as $child) {
            $this->insert($child['name'], $child['description'], $term['term_id'], $child['children'], $level);
        }

        return $term['term_id'];
    }

    /*
     * Удаляем все категории
     * */
    public function truncate()
    {
        $args = [
            'hide_empty' => 0,
            'taxonomy' => 'product_cat'
        ];
        $categories = get_categories($args);

        foreach ($categories as $category) {
            wp_delete_term($category->term_id, 'product_cat');
        }

        $this->console->info(sprintf('Удалено категорий: ' . count($categories)));
    }

    /*
     * Формируем список категорий для импорта
     * */
    protected function generateList()
    {
        $categories = [];

        for ($i = 0; $i++ < 5;) {
            $categories[] = $this->generateEntityHierarchy();
        }

        return $categories;
    }

    /*
     * Создаем простую категорию
     * */
    protected function generateEntity()
    {
        $name = ucfirst($this->faker->unique()->word);
        $entity = [
            'name' => $name,
            'description' => $this->faker->sentence,
            'children' => []
        ];

        return $entity;
    }

    /*
     * Создаем иерархию категории
     * Максимальный уровень вложенности - 6
     * */
    protected function generateEntityHierarchy($level = 0)
    {
        $entity = $this->generateEntity();
        $level = $level + 1;

        if ($level === 8) {
            return $entity;
        }

        for ($i = 0; $i++ < rand(0, 3);) {
            $entity['children'][$i] = $this->generateEntityHierarchy($level);
        }

        return $entity;
    }
}