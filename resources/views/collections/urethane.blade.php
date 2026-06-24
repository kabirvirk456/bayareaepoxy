@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help choosing a urethane cement floor system.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');

    $useCases = [
        ['label' => 'Thermal shock areas', 'copy' => 'Urethane cement is commonly selected where hot washdowns, cold rooms, steam, or temperature swings can punish standard coating systems.'],
        ['label' => 'Wet processing floors', 'copy' => 'A good fit for food, beverage, brewery, commercial kitchen, and production environments that see moisture and regular cleaning.'],
        ['label' => 'Heavy service concrete', 'copy' => 'Use thicker slurry or trowel-grade profiles when concrete needs impact resistance, chemical resistance, and long-term resurfacing support.'],
    ];

    $systemProfiles = [
        ['title' => 'Skim coat resurfacing', 'product' => '810 CrownCrete U Skim Coat', 'copy' => 'Thin film roll-applied urethane cement direction for concrete that needs a high-build protective resurfacing layer.'],
        ['title' => '1/8 inch self-leveling', 'product' => '818 CrownCrete U 1/8', 'copy' => 'Flowable urethane cement profile for industrial floors exposed to abrasion, impact, and chemical cleaning.'],
        ['title' => '1/4 inch self-leveling', 'product' => '814 CrownCrete U 1/4', 'copy' => 'A heavier self-leveling mortar path for thermal cycling, industrial service, and thicker concrete protection.'],
        ['title' => '3/8 inch trowel-grade', 'product' => '838 CrownCrete U 3/8 Trowel Grade', 'copy' => 'Dense trowel-applied urethane polymer concrete for the most demanding floor environments and repair builds.'],
    ];

    $selectionSteps = [
        ['title' => 'Start with exposure', 'copy' => 'Confirm hot water, steam, freezer conditions, oils, acids, cleaning chemistry, vehicle traffic, and impact before choosing profile thickness.'],
        ['title' => 'Match surface condition', 'copy' => 'Urethane cement selection should account for substrate soundness, cracks, slope, moisture, existing coatings, and repair depth.'],
        ['title' => 'Plan the finish system', 'copy' => 'Decide whether the floor needs broadcast texture, cove base tie-ins, topcoat compatibility, or fast return-to-service planning.'],
    ];

    $industries = [
        'Commercial kitchens',
        'Breweries and wineries',
        'Food and beverage plants',
        'Cold storage and freezers',
        'Manufacturing floors',
        'Washdown rooms',
        'Service corridors',
        'Industrial concrete repair',
    ];

    $faqs = [
        ['question' => 'What is urethane cement flooring used for?', 'answer' => 'Urethane cement flooring is used on industrial concrete where floors face moisture, thermal shock, chemicals, abrasion, impact, and repeated cleaning.'],
        ['question' => 'Is urethane cement better than epoxy?', 'answer' => 'It depends on exposure. Epoxy is useful for many concrete coating projects, while urethane cement is often chosen for wet processing, hot washdown, freezer, and thermal cycling environments.'],
        ['question' => 'Which CrownCrete U product should I choose?', 'answer' => 'Choose based on profile thickness and service condition. Skim coat, 1/8 inch, 1/4 inch, and 3/8 inch trowel-grade systems serve different resurfacing and heavy-duty needs.'],
        ['question' => 'Can Bay Area Epoxy Wholesale help with product selection?', 'answer' => 'Yes. Send square footage, floor condition, use environment, cleaning exposure, temperature conditions, and target schedule so the Hayward team can help organize the material request.'],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="urethane-page-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .76), rgba(5, 18, 37, .18)), url('{{ $collection['image'] }}')">
        <div>
            <p class="eyebrow">Urethane cement flooring</p>
            <h1>Urethane cement systems for industrial kitchens, breweries, manufacturing, and heavy service concrete.</h1>
            <p>{{ $collection['summary'] }} Bay Area Epoxy Wholesale helps California contractors compare CrownCrete U profiles, request pricing, and coordinate local pickup from Hayward.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#urethane-products">View Urethane Cement Products</a>
                <a class="button button-outline-light" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Urethane Cement Hero">Ask For System Help</a>
            </div>
        </div>
        <aside class="urethane-hero-panel">
            <span>Contractor supply focus</span>
            <strong>CrownCrete U urethane cement products for thermal shock, wet service, and demanding concrete floor environments.</strong>
            <dl>
                <div>
                    <dt>Profiles</dt>
                    <dd>Skim, 1/8, 1/4, and 3/8 inch</dd>
                </div>
                <div>
                    <dt>Supply</dt>
                    <dd>Quote and pickup support</dd>
                </div>
                <div>
                    <dt>Location</dt>
                    <dd>Hayward, California</dd>
                </div>
            </dl>
        </aside>
    </section>

    <section class="urethane-use-strip">
        @foreach ($useCases as $case)
            <article>
                <strong>{{ $case['label'] }}</strong>
                <span>{{ $case['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section urethane-education">
        <div class="urethane-copy">
            <p class="eyebrow">What it solves</p>
            <h2>Urethane cement flooring is built for concrete that works harder than a standard coating can handle.</h2>
            <p>In demanding industrial facilities, the floor is exposed to more than foot traffic. Hot water, rapid temperature swings, forklifts, food acids, oils, caustic cleaners, standing moisture, and constant sanitation cycles can all shorten the life of the wrong floor system.</p>
            <p>Urethane cement, also called urethane concrete or cementitious urethane, is used when contractors need a tough resurfacing system that can tolerate moisture and service conditions common in food processing, commercial kitchens, breweries, production rooms, cold storage, and heavy industrial spaces.</p>
        </div>
        <div class="urethane-feature-list">
            <article>
                <strong>Thermal cycling resistance</strong>
                <span>Useful where floors move between hot washdown, ambient production, and cold service conditions.</span>
            </article>
            <article>
                <strong>Moisture-tolerant project planning</strong>
                <span>Often considered for concrete environments where water exposure and sanitation are part of daily operations.</span>
            </article>
            <article>
                <strong>Industrial resurfacing profiles</strong>
                <span>Choose thinner or thicker CrownCrete U builds depending on slab condition, traffic, and performance need.</span>
            </article>
        </div>
    </section>

    <section class="section urethane-product-section" id="urethane-products">
        <div class="catalog-toolbar">
            <div>
                <p class="eyebrow">{{ $products->count() }} urethane cement products</p>
                <h2>CrownCrete U products for industrial concrete floor systems.</h2>
            </div>
            <a class="button button-secondary" href="{{ $phoneHref }}">Call {{ config('bayarea.phone') }}</a>
        </div>
        <div class="product-grid dense urethane-product-grid" data-product-grid>
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="section urethane-system-section">
        <div>
            <p class="eyebrow">Choose by profile</p>
            <h2>Match the CrownCrete U build to the slab, service condition, and repair depth.</h2>
            <p>For SEO and for real project conversations, the important question is not only "urethane cement" but which thickness and placement method fits the floor. These product paths help contractors narrow the first quote conversation.</p>
        </div>
        <div class="urethane-system-grid">
            @foreach ($systemProfiles as $profile)
                <article>
                    <span>{{ $profile['title'] }}</span>
                    <strong>{{ $profile['product'] }}</strong>
                    <p>{{ $profile['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section urethane-selection-section">
        <div>
            <p class="eyebrow">Selection guidance</p>
            <h2>Better quote requests start with the conditions the floor must survive.</h2>
            <p>Send the team the project use, square footage, current floor condition, target thickness, cleaning method, temperature range, traffic, and schedule. That information helps the material recommendation stay grounded in jobsite reality.</p>
        </div>
        <div class="urethane-step-grid">
            @foreach ($selectionSteps as $step)
                <article>
                    <strong>{{ $step['title'] }}</strong>
                    <span>{{ $step['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section urethane-industry-section">
        <div>
            <p class="eyebrow">Common applications</p>
            <h2>Where contractors specify urethane cement in California.</h2>
        </div>
        <div class="urethane-industry-grid">
            @foreach ($industries as $industry)
                <span>{{ $industry }}</span>
            @endforeach
        </div>
    </section>

    <section class="section urethane-faq-section">
        <div class="section-heading">
            <p class="eyebrow">Urethane cement FAQ</p>
            <h2>Answers for contractors comparing industrial floor systems.</h2>
        </div>
        <div class="faq-grid">
            @foreach ($faqs as $faq)
                <details>
                    <summary>{{ $faq['question'] }}</summary>
                    <p>{{ $faq['answer'] }}</p>
                </details>
            @endforeach
        </div>
    </section>

    <section class="final-cta urethane-final-cta">
        <div>
            <p class="eyebrow">CrownCrete U quote support</p>
            <h2>Need help choosing a urethane cement profile?</h2>
        </div>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Urethane Cement CTA">Request Urethane Cement Pricing</a>
    </section>
@endsection
