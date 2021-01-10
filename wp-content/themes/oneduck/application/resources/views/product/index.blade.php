<?php
/* @var $product \App\Modules\Woocommerce\Models\Product */
?>
@extends('layouts.main')

@section('content')
    <main class="main">
        <section class="tovar__wrap">
            <h1>{{ $product->name }}</h1>
            @if($breadcrumbs)
                @include('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @endif

            @if($isCrawler)
                <div class="tovar js-tr__wrap">
                    <div class="tovar__slider">
                        <div class="tovar__slider__bigfoto js-tovar__slider__bigfoto" data-toggle="modal"
                             data-target="#Modal__img">
                            <img src="{{ $product->image['url'] }}" alt="">
                            <span class="js-info info_error" data-toggle="tooltip" data-placement="right"
                                  title="Проверьте кратность"></span>
                            <span class="js-info info_success" data-toggle="tooltip" data-placement="right"
                                  title="Успешно добавлено"></span>
                        </div>

                        <div class="tovar__slider__mini">
                            <div class="swiper-container sl__mini js-sl__mini">
                                <div class="swiper-wrapper">
                                    @foreach($product->gallery as $image)
                                        <div class="swiper-slide sl__mini__slide">
                                            <img src="{{ $image['url'] }}" alt="">
                                            <span class="js-info info_error" data-toggle="tooltip"
                                                  data-placement="right"
                                                  title="Проверьте кратность"></span>
                                            <span class="js-info info_success" data-toggle="tooltip"
                                                  data-placement="right"
                                                  title="Успешно добавлено"></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tovar__content">
                        <div class="tovar__content__top">
                            <div>
                                <p>Артикул</p>
                                <p>{{ $product->sku }}</p>
                            </div>
                            <div>
                                <p>Бренд</p>
                                <p>{{ $product->brand->name }}</p>
                            </div>
                            <div>
                                <p>Кратность <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                                                title=""
                                                data-original-title="Вы можете заказать товар только в количестве, кратном указанном"
                                                aria-describedby="tooltip645723"></i></p>
                                <p>{{ implode(' / ', $product->multiplicity) }}</p>
                            </div>
                            <div>
                                <p>Ед. изм.</p>
                                <p>{{ $product->unit }}</p>
                            </div>
                            <div>
                                <p>Наличие</p>
                                <div class="table__scale {{ $product->getStockClass() }}">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="tovar__content__bot">
                            <div class="tovar__content__bot__head">
                                <p>
                                <span>РЦ, <span>руб</span>
                                    <i class="ic-info js-info"
                                       data-toggle="tooltip"
                                       data-placement="left"
                                       title=""
                                       data-original-title="Вы можете заказать товар только в количестве, кратном указанном"
                                    ></i>
                                </span>
                                    <span>{{ $product->rrp }}</span>
                                </p>
                                <div>
                                    <p><span class="sp_color">Цена, <span>руб</span></span></p>
                                    <p>{{ $product->regularPrice }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('popup.gallery')
            @else
                <product-single v-bind:product='@json($product)'></product-single>
            @endif
        </section>
    </main>
@endsection