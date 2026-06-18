@extends('layouts.app')

@section('content')
    <section class="page-title-band">
        <p class="eyebrow">Policy</p>
        <h1>{{ $policy['title'] }}</h1>
        <p>{{ $policy['summary'] }}</p>
    </section>
@endsection
