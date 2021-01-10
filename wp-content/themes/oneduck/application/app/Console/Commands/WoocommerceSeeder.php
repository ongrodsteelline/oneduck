<?php

namespace App\Console\Commands;

use App\Console\Commands\WoocommerceSeed\Brands;
use App\Console\Commands\WoocommerceSeed\Categories;
use App\Console\Commands\WoocommerceSeed\Products;
use Illuminate\Console\Command;

class WoocommerceSeeder extends Command
{
    protected $signature = 'wc:seed {--type=} {--truncate}';
    protected $description = 'Наполнитель для WC';

    public function handle()
    {
        $types = [
            'categories',
            'products',
            'brands'
        ];

        if ($this->option('type') === null) {
            $this->error('Необходимо указать тип наполнителя');
            die;
        }

        if (in_array($this->option('type'), $types) === false) {
            $this->error('Указанного типа наполнителя не существует');
            die;
        }

        switch ($this->option('type')) {
            case 'categories':
                $categories = new Categories($this);
                if ($this->option('truncate')) {
                    if ($this->confirm('Это удалит все категории товаров с сайта, вы уверены?')) {
                        $categories->truncate();
                        return false;
                    }
                }

                $categories->handle();
                break;
            case 'brands':
                $brands = new Brands($this);
                if ($this->option('truncate')) {
                    if ($this->confirm('Это удалит все бренды товаров с сайта, вы уверены?')) {
                        $brands->truncate();
                        return false;
                    }
                }

                $brands->handle();
                break;
            case 'products':
                $products = new Products($this);
                if ($this->option('truncate')) {
                    if ($this->confirm('Это удалит все товары с сайта, вы уверены?')) {
                        $products->truncate();
                        return false;
                    }
                }

                $products->handle();
                break;
        }

    }
}