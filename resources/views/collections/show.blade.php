@extends('layouts.app')

@section('content')
    <section class="page-hero collection-hero" style="background-image: linear-gradient(90deg, rgba(7, 9, 10, .9), rgba(7, 9, 10, .48)), url('{{ $collection['image'] }}')">
        <div>
            <p class="eyebrow">Catalog collection</p>
            <h1>{{ $collection['title'] }}</h1>
            <p>{{ $collection['summary'] }}</p>
        </div>
    </section>

    <section class="section">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow"><span data-visible-count>{{ $products->count() }}</span> products</p>
                <h2>{{ $collection['title'] }}</h2>
            </div>
            <a class="button button-secondary" href="{{ url('/pages/contact') }}">Ask for System Help</a>
        </div>
        @php($categories = $products->pluck('category')->unique()->values())
        @if ($categories->count() > 1)
            <div class="filter-bar" data-filter-group>
                <button class="is-active" type="button" data-filter="all">All</button>
                @foreach ($categories as $category)
                    <button type="button" data-filter="{{ $category }}">{{ $category }}</button>
                @endforeach
            </div>
        @endif
        <div class="product-grid dense" data-product-grid>
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
