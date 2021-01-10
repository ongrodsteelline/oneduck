@extends('layouts.main')

@section('content')
    <main class="main">
        @if($isOrderReceived)
            @include('checkout.order-received')
        @else
            <checkout v-bind:is-auth="{{ json_encode($isAuth) }}" customer-address="{{ $address }}"></checkout>
        @endif
    </main>
@endsection