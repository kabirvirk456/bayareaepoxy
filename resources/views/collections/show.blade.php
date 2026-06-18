@extends('layouts.app')

@section('content')
    <section class="page-hero" style="background-image: linear-gradient(90deg, rgba(12, 15, 18, .88), rgba(12, 15, 18, .42)), url('{{ $collection['image'] }}')">
        <div>
            <p class="eyebrow">Catalog collection</p>
            <h1>{{ $collection['title'] }}</h1>
            <p>{{ $collection['summary'] }}</p>
        </div>
    </section>

    <section class="section">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ $products->count() }} products</p>
                <h2>{{ $collection['title'] }}</h2>
            </div>
            <a class="button button-secondary" href="{{ url('/pages/contact') }}">Ask for System Help</a>
        </div>
        <div class="product-grid">
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
