@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help with '.$category['title'].' for a structural concrete repair project.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');
@endphp

@extends('layouts.app')

@section('content')
    <section class="chemco-detail-hero">
        <div>
            <p class="eyebrow">Chemco Systems CCS product path</p>
            <h1>{{ $category['title'] }}</h1>
            <p>{{ $category['summary'] }}</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#chemco-category-quote" data-track-enquiry data-product="{{ $category['title'] }}">Request Quote</a>
                <a class="button button-secondary" href="{{ url('/pages/structural-concrete-repair') }}">All Repair Products</a>
            </div>
        </div>
        <aside>
            <img src="{{ $category['image'] }}" alt="{{ $category['title'] }}" loading="eager" decoding="async">
        </aside>
    </section>

    <nav class="chemco-page-nav" aria-label="Chemco structural repair product paths">
        <a href="{{ url('/pages/structural-concrete-repair') }}">Overview</a>
        @foreach ($categories as $item)
            <a @class(['is-active' => $item['slug'] === $category['slug']]) href="{{ url('/pages/structural-concrete-repair/'.$item['slug']) }}">{{ $item['title'] }}</a>
        @endforeach
    </nav>

    <section class="section chemco-category-overview">
        <div>
            <p class="eyebrow">Where it fits</p>
            <h2>{{ $category['fit'] }}</h2>
        </div>
        <div class="chemco-prose">
            <p>{{ $category['overview'] }}</p>
            <p>Bay Area Epoxy Wholesale can help narrow the product request around performance requirements, repair geometry, exposure, working time, and job schedule before your team orders material.</p>
        </div>
    </section>

    <section class="chemco-category-applications">
        <div>
            <p class="eyebrow">Common uses</p>
            <h2>Start the quote with the repair condition.</h2>
        </div>
        <ul>
            @foreach ($category['applications'] as $application)
                <li>{{ $application }}</li>
            @endforeach
        </ul>
    </section>

    <section class="section chemco-category-products">
        <div class="section-heading wide-heading">
            <p class="eyebrow">{{ $category['title'] }} products</p>
            <h2>Product names available in this Chemco CCS path.</h2>
            <p>Use these names when sending a quote request, submittal question, or specification review note to the Bay Area Epoxy Wholesale team.</p>
        </div>
        <div class="chemco-product-name-grid">
            @foreach ($category['products'] as $product)
                <article>
                    <strong>{{ $product['name'] }}</strong>
                    <span>{{ $product['summary'] }}</span>
                </article>
            @endforeach
        </div>
        <div class="chemco-product-list-cta">
            <a class="button button-primary" href="#chemco-category-quote" data-track-enquiry data-product="{{ $category['title'] }}">Request {{ $category['title'] }} Quote</a>
            <a class="button button-secondary" href="{{ $phoneHref }}" data-track-enquiry data-product="{{ $category['title'] }}">Call Now</a>
        </div>
    </section>

    <section class="chemco-quote" id="chemco-category-quote">
        <div>
            <p class="eyebrow">Quote notes</p>
            <h2>Send the field details for {{ $category['title'] }}.</h2>
            <p>{{ $category['quote_notes'] }}</p>
            <p>For fastest help, call or text <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $category['title'] }}">WhatsApp Product Request</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="product_path" value="{{ $category['title'] }}" readonly>
            <input name="name" placeholder="Name" required>
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email" required>
            <input name="phone" placeholder="Phone" required>
            <input name="project_location" placeholder="Project location">
            <input name="quantity" placeholder="Linear feet, square feet, or volume">
            <input name="timeline" placeholder="Bid or install timeline">
            <textarea name="message" placeholder="Repair dimensions, exposure, standard/specification, product name if known, and project notes"></textarea>
            <button class="button button-primary" type="submit">Submit Product Request</button>
        </form>
    </section>
@endsection
