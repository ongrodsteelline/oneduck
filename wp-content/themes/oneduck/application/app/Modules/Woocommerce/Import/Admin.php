<?php

namespace App\Modules\Woocommerce\Import;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use WC_Product_Simple;

class Admin
{
    public function __construct()
    {
        add_filter('wc_product_has_unique_sku', '__return_false');
        add_action('admin_menu', [$this, 'registerPage']);
        add_action('init', [$this, 'request']);
    }

    public function registerPage()
    {
        add_submenu_page(
            'edit.php?post_type=product',
            'Импорт / Экспорт',
            'Импорт / Экспорт',
            'manage_options',
            'cf-wc-import',
            [$this, 'registerPageCallback']
        );
    }

    public function registerPageCallback()
    {
        echo view('admin.import.page', [
            'title' => get_admin_page_title()
        ]);
    }

    public function request()
    {
        $request = request();

        if ($request->get('action') === 'cf_import_product') {
            $this->import($request);
        }

        if ($request->get('action') === 'cf_export_product') {
            $this->export($request);
        }
    }

    public function import($request)
    {
        $file = $request->file('file');

        $inputFileType = IOFactory::identify($file);
        $reader = IOFactory::createReader($inputFileType);

        $spreadsheet = $reader->load($file);
        $items = $spreadsheet->getActiveSheet()->toArray();
        // Убираем первый элемент, в котором указаны имена столбцов
        unset($items[0]);

        $products = collect($items);

        foreach ($products->all() as $item) {
            // Проверяем указано ли имя товара, исключаем таким образом пустые строчки
            if ($item[0] !== null) {
                $title = $item[0];
                $sku = $item[1];
                $description = $item[2];
                $productCode = $item[3];
                $productCode1C = $item[4];
                $nameOfSupplier = $item[5];
                $category = $item[6];
                $shk1 = $item[7];
                $shk2 = $item[8];
                $shk3 = $item[9];
                $brand = $item[10];
                $brandCountry = $item[11];
                $countryProduction = $item[12];
                $weight = $item[13];
                $volume = $item[14];
                $unit = $item[15];
                $multiplicity = $item[16];
                $warehouse = $item[17];
                $contractCurrency = $item[18];
                $contractPrice = $item[19];
                $cashMargin = $item[20];
                $cashlessMargin = $item[21];
                $rrpMargin = $item[22];
                $rrp = $item[23];
                $quantity = $item[24];
                $status = $item[25];

                $findDuplicate = wc_get_products([
                    'meta_key' => 'product_code_1c',
                    'meta_value' => $productCode1C
                ]);

                if (count($findDuplicate)) {
                    $product = $findDuplicate[0];
                } else {
                    $product = new WC_Product_Simple();
                }

                $product->set_name($title);
                $product->set_sku($sku);
                $product->set_description($description);
                $product->set_status($status);

                /*
                 * Устанавливаем категорию товара
                 * Если категория не найдена - создаем
                 * */
                $categories = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'name__like' => $category
                ]);

                if ($categories) {
                    $product->set_category_ids([$categories[0]->term_id]);
                } else {
                    $term = wp_insert_term($category, 'product_cat');
                    $product->set_category_ids([$term['term_id']]);
                }

                $product->save();

                /*
                 * Устанавливаем бренд товара
                 * Если бренд не найден - создаем
                 * */
                $brands = get_terms([
                    'taxonomy' => 'product_brand',
                    'hide_empty' => false,
                    'name__like' => $brand
                ]);

                if ($brands) {
                    wp_set_post_terms($product->get_id(), [$brands[0]->term_id], 'product_brand');
                } else {
                    $term = wp_insert_term($brand, 'product_brand');
                    wp_set_post_terms($product->get_id(), [$term['term_id']], 'product_brand');
                }

                /*
                 * Устанавливаем склад товара
                 * Если бренд не найден - создаем
                 * */
                $warehouseNames = array_map('trim', explode(',', $warehouse));
                $warehouses = get_terms([
                    'taxonomy' => 'product_warehouse',
                    'hide_empty' => false,
                    'name' => $warehouseNames
                ]);

                if ($warehouses) {
                    $warehouseIds = array_map(function ($term) {
                        return $term->term_id;
                    }, $warehouses);
                    wp_set_post_terms($product->get_id(), $warehouseIds, 'product_warehouse');
                    update_post_meta($product->get_id(), 'warehouses', $warehouseIds);

                    if (count($warehouseNames) > count($warehouses)) {
                        $names = array_map(function ($term) {
                            return $term->name;
                        }, $warehouses);

                        $insertWarehouses = array_diff(array_merge($warehouseNames, $names), array_intersect($warehouseNames, $names));
                        $warehouseIds = [];
                        foreach ($insertWarehouses as $name) {
                            $term = wp_insert_term($name, 'product_warehouse');
                            $warehouseIds[] = $term['term_id'];
                        }
                        wp_set_post_terms($product->get_id(), $warehouseIds, 'product_warehouse', true);
                        update_post_meta($product->get_id(), 'warehouses', $warehouseIds);
                    }
                } else {
                    $warehouseIds = [];
                    foreach ($warehouseNames as $name) {
                        $term = wp_insert_term($name, 'product_warehouse');
                        $warehouseIds[] = $term['term_id'];
                    }
                    wp_set_post_terms($product->get_id(), $warehouseIds, 'product_warehouse');
                    update_post_meta($product->get_id(), 'warehouses', $warehouseIds);
                }

                update_post_meta($product->get_id(), 'product_code', $productCode);
                update_post_meta($product->get_id(), 'product_code_1c', $productCode1C);
                update_post_meta($product->get_id(), 'name_of_supplier', $nameOfSupplier);
                update_post_meta($product->get_id(), 'shk1', $shk1);
                update_post_meta($product->get_id(), 'shk2', $shk2);
                update_post_meta($product->get_id(), 'shk3', $shk3);
                update_post_meta($product->get_id(), 'brand_country', $brandCountry);
                update_post_meta($product->get_id(), 'country_production', $countryProduction);
                update_post_meta($product->get_id(), 'weight', $weight);
                update_post_meta($product->get_id(), 'volume', $volume);
                update_post_meta($product->get_id(), 'unit', $unit);
                update_post_meta($product->get_id(), 'contract_currency', mb_strtolower($contractCurrency));
                update_post_meta($product->get_id(), 'contract_price', $contractPrice);
                update_post_meta($product->get_id(), 'cash_margin', $cashMargin);
                update_post_meta($product->get_id(), 'cashless_margin', $cashlessMargin);
                update_post_meta($product->get_id(), 'rrp_margin', $rrpMargin);
                update_post_meta($product->get_id(), 'rrp', $rrp);
                update_post_meta($product->get_id(), '_manage_stock', 'yes');
                update_post_meta($product->get_id(), '_stock_status', 'instock');
                update_post_meta($product->get_id(), '_stock', $quantity);
                update_post_meta($product->get_id(), '_regular_price', 0);

                $multiplicity = explode(' / ', $multiplicity);
                $multiplicityArray = array_map(function ($value) {
                    return ['number' => $value];
                }, $multiplicity);
                update_field('multiplicity', $multiplicityArray, $product->get_id());
            }
        }
    }

    public function export($request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Наименование');
        $sheet->setCellValue('B1', 'Артикул');
        $sheet->setCellValue('C1', 'Описание');
        $sheet->setCellValue('D1', 'Код товара');
        $sheet->setCellValue('E1', 'Код товара (1С)');
        $sheet->setCellValue('F1', 'Наименование в базе поставщика');
        $sheet->setCellValue('G1', 'Категория');
        $sheet->setCellValue('H1', 'ШК1');
        $sheet->setCellValue('I1', 'ШК2');
        $sheet->setCellValue('J1', 'ШК3');
        $sheet->setCellValue('K1', 'Бренд');
        $sheet->setCellValue('L1', 'Родина бренда');
        $sheet->setCellValue('M1', 'Страна производства');
        $sheet->setCellValue('N1', 'Вес');
        $sheet->setCellValue('O1', 'Объем');
        $sheet->setCellValue('P1', 'Единица измерения');
        $sheet->setCellValue('Q1', 'Кратность');
        $sheet->setCellValue('R1', 'Склад');
        $sheet->setCellValue('S1', 'Валюта контракта');
        $sheet->setCellValue('T1', 'Сумма контракта');
        $sheet->setCellValue('U1', 'Наценка (Н)');
        $sheet->setCellValue('V1', 'Наценка (Б)');
        $sheet->setCellValue('W1', 'Наценка РРЦ');
        $sheet->setCellValue('X1', 'РРЦ');
        $sheet->setCellValue('Y1', 'Количество');
        $sheet->setCellValue('Z1', 'Статус');

        $products = wc_get_products([
            'posts_per_page' => $request->get('limit'),
            'offset' => $request->get('offset')
        ]);

        $i = 1;
        foreach ($products as $product) {
            /* @var $product \WC_Product */
            $i++;

            $productCategories = get_the_terms($product->get_id(), 'product_cat');
            $productBrands = get_the_terms($product->get_id(), 'product_brand');
            $productWarehouses = get_the_terms($product->get_id(), 'product_warehouse');

            $sheet->setCellValue('A' . $i, $product->get_name());
            $sheet->setCellValue('B' . $i, $product->get_sku());
            $sheet->setCellValue('C' . $i, $product->get_description());
            $sheet->setCellValue('D' . $i, get_post_meta($product->get_id(), 'product_code', true));
            $sheet->setCellValue('E' . $i, get_post_meta($product->get_id(), 'product_code_1c', true));
            $sheet->setCellValue('F' . $i, get_post_meta($product->get_id(), 'name_of_supplier', true));
            $sheet->setCellValue('G' . $i, $productCategories[0]->name);
            $sheet->setCellValue('H' . $i, get_post_meta($product->get_id(), 'shk1', true));
            $sheet->setCellValue('I' . $i, get_post_meta($product->get_id(), 'shk2', true));
            $sheet->setCellValue('J' . $i, get_post_meta($product->get_id(), 'shk3', true));
            $sheet->setCellValue('K' . $i, $productBrands[0]->name);
            $sheet->setCellValue('L' . $i, get_post_meta($product->get_id(), 'brand_country', true));
            $sheet->setCellValue('M' . $i, get_post_meta($product->get_id(), 'country_production', true));
            $sheet->setCellValue('N' . $i, get_post_meta($product->get_id(), 'weight', true));
            $sheet->setCellValue('O' . $i, get_post_meta($product->get_id(), 'volume', true));
            $sheet->setCellValue('P' . $i, get_post_meta($product->get_id(), 'unit', true));

            $multiplicityField = get_field('multiplicity', $product->get_id());
            $multiplicityArray = array_map(function ($value) {
                return $value['number'];
            }, $multiplicityField);
            $multiplicityString = implode(' / ', $multiplicityArray);
            $sheet->setCellValue('Q' . $i, $multiplicityString);

            $sheet->setCellValue('R' . $i, implode(', ', array_map(function ($term) {
                return $term->name;
            }, $productWarehouses)));
            $sheet->setCellValue('S' . $i, get_post_meta($product->get_id(), 'contract_currency', true));
            $sheet->setCellValue('T' . $i, get_post_meta($product->get_id(), 'contract_price', true));
            $sheet->setCellValue('U' . $i, get_post_meta($product->get_id(), 'cash_margin', true));
            $sheet->setCellValue('V' . $i, get_post_meta($product->get_id(), 'cashless_margin', true));
            $sheet->setCellValue('W' . $i, get_post_meta($product->get_id(), 'rrp_margin', true));
            $sheet->setCellValue('X' . $i, get_post_meta($product->get_id(), 'rrp', true));
            $sheet->setCellValue('Y' . $i, get_post_meta($product->get_id(), '_stock', true));
            $sheet->setCellValue('Z' . $i, $product->get_status());
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="products.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        die();
    }
}
