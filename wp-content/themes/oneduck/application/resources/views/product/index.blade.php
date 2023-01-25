<?php
/* @var $product Product */

use App\Modules\Woocommerce\Models\Product;

?>
@extends('layouts.main')

@section('content')
    <main class="main nf__main js-nf__main">
        <section class="tovar__wrap">
            <h1>{{ $product->name }}</h1>
            @if($breadcrumbs)
                @include('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @endif

            <product-single v-bind:product='@json($product)'></product-single>
        </section>
    </main>
@endsection
