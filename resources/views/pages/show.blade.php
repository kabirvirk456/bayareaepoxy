@php
    $message = 'Hi Bay Area Epoxy Wholesale, I am on the '.$page['title'].' page and would like help.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
@endphp

@extends('layouts.app')

@section('content')
    <section class="page-title-band">
        <p class="eyebrow">Bay Area Epoxy Wholesale</p>
        <h1>{{ $page['title'] }}</h1>
        <p>{{ $page['summary'] }}</p>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $page['title'] }}">Enquire Now</a>
    </section>

    <section class="section">
        <div class="info-grid">
            @foreach ($page['sections'] as $section)
                <article class="info-panel">
                    <h2>{{ $section['title'] }}</h2>
                    <p>{{ $section['body'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    @if ($page['title'] === 'Contact')
        <section class="split-band">
            <div>
                <p class="eyebrow">Warehouse</p>
                <h2>{{ config('bayarea.address') }}</h2>
                <p>Call, text, or send a WhatsApp enquiry for product availability, contractor pricing, and pickup coordination.</p>
            </div>
            <div class="contact-stack">
                <a class="contact-link" href="tel:{{ config('bayarea.phone_href') }}">{{ config('bayarea.phone') }}</a>
                <a class="contact-link" href="mailto:{{ config('bayarea.email') }}">{{ config('bayarea.email') }}</a>
                <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Contact Page">WhatsApp Chat</a>
            </div>
        </section>
    @endif
@endsection
