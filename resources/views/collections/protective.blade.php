@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help choosing a protective coating for a concrete floor project.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);

    $useCases = [
        ['label' => 'Wear protection', 'copy' => 'Clear finish coats for floors exposed to abrasion, regular cleaning, and daily traffic.'],
        ['label' => 'UV stability', 'copy' => 'Topcoat options for projects where color retention and long-term appearance matter.'],
        ['label' => 'Concrete protection', 'copy' => 'Protective materials for sealed concrete, terrazzo, tile, and existing coating surfaces.'],
    ];

    $selectionNotes = [
        ['title' => 'Traffic exposure', 'copy' => 'Confirm foot traffic, carts, vehicles, chemical exposure, and cleaning frequency before selecting the finish.'],
        ['title' => 'Finish appearance', 'copy' => 'Choose clear gloss, satin, or compatible protective systems based on the final look and maintenance plan.'],
        ['title' => 'Application timing', 'copy' => 'Ask about recoat windows, cure time, and surface preparation so the installation schedule stays clean.'],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="protective-page-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .72), rgba(5, 18, 37, .18)), url('{{ $collection['image'] }}')">
        <div>
            <p class="eyebrow">Protective coating</p>
            <h1>Clear topcoats and protective finishes for concrete floors.</h1>
            <p>{{ $collection['summary'] }} Built for contractors who need practical product guidance, availability, and pickup support from Hayward, CA.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#protective-products">View Protective Products</a>
                <a class="button button-outline-light" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Protective Coating Hero">Ask For Pricing</a>
            </div>
        </div>
        <aside class="protective-hero-panel">
            <span>Coating focus</span>
            <strong>Polyaspartic, urethane, and clear protective coatings for finished concrete systems.</strong>
            <dl>
                <div>
                    <dt>Use</dt>
                    <dd>Finish coats</dd>
                </div>
                <div>
                    <dt>Support</dt>
                    <dd>Product matching</dd>
                </div>
                <div>
                    <dt>Supply</dt>
                    <dd>Hayward pickup</dd>
                </div>
            </dl>
        </aside>
    </section>

    <section class="protective-use-strip">
        @foreach ($useCases as $case)
            <article>
                <strong>{{ $case['label'] }}</strong>
                <span>{{ $case['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section protective-product-section" id="protective-products">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ $products->count() }} protective products</p>
                <h2>Protective coating products for long-term floor performance.</h2>
            </div>
            <a class="button button-secondary" href="{{ url('/collections/all') }}">View Full Catalog</a>
        </div>
        <div class="product-grid dense protective-product-grid" data-product-grid>
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="section protective-guide-section">
        <div>
            <p class="eyebrow">Selection notes</p>
            <h2>Pick the protective coating around exposure, finish, and schedule.</h2>
            <p>Protective coatings should be selected with the full floor system in mind: substrate, base coat, broadcast media, chemical exposure, UV exposure, and expected maintenance.</p>
        </div>
        <div class="protective-note-grid">
            @foreach ($selectionNotes as $note)
                <article>
                    <strong>{{ $note['title'] }}</strong>
                    <span>{{ $note['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="final-cta protective-final-cta">
        <div>
            <p class="eyebrow">Protective coating help</p>
            <h2>Need the right topcoat for your floor system?</h2>
        </div>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Protective Coating CTA">WhatsApp The Team</a>
    </section>
@endsection
