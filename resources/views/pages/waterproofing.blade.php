@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need a quote for Polycoat waterproofing materials.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');

    $polycoat = [
        'hero' => 'https://www.polycoatusa.com/wp-content/uploads/2026/02/Waterproofing-Header-Hero-LAX.jpg',
        'logo' => 'https://www.polycoatusa.com/wp-content/uploads/2025/11/Polycoat-All-White-Master.png',
        'project' => 'https://www.polycoatusa.com/wp-content/uploads/2025/08/Featured_Project_hero.jpg',
    ];

    $audiences = [
        ['title' => 'General contractors', 'copy' => 'Support for bid packages, alternates, project schedules, submittal direction, and material availability.'],
        ['title' => 'Waterproofing specialists', 'copy' => 'Polycoat system guidance for decks, traffic areas, below-grade protection, and containment scopes.'],
        ['title' => 'California projects', 'copy' => 'Hayward pickup, quote coordination, and phone support for commercial and multifamily work.'],
    ];

    $applicationCards = collect($applications ?? config('bayarea.waterproofing_applications'))->values();

    $quoteTypes = [
        'Roof or plaza deck',
        'Parking structure or ramp',
        'Below-grade or foundation',
        'Water containment',
        'Pedestrian deck',
        'Vehicular deck',
        'Not sure yet',
    ];

    $industries = [
        [
            'title' => 'Construction',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/08/Construction.jpg',
            'copy' => 'Commercial, multifamily, deck, plaza, and building envelope waterproofing support for active jobsite schedules.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/construction/',
        ],
        [
            'title' => 'Transportation',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/11/Transportation-1.jpg',
            'copy' => 'Traffic coating and waterproofing direction for parking structures, ramps, transit facilities, and vehicle exposure.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/transportation/',
        ],
        [
            'title' => 'Industrial Manufacturing',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/11/Industrial_Manufacturing-1.jpg',
            'copy' => 'Durable protection for industrial substrates exposed to water, abrasion, chemicals, and daily operational wear.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/manufacturing/',
        ],
        [
            'title' => 'Energy',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/11/Energy-1.jpg',
            'copy' => 'Waterproofing and coating support for utility, infrastructure, and service environments with demanding exposure.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/energy/',
        ],
        [
            'title' => 'Defense',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/11/Defense-1.jpg',
            'copy' => 'High-performance protection options for facilities where durability, specification clarity, and reliability matter.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/defense/',
        ],
        [
            'title' => 'Consumer Goods and Recreation',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/08/Consumer_goods.jpg',
            'copy' => 'Coating and waterproofing materials for public-facing spaces, recreation areas, and high-use surfaces.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/consumer-goods-and-recreation/',
        ],
        [
            'title' => 'Entertainment',
            'image' => 'https://www.polycoatusa.com/wp-content/uploads/2025/08/Entertainment.jpg',
            'copy' => 'Waterproofing support for venues, back-of-house infrastructure, pedestrian areas, and exposed assemblies.',
            'url' => 'https://www.polycoatusa.com/industries-we-serve/entertainment/',
        ],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="waterproofing-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .78), rgba(5, 18, 37, .18)), url('{{ $polycoat['hero'] }}')">
        <div class="waterproofing-hero-copy">
            <p class="eyebrow">Authorized Polycoat distributor</p>
            <h1>Polycoat waterproofing systems for commercial decks, parking structures, foundations, and containment projects.</h1>
            <p>Bay Area Epoxy Wholesale supports general contractors and waterproofing specialists with Polycoat epoxy, polyurethane, polyurea, and hybrid systems engineered for water, weather, wear, abrasion, and chemical exposure.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#waterproofing-quote">Request A Quote</a>
                <a class="button button-outline-light" href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>
            </div>
        </div>
        <aside class="waterproofing-hero-panel">
            <img src="{{ $polycoat['logo'] }}" alt="Polycoat Products" loading="eager" decoding="async">
            <strong>Material quoting, pickup coordination, and system direction from Hayward, CA.</strong>
            <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>
        </aside>
    </section>

    <section class="waterproofing-audience-strip">
        @foreach ($audiences as $audience)
            <article>
                <strong>{{ $audience['title'] }}</strong>
                <span>{{ $audience['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section waterproofing-intro">
        <div>
            <p class="eyebrow">Structural protection</p>
            <h2>Waterproofing systems built around movement, traffic, and exposure.</h2>
        </div>
        <div class="waterproofing-prose">
            <p>Polycoat waterproofing systems are used across commercial construction, multifamily, infrastructure, and industrial projects where substrates need durable protection from water intrusion and long-term service conditions.</p>
            <p>For quoting, send us the drawings, traffic type, substrate, square footage, slope or drainage conditions, required finish, and timeline. We can help organize the material request before your crew mobilizes.</p>
        </div>
    </section>

    <section class="section waterproofing-applications" id="waterproofing-applications">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Applications</p>
            <h2>Match the waterproofing system to the scope.</h2>
            <p>Compare common waterproofing paths for decks, parking structures, below-grade assemblies, and containment projects before requesting material support.</p>
        </div>
        <div class="waterproofing-application-grid">
            @foreach ($applicationCards as $application)
                <article>
                    <img src="{{ $application['image'] }}" alt="{{ $application['title'] }}" loading="lazy" decoding="async">
                    <div>
                        <h3>{{ $application['title'] }}</h3>
                        <p>{{ $application['summary'] }}</p>
                        <ul>
                            @foreach ($application['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ url('/pages/deck-waterproofing-in-california/'.$application['slug']) }}">View System Page</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section waterproofing-industries-section">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Industries we serve</p>
            <h2>Polycoat waterproofing systems for construction, transportation, industrial, and infrastructure work.</h2>
            <p>Bay Area Epoxy Wholesale helps contractors narrow Polycoat materials based on project environment, substrate, traffic, exposure, and schedule.</p>
        </div>
        <div class="waterproofing-industry-grid">
            @foreach ($industries as $industry)
                <article>
                    <a href="{{ $industry['url'] }}" target="_blank" rel="noopener" style="background-image: linear-gradient(180deg, rgba(5, 18, 37, .08), rgba(5, 18, 37, .74)), url('{{ $industry['image'] }}')">
                        <span>{{ $industry['title'] }}</span>
                    </a>
                    <p>{{ $industry['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section waterproofing-project-section">
        <div>
            <p class="eyebrow">Featured Polycoat project</p>
            <h2>Metro Station Bus Parking waterproofing, Metro LA.</h2>
            <p>Use Polycoat project references to support waterproofing conversations with owners, architects, consultants, and construction teams.</p>
            <a class="button button-secondary" href="https://www.polycoatusa.com/project/metro-station-bus-parking/" target="_blank" rel="noopener">View Polycoat Project</a>
        </div>
        <img src="{{ $polycoat['project'] }}" alt="Metro LA waterproofing project" loading="lazy" decoding="async">
    </section>

    <section class="waterproofing-quote" id="waterproofing-quote">
        <div>
            <p class="eyebrow">Request a waterproofing quote</p>
            <h2>Send the project details and we will help organize the material request.</h2>
            <p>For fastest help, call or text <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>. You can also use the form below for drawings, scope notes, and bid-stage questions.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Waterproofing Quote">WhatsApp Waterproofing Quote</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="name" placeholder="Name" required>
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email" required>
            <input name="phone" placeholder="Phone" required>
            <input name="project_location" placeholder="Project location">
            <select name="project_type" required>
                <option value="">Project type</option>
                @foreach ($quoteTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <input name="square_footage" placeholder="Estimated square footage">
            <input name="timeline" placeholder="Bid or install timeline">
            <textarea name="message" placeholder="Scope notes, substrate, traffic type, waterproofing area, and any product/spec requirements"></textarea>
            <button class="button button-primary" type="submit">Submit Quote Request</button>
        </form>
    </section>
@endsection
