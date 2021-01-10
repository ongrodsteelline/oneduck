@extends('layouts.main')

@section('content')
    <main class="main">
        <div class="search-result">
            @if(!strlen($query))
                Необходимо указать поисковой запрос
            @endif
            @if(count($categories) === 0 && count($products) === 0 && $query)
                Ничего не найдено по запросу "{{ $query }}"
            @endif
            @if(count($categories))
                <div class="search-result__row">
                    <div class="search-result__title">Категории:</div>
                    <div class="search-result__list">
                        @foreach($categories as $category)
                            <a href="{{ $category['url'] }}">{{ $category['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($products))
                <div class="search-result__row">
                    <div class="search-result__title">Товары:</div>
                    <div class="search-result__list">
                        @foreach($products as $product)
                            <a href="{{ $product['url'] }}">{{ $product['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection