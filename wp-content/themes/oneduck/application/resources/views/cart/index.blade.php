@extends('layouts.main')

@section('content')
    <main class="main main__pd main_table max">
        <section class="basket">
            <h1>Корзина</h1>
            <cart v-bind:is-auth="{{ json_encode($isAuth) }}" checkout-url="{{ wc_get_checkout_url() }}"></cart>
        </section>
    </main>
@endsection