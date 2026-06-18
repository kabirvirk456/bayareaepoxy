@extends('layouts.app')

@section('content')
    <section class="page-title-band">
        <p class="eyebrow">Catalog search</p>
        <h1>Search Products</h1>
        <form class="large-search" action="{{ route('search') }}" method="get">
            <input type="search" name="q" value="{{ $query }}" placeholder="Search epoxy, flakes, urethane cement">
            <button class="button button-primary" type="submit">Search</button>
        </form>
    </section>

    <section class="section">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ $products->count() }} matches</p>
                <h2>{{ $query ? 'Results for "'.$query.'"' : 'Popular Products' }}</h2>
            </div>
        </div>
        <div class="product-grid dense">
            @forelse ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <div class="empty-state">
                    <h2>No products found</h2>
                    <p>Send the team a WhatsApp message and we can help identify the right system.</p>
                    <a class="button button-primary" href="https://wa.me/{{ config('bayarea.whatsapp_number') }}?text={{ rawurlencode('Hi Bay Area Epoxy Wholesale, I need help finding a product.') }}" data-track-enquiry data-product="Search Empty">Enquire Now</a>
                </div>
            @endforelse
        </div>
    </section>
@endsection
