@php
    $productUrl = url('/products/'.$product['slug']);
    $message = 'Hi Bay Area Epoxy Wholesale, I would like to enquire about '.$product['title'].'. '.$productUrl;
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');
    $priceLabel = isset($product['price']) ? '$'.rtrim(rtrim(number_format((float) $product['price'], 2), '0'), '.') : 'Quote required';
    $details = collect($product['details'] ?? [])->values();
    $tags = collect($product['tags'] ?? [])->values();
    $category = $product['category'];

    $projectTypes = match ($category) {
        'Epoxy Floor Coatings' => ['Garage and shop floors', 'Warehouses and production areas', 'Metallic and broadcast systems', 'Concrete floors needing a durable base coat'],
        'Protective Coatings' => ['Topcoat and finish coat work', 'Chemical and stain exposure', 'UV-stable protective systems', 'Concrete, terrazzo, tile, or existing coating protection'],
        'Urethane Cement' => ['Food and beverage spaces', 'Thermal shock exposure', 'Industrial processing floors', 'Heavy-duty concrete repair and resurfacing'],
        'Cove Base' => ['Vertical cove base work', 'Wall-to-floor transitions', 'Sanitary floor systems', 'High-build detailing'],
        'Accessories' => ['Coating placement', 'Prep and installation tools', 'Professional floor crews', 'Pickup-ready supply orders'],
        'Flakes' => ['Decorative broadcast floors', 'Garage and commercial floors', 'Slip-resistant texture', 'Durable color systems'],
        default => ['Commercial concrete coating work', 'Contractor supply orders', 'Industrial flooring projects', 'Repair and protection scopes'],
    };

    $quoteChecklist = [
        'Project square footage and substrate condition',
        'Target use: primer, base coat, topcoat, repair, or broadcast system',
        'Traffic, chemical, UV, moisture, and return-to-service requirements',
        'Pickup timing, delivery needs, and any spec or product notes',
    ];

    $supportCards = [
        ['title' => 'Contractor pricing', 'copy' => 'Send the product link and project quantity for current availability and quote support.'],
        ['title' => 'Hayward pickup', 'copy' => 'Coordinate local pickup from Bay Area Epoxy Wholesale at 2495 American Ave, Hayward, CA.'],
        ['title' => 'System guidance', 'copy' => 'Match primers, body coats, broadcast media, tools, and topcoats before the crew mobilizes.'],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="product-conversion-hero">
        <div class="product-hero-copy">
            <p class="eyebrow">{{ $category }}</p>
            <h1>{{ $product['title'] }}</h1>
            <p>{{ $product['summary'] }}</p>
            <div class="product-hero-tags">
                @foreach ($tags as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
            <div class="product-hero-actions">
                <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Enquire Now</a>
                <a class="button button-secondary" href="{{ $phoneHref }}">Call {{ config('bayarea.phone') }}</a>
            </div>
        </div>

        <aside class="product-purchase-panel">
            <div class="product-photo-frame">
                <img src="{{ $product['image'] ?: config('bayarea.hero_image') }}" alt="{{ $product['title'] }}" decoding="async" loading="eager">
            </div>
            <div class="product-buy-box">
                <span>Wholesale product enquiry</span>
                <strong>{{ $priceLabel }}</strong>
                <p>Confirm contractor pricing, stock, quantity planning, and pickup timing with the Hayward team.</p>
                <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">WhatsApp Quote</a>
            </div>
        </aside>
    </section>

    <section class="product-confidence-strip">
        @foreach ($supportCards as $card)
            <article>
                <strong>{{ $card['title'] }}</strong>
                <span>{{ $card['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section product-fit-section" id="product-fit">
        <div>
            <p class="eyebrow">Where this product fits</p>
            <h2>{{ $product['title'] }} for {{ strtolower($category) }} projects.</h2>
            <p>{{ $product['summary'] }} Contractors use this page to confirm the product path, send a quote request, and coordinate material pickup before installation.</p>
        </div>
        <div class="product-fit-grid">
            @foreach ($projectTypes as $type)
                <article>{{ $type }}</article>
            @endforeach
        </div>
    </section>

    <section class="section product-spec-section">
        <div class="product-spec-card">
            <p class="eyebrow">Product highlights</p>
            <h2>Key details for ordering and submittal conversations.</h2>
            <ul>
                @foreach ($details as $detail)
                    <li>{{ $detail }}</li>
                @endforeach
            </ul>
        </div>
        <div class="product-order-card">
            <p class="eyebrow">Quote checklist</p>
            <h2>Send the job details once, get a cleaner material answer.</h2>
            <ul>
                @foreach ($quoteChecklist as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Send Product Request</a>
        </div>
    </section>

    <section class="section product-seo-section">
        <div>
            <p class="eyebrow">Bay Area product support</p>
            <h2>Buy {{ $product['title'] }} through a California contractor supply team.</h2>
        </div>
        <div class="product-seo-copy">
            <p>Bay Area Epoxy Wholesale supplies professional {{ strtolower($category) }} products for contractors, installers, property teams, and industrial maintenance crews across the Bay Area and California.</p>
            <p>Use this page when you need pricing, product availability, compatible system components, or pickup coordination for {{ $product['title'] }}. Share the link with project notes so the team can respond with practical next steps instead of a generic cart checkout.</p>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section product-related-section" id="related-products">
            <div class="catalog-toolbar">
                <div>
                    <p class="eyebrow">Related products</p>
                    <h2>More from {{ $category }}.</h2>
                </div>
                <a class="button button-secondary" href="{{ url('/collections/all') }}">View All Products</a>
            </div>
            <div class="product-grid compact">
                @foreach ($related as $relatedProduct)
                    @include('partials.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </section>
    @endif
@endsection
