@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help choosing epoxy products for a concrete floor project.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);

    $projectTypes = [
        ['label' => 'Garage & shop floors', 'copy' => 'Base coats, flakes, pigments, and clear finish options for durable concrete coating work.'],
        ['label' => 'Commercial concrete', 'copy' => 'Contractor-ready epoxy materials for showrooms, service areas, warehouses, and workspaces.'],
        ['label' => 'Decorative systems', 'copy' => 'Metallic pigments, solid colors, and broadcast flakes for custom floor finishes.'],
    ];

    $steps = [
        ['title' => 'Choose the base coat', 'copy' => 'Start with clear or pigmented epoxy based on the floor condition, desired finish, and broadcast plan.'],
        ['title' => 'Select color or media', 'copy' => 'Add flakes, solid pigment, or metallic pigment depending on the look and texture required.'],
        ['title' => 'Confirm the finish', 'copy' => 'Ask the team about topcoat compatibility, traffic exposure, and cure schedule before installation.'],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="epoxy-page-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .74), rgba(5, 18, 37, .18)), url('{{ $collection['image'] }}')">
        <div>
            <p class="eyebrow">Epoxy for concrete floors</p>
            <h1>Epoxy floor coatings, flakes, pigments, and clear systems.</h1>
            <p>{{ $collection['summary'] }} Built for contractors who need fast product selection, pricing support, and pickup coordination from Hayward, CA.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#epoxy-products">View Epoxy Products</a>
                <a class="button button-outline-light" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Epoxy Collection Hero">Ask For Pricing</a>
            </div>
        </div>
        <aside class="epoxy-hero-panel">
            <span>Epoxy product focus</span>
            <strong>Base coats, clear epoxy, flakes, pigments, and metallic floor systems.</strong>
            <dl>
                <div>
                    <dt>Supply</dt>
                    <dd>Wholesale enquiry</dd>
                </div>
                <div>
                    <dt>Pickup</dt>
                    <dd>Hayward, CA</dd>
                </div>
                <div>
                    <dt>Support</dt>
                    <dd>Call, text, or WhatsApp</dd>
                </div>
            </dl>
        </aside>
    </section>

    <section class="epoxy-project-strip">
        @foreach ($projectTypes as $type)
            <article>
                <strong>{{ $type['label'] }}</strong>
                <span>{{ $type['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section epoxy-product-section" id="epoxy-products">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ $products->count() }} epoxy products</p>
                <h2>Epoxy products for concrete floor systems.</h2>
            </div>
            <a class="button button-secondary" href="{{ url('/collections/all') }}">View Full Catalog</a>
        </div>
        <div class="product-grid dense epoxy-product-grid" data-product-grid>
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="section epoxy-guide-section">
        <div>
            <p class="eyebrow">How to select</p>
            <h2>Match the epoxy products to the installation plan.</h2>
            <p>Tell the team about the concrete condition, square footage, desired color, traffic exposure, and whether the floor needs flakes, pigment, metallic effects, or a clear finish.</p>
        </div>
        <div class="epoxy-step-grid">
            @foreach ($steps as $step)
                <article>
                    <strong>{{ $step['title'] }}</strong>
                    <span>{{ $step['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="final-cta epoxy-final-cta">
        <div>
            <p class="eyebrow">Contractor pricing</p>
            <h2>Need help building the epoxy material list?</h2>
        </div>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Epoxy Collection CTA">WhatsApp The Team</a>
    </section>
@endsection
