@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help with '.$system['title'].' for an ESD flooring project.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');
@endphp

@extends('layouts.app')

@section('content')
    <section class="esd-hero esd-hero-polished esd-system-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .97), rgba(5, 18, 37, .82), rgba(5, 18, 37, .28)), url('{{ asset($system['image']) }}')">
        <div class="esd-hero-content">
            <p class="eyebrow">Crown Polymers ESD system</p>
            <h1>{{ $system['title'] }}</h1>
            <p>{{ $system['summary'] }}</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#esd-system-quote" data-track-enquiry data-product="{{ $system['title'] }}">Request System Pricing</a>
                <a class="button button-outline-light" href="{{ url('/pages/esd-static-dissipative-conductive') }}">All ESD Systems</a>
            </div>
        </div>
        <aside class="esd-hero-panel">
            <strong>{{ $system['type'] }}</strong>
            <span>{{ $system['profile'] }}</span>
            <div>
                <article>
                    <b>{{ $system['resistance'] }}</b>
                    <small>target resistance range</small>
                </article>
                <article>
                    <b>Hayward</b>
                    <small>quote and pickup support</small>
                </article>
            </div>
        </aside>
    </section>

    <nav class="esd-page-nav" aria-label="ESD system pages">
        <a href="{{ url('/pages/esd-static-dissipative-conductive') }}">Overview</a>
        @foreach ($systems as $item)
            <a @class(['is-active' => $item['slug'] === $system['slug']]) href="{{ url('/pages/esd-static-dissipative-conductive/'.$item['slug']) }}">{{ $item['title'] }}</a>
        @endforeach
    </nav>

    <section class="esd-check-strip esd-check-strip-polished esd-system-strip">
        <span>{{ $system['type'] }}</span>
        <span>{{ $system['profile'] }}</span>
        <span>{{ $system['resistance'] }}</span>
    </section>

    <section class="section esd-overview esd-system-overview">
        <div class="esd-overview-copy">
            <p class="eyebrow">System overview</p>
            <h2>{{ $system['title'] }} for controlled ESD environments.</h2>
            <p>{{ $system['overview'] }}</p>
            <p>Use this page to confirm the system direction before sending project notes, drawings, performance requirements, and quantity estimates to the Bay Area Epoxy Wholesale team.</p>
        </div>
        <div class="esd-system-card esd-detail-card">
            <img src="{{ asset($system['image']) }}" alt="{{ $system['title'] }}" loading="eager" decoding="async">
            <div>
                <span class="esd-system-type">{{ $system['type'] }}</span>
                <h3>{{ $system['title'] }}</h3>
                <p>{{ $system['summary'] }}</p>
                <dl>
                    <div>
                        <dt>Build</dt>
                        <dd>{{ $system['profile'] }}</dd>
                    </div>
                    <div>
                        <dt>Resistance</dt>
                        <dd>{{ $system['resistance'] }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <section class="section esd-systems esd-systems-polished esd-build-section">
        <div class="section-heading wide-heading">
            <p class="eyebrow">System build</p>
            <h2>Layers and common project fits.</h2>
            <p>These details help start the quoting conversation. Final suitability should be confirmed around substrate condition, grounding design, resistance requirements, traffic, and maintenance expectations.</p>
        </div>
        <div class="esd-system-details">
            <div>
                <strong>System layers</strong>
                <ul>
                    @foreach ($system['layers'] as $layer)
                        <li>{{ $layer }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <strong>Common fits</strong>
                <div class="esd-tag-row">
                    @foreach ($system['ideal'] as $ideal)
                        <span>{{ $ideal }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="esd-consultation esd-consultation-polished esd-system-consultation" id="esd-system-quote">
        <div>
            <p class="eyebrow">Request {{ $system['title'] }} pricing</p>
            <h2>Send the job conditions and performance target.</h2>
            <p>{{ $system['quote_notes'] }}</p>
            <p>For fastest help, call or text <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $system['title'] }}">WhatsApp System Request</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="system" value="{{ $system['title'] }}" readonly>
            <input name="name" placeholder="Name" required>
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email" required>
            <input name="phone" placeholder="Phone" required>
            <input name="project_location" placeholder="Project location">
            <input name="square_footage" placeholder="Estimated square footage">
            <input name="resistance_target" value="{{ $system['resistance'] }}" readonly>
            <textarea name="message" placeholder="Substrate, traffic, grounding notes, schedule, and specification requirements"></textarea>
            <button class="button button-primary" type="submit">Submit System Request</button>
        </form>
    </section>
@endsection
