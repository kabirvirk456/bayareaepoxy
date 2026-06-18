@php
    $productUrl = url('/products/'.$product['slug']);
    $message = 'Hi Bay Area Epoxy Wholesale, I would like to enquire about '.$product['title'].'. '.$productUrl;
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
@endphp

@extends('layouts.app')

@section('content')
    <section class="product-detail">
        <div class="product-media">
            <img src="{{ $product['image'] ?: config('bayarea.hero_image') }}" alt="{{ $product['title'] }}">
        </div>
        <div class="product-summary">
            <p class="eyebrow">{{ $product['category'] }}</p>
            <h1>{{ $product['title'] }}</h1>
            <p>{{ $product['summary'] }}</p>
            <div class="tag-row large">
                @foreach ($product['tags'] as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
            <dl class="spec-list">
                <div>
                    <dt>Supply mode</dt>
                    <dd>Wholesale enquiry</dd>
                </div>
                <div>
                    <dt>Location</dt>
                    <dd>Hayward, CA</dd>
                </div>
                <div>
                    <dt>Response</dt>
                    <dd>Call, text, or WhatsApp</dd>
                </div>
            </dl>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Enquire Now</a>
                <a class="button button-secondary" href="tel:{{ config('bayarea.phone_href') }}">Call {{ config('bayarea.phone') }}</a>
            </div>
        </div>
    </section>

    <section class="section muted">
        <div class="two-column">
            <div>
                <p class="eyebrow">Product notes</p>
                <h2>Built for professional coating work.</h2>
                <p>{{ $product['summary'] }}</p>
            </div>
            <ul class="check-list">
                @foreach ($product['details'] as $detail)
                    <li>{{ $detail }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section">
            <div class="section-heading">
                <p class="eyebrow">Related products</p>
                <h2>More from {{ $product['category'] }}.</h2>
            </div>
            <div class="product-grid compact">
                @foreach ($related as $relatedProduct)
                    @include('partials.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </section>
    @endif
@endsection
