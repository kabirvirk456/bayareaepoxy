@php
    $message = 'Hi Bay Area Epoxy Wholesale, I read '.$post['title'].' and would like product guidance.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
@endphp

@extends('layouts.app')

@section('content')
    <article class="article-detail">
        <p class="eyebrow">Resource</p>
        <time datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}</time>
        <h1>{{ $post['title'] }}</h1>
        <p class="lead">{{ $post['summary'] }}</p>
        <div class="article-body">
            <p>This article is part of the migrated Shopify blog archive. The preserved slug keeps existing SEO paths alive while the content is rewritten into a stronger contractor resource during the next content pass.</p>
            <p>For immediate project guidance, share the substrate condition, traffic type, required finish, square footage, and timeline with the Bay Area Epoxy Wholesale team.</p>
        </div>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $post['title'] }}">Discuss This Topic</a>
    </article>
@endsection
