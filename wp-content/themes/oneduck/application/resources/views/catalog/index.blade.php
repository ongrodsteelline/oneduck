@extends('layouts.main')

@section('content')
    <main class="main main__pd main_table">


        <section class="catalog">
            <div class="catalog-header">
                <h1>{{ $title }}</h1>
                
                
                <div class="dropdown dropdown__header dropdown__header_path main_area_dropdown">
                    <a class="btn btn-secondary drop__btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ic-list"></i>
                        <i class="ic-arrow_down"></i>
                    </a>
                
                    <div class="dropdown-menu dropdown__header__menu  dropdown__path" aria-labelledby="dropdownMenuLink">
                
                        @if($type === 'category')
                            @include('catalog.wood.index', ['child' => $parentCategory])
                        @endif
                        
                    </div>
                </div>

                
                <selected-filters></selected-filters>
            </div>
            @if($breadcrumbs)
                @include('parts.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            @endif
            
            
           
            
            <router-view category-name="{{ $title }}" type="{{ $type }}" :category-id="{{ $categoryId }}"
                         :limit="{{ $limit }}" :products='@json($products)' :pages='@json($pagination)'
                         :attributes='@json($attributes)' :counter='@json($counter)'></router-view>

            @if($description)
                <p>
                    {!! $description !!}
                </p>
            @endif
            
            
            
            
            
        </section>

        
    </main>
    <div style="opacity: 0.2;" class="preload__wrap">
        <div class="preload-juggle">
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>
@endsection
