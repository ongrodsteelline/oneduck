@extends('layouts.main')

@section('content')
    <main class="main main__pd main_table">
        <section class="catalog">
            <h1>{{ $title }}</h1>
            @if($breadcrumbs)
                @include('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @endif
            @if($isCrawler)
                <div class="switch-wrap form__switch">
                    <label class="switch">
                        <input type="checkbox" class="js-dop_table">
                        <span class="switch__btn"></span>
                        <span class="switch__text">Показать доп. характеристики</span>
                    </label>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="table__img">Фото</th>
                        <th class="table__name">Название</th>
                        <th class="table__article">Артикул</th>
                        <th class="table__brend">Бренд <span><i class="ic-filter_up"></i><i class="ic-filter_down"></i></span>
                        </th>
                        <th class="table__multiplicity">Кратность
                            <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                               title="Вы можете заказать товар только в количестве, кратном указанном"></i>
                        </th>
                        <th class="table__izmer">Ед. изм.</th>
                        <th class="table__scale">Наличие <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__PPC">РРЦ, <span>руб</span></th>
                        <th class="table__cena">Цена, <span>руб</span> <span><i class="ic-filter_up"></i><i
                                        class="ic-filter_down"></i></span></th>
                        <th class="table__basket">В корзину</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        @include('catalog.item', ['product' => $product])
                    @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="pagination__wrap">
                    @include('parts.pagination', ['pagination' => $pagination])
                </nav>
            @else
                <router-view type="{{ $type }}" :category-id="{{ $categoryId }}" :limit="{{ $limit }}" :products='@json($products)' :pages='@json($pagination)'></router-view>
            @endif

            @if($description)
                <p>
                    {!! $description !!}
                </p>
            @endif
        </section>

        @include('catalog.filter')
    </main>
    <div style="opacity: 0.2;" class="preload__wrap">
        <div class="preload-juggle">
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>
@endsection