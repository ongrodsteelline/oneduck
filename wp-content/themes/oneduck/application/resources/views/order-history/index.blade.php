@extends('layouts.main')

@section('content')
    <main class="main max">
        <section class="history">
            <h1>{{ get_the_title() }}</h1>

            <order-history v-bind:orders='@json($orders)'></order-history>
        </section><!-- /history -->
    </main>
@endsection