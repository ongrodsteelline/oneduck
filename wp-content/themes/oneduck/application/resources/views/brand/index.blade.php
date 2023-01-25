@extends('layouts.main')

@section('content')
    <main class="main main__pd main_table max">
        <section class="basket">
            <h1>{{ $title }}</h1>
            <brand :products="{{ json_encode($products) }}" :brand-id="{{ $brandId }}"></brand>
        </section>
    </main>
@endsection
