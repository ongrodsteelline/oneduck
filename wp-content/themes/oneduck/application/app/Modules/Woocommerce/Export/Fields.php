<?php

namespace App\Modules\Woocommerce\Export;

use App\Modules\Woocommerce\Models\Product;
use Illuminate\Support\Arr;

class Fields
{
    protected $orderId;
    protected $productId;

    public function __construct($orderId, $productId)
    {
        $this->orderId = $orderId;
        $this->productId = $productId;
    }

    public function fields()
    {
        return [
            [
                'key' => 'title',
                'title' => 'Наименование',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getProduct()->get_name()
            ],
            [
                'key' => 'sku',
                'title' => 'Артикул',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getProduct()->get_sku()
            ],
            [
                'key' => 'brand',
                'title' => 'Бренд',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getBrand()
            ],
            [
                'key' => 'unit',
                'title' => 'Единица измерения',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getUnit()
            ],
            [
                'key' => 'multiplicity',
                'title' => 'Кратность',
                'forAdmin' => false,
                'forClient' => true,
                'value' => $this->getMultiplicity()
            ],
            [
                'key' => 'contract_currency',
                'title' => 'Валюта контракта',
                'forAdmin' => true,
                'forClient' => false,
                'value' => $this->getContractCurrency()
            ],
            [
                'key' => 'contract_price',
                'title' => 'Сумма контракта',
                'forAdmin' => true,
                'forClient' => false,
                'value' => $this->getContractPrice()
            ],
            [
                'key' => 'product_code',
                'title' => 'Код продукта',
                'forAdmin' => true,
                'forClient' => false,
                'value' => $this->getProductCode()
            ],
            [
                'key' => 'product_code_1c',
                'title' => 'Код продукта (1C)',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getProductCode1C()
            ],
            [
                'key' => 'name_of_supplier',
                'title' => 'Наименование в базе поставщика',
                'forAdmin' => true,
                'forClient' => false,
                'value' => $this->getNameOfSupplier()
            ],
            [
                'key' => 'shk1',
                'title' => 'ШК1',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getShk1()
            ],
            [
                'key' => 'rrp',
                'title' => 'РРЦ',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getRrp()
            ],
            [
                'key' => 'price',
                'title' => 'Цена',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getPrice()
            ],
            [
                'key' => 'comment',
                'title' => 'Комментарий',
                'forAdmin' => true,
                'forClient' => true,
                'value' => $this->getComment()
            ]
        ];
    }

    public function getProduct()
    {
        return wc_get_product($this->productId);
    }

    public function getOrder()
    {
        return wc_get_order($this->orderId);
    }

    public function getProductCode()
    {
        return get_field('product_code', $this->productId);
    }

    public function getProductCode1C()
    {
        return get_field('product_code_1c', $this->productId);
    }

    public function getNameOfSupplier()
    {
        return get_field('name_of_supplier', $this->productId);
    }

    public function getShk1()
    {
        return get_field('shk1', $this->productId);
    }

    public function getBrand()
    {
        $terms = wc_get_product_terms($this->productId, 'product_brand');

        if ($terms) {
            return $terms[0]->name;
        }
    }

    public function getUnit()
    {
        return get_field('unit', $this->productId);
    }

    public function getMultiplicity()
    {
        $value = get_field('multiplicity', $this->productId);
        $value = Arr::pluck($value, 'number');

        return implode(' / ', $value);
    }

    public function getContractCurrency()
    {
        return mb_strtoupper(get_field('contract_currency', $this->productId));
    }

    public function getContractPrice()
    {
        return get_field('contract_price', $this->productId);
    }

    public function getPrice()
    {
        foreach ($this->getOrder()->get_items() as $item) {
            if ($this->productId === $item->get_data()['product_id']) {
                return $item->get_data()['total'];
            }
        }
    }

    public function getRrp()
    {
        foreach ($this->getOrder()->get_items() as $item) {
            if ($this->productId === $item->get_data()['product_id']) {
                return $item->get_meta('_product_rrp');
            }
        }
    }

    public function getComment()
    {
        foreach ($this->getOrder()->get_items() as $item) {
            if ($this->productId === $item->get_data()['product_id']) {
                return $item->get_meta('_comment');
            }
        }
    }
}
