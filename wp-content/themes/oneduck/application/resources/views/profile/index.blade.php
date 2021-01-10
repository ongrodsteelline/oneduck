@extends('layouts.main')

@section('content')
    <main class="main">
        <section class="profile">
            <h1>Профиль</h1>
            <profile v-bind:user='@json($user)'></profile>
        </section>
    </main>
@endsection