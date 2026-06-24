@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need a quote for '.$application['title'].' Polycoat materials.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');
@endphp

@extends('layouts.app')

@section('content')
    <section class="waterproofing-detail-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .78), rgba(5, 18, 37, .2)), url('{{ $application['hero_image'] }}')">
        <div>
            <p class="eyebrow">Polycoat waterproofing systems</p>
            <h1>{{ $application['title'] }}</h1>
            <p>{{ $application['summary'] }}</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#waterproofing-system-quote">Request This System</a>
                <a class="button button-outline-light" href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>
            </div>
        </div>
        <aside class="waterproofing-detail-panel">
            <img src="{{ $application['image'] }}" alt="{{ $application['title'] }}" loading="eager" decoding="async">
            <strong>Bay Area Epoxy Wholesale quote support from Hayward, CA.</strong>
            <span>{{ $application['quote_focus'] }}</span>
        </aside>
    </section>

    <section class="waterproofing-detail-nav" aria-label="Waterproofing application pages">
        <a href="{{ url('/pages/deck-waterproofing-in-california') }}">Overview</a>
        @foreach ($applications as $item)
            <a @class(['is-active' => $item['slug'] === $application['slug']]) href="{{ url('/pages/deck-waterproofing-in-california/'.$item['slug']) }}">{{ $item['title'] }}</a>
        @endforeach
    </section>

    <section class="waterproofing-system-strip">
        @foreach ($application['items'] as $item)
            <span>{{ $item }}</span>
        @endforeach
    </section>

    <section class="section waterproofing-system-products">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ count($application['products']) }} system options</p>
                <h2>{{ $application['title'] }} product paths.</h2>
            </div>
            <a class="button button-secondary" href="#waterproofing-system-quote">Request Quote</a>
        </div>
        <div class="waterproofing-system-product-grid">
            @foreach ($application['products'] as $product)
                <article>
                    <div class="waterproofing-system-product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" loading="lazy" decoding="async">
                    </div>
                    <div>
                        <div class="waterproofing-system-product-meta">
                            <span>Polycoat system</span>
                        </div>
                        <h3>{{ $product['title'] }}</h3>
                        <p>{{ $product['summary'] }}</p>
                        <div class="tag-row">
                            @foreach ($product['tags'] as $tag)
                                <span>{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="card-actions">
                            <a class="button button-secondary" href="#waterproofing-system-quote">Details</a>
                            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Enquire</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section waterproofing-system-guidance">
        <div>
            <p class="eyebrow">Quoting notes</p>
            <h2>We will match the system around the actual job conditions.</h2>
        </div>
        <div class="waterproofing-system-note-grid">
            <article>
                <strong>Substrate</strong>
                <span>Concrete, plywood, metal, existing coating, tile-ready assembly, or below-grade surface.</span>
            </article>
            <article>
                <strong>Exposure</strong>
                <span>Pedestrian traffic, vehicular traffic, standing water, UV, chemical exposure, or occupied structure needs.</span>
            </article>
            <article>
                <strong>Schedule</strong>
                <span>Bid due date, installation window, return-to-service requirements, and local pickup timing.</span>
            </article>
        </div>
    </section>

    <section class="waterproofing-quote" id="waterproofing-system-quote">
        <div>
            <p class="eyebrow">Request {{ $application['title'] }} pricing</p>
            <h2>Send the scope and we will help build the material request.</h2>
            <p>For fastest help, call or text <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>. Include drawings, square footage, substrate, exposure, and any named Polycoat system.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $application['title'] }}">WhatsApp This System</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="name" placeholder="Name" required>
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email" required>
            <input name="phone" placeholder="Phone" required>
            <input name="project_location" placeholder="Project location">
            <input name="system_type" value="{{ $application['title'] }}" readonly>
            <input name="square_footage" placeholder="Estimated square footage">
            <input name="timeline" placeholder="Bid or install timeline">
            <textarea name="message" placeholder="Scope notes, substrate, traffic/exposure, desired product path, and specification requirements"></textarea>
            <button class="button button-primary" type="submit">Submit Quote Request</button>
        </form>
    </section>
@endsection
