<?php

if (is_tax('product_brand')) {
    include get_template_directory() . '/pages/brand.php';
} else {
    include get_template_directory() . '/pages/catalog.php';
}
