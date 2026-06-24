@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help with an ESD flooring system for a California project.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);

    $heroChecks = [
        'Conductive flooring systems',
        'Static dissipative flooring systems',
        'Heavy-duty industrial ESD systems',
        'New construction & retrofit projects',
        'Technical product support',
        'California-wide distribution',
    ];

    $heroStats = [
        ['value' => '25K-1M', 'label' => 'ohms conductive range'],
        ['value' => '1M-1B', 'label' => 'ohms static dissipative range'],
        ['value' => '4', 'label' => 'Crown ESD system paths'],
    ];

    $riskCards = [
        ['title' => 'Equipment Damage', 'copy' => 'Sensitive electronics can be damaged when static discharge reaches boards, controls, servers, or test equipment.'],
        ['title' => 'Production Defects', 'copy' => 'Electronics and precision manufacturing teams can see higher failure rates when static is not controlled.'],
        ['title' => 'Operational Downtime', 'copy' => 'Unexpected static-related failures can interrupt production, maintenance windows, and critical facility operations.'],
        ['title' => 'Maintenance Costs', 'copy' => 'Repeated exposure to electrostatic events can shorten equipment service life and increase repair needs.'],
        ['title' => 'Data Loss Risk', 'copy' => 'Server rooms and data centers depend on controlled environments to protect mission-critical infrastructure.'],
    ];

    $industries = [
        ['title' => 'Data Centers & Server Rooms', 'copy' => 'Server, storage, networking, cloud, and AI infrastructure spaces.'],
        ['title' => 'Semiconductor Manufacturing', 'copy' => 'Controlled production areas where static can affect yield and quality.'],
        ['title' => 'Electronics Manufacturing', 'copy' => 'Assembly, test, packaging, and sensitive component production.'],
        ['title' => 'Aerospace Facilities', 'copy' => 'Manufacturing and assembly areas with high-value electronics and controls.'],
        ['title' => 'Battery & Energy Storage', 'copy' => 'Durable ESD systems for growing California energy infrastructure.'],
        ['title' => 'Telecom & Research Labs', 'copy' => 'Communications rooms, test labs, R&D spaces, and clean environments.'],
    ];

    $systems = collect(config('bayarea.esd_systems'))->values();

    $benefits = [
        ['title' => 'Protect Sensitive Equipment', 'copy' => 'Helps reduce the risk of static damage to critical electronics and technology.'],
        ['title' => 'Reduce Downtime', 'copy' => 'Supports uninterrupted operations by minimizing static-related failures.'],
        ['title' => 'Improve Reliability', 'copy' => 'Creates a more stable operating environment for mission-critical facilities.'],
        ['title' => 'Easy To Maintain', 'copy' => 'Seamless surfaces simplify cleaning and maintenance procedures.'],
        ['title' => 'Chemical Resistance', 'copy' => 'Suitable for facilities exposed to industrial chemicals and cleaning agents.'],
        ['title' => 'Long-Term Value', 'copy' => 'Designed to provide years of reliable service in demanding environments.'],
    ];

    $whyUs = [
        ['title' => 'Authorized Distributor', 'copy' => 'Direct access to genuine Crown Polymers ESD systems and technical product information.'],
        ['title' => 'Technical Support', 'copy' => 'Help narrowing conductive versus static dissipative systems based on performance requirements.'],
        ['title' => 'Fast Material Availability', 'copy' => 'Reliable distribution support for California contractors and project teams.'],
        ['title' => 'Specification Assistance', 'copy' => 'Guidance for architects, engineers, facility managers, and installers before mobilization.'],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="esd-hero esd-hero-polished" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .76), rgba(5, 18, 37, .22)), url('{{ asset('assets/esd-crown-hero.jpg') }}')">
        <div class="esd-hero-content">
            <p class="eyebrow">ESD flooring systems California</p>
            <h1>Conductive & Static Dissipative Flooring Solutions For Mission-Critical Facilities</h1>
            <p>Protect sensitive electronics, equipment, manufacturing operations, and critical infrastructure with advanced ESD flooring systems engineered to safely control electrostatic discharge while delivering durable performance in demanding commercial and industrial environments.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#consultation">Request A Consultation</a>
                <a class="button button-outline-light" href="#systems">View ESD Systems</a>
            </div>
        </div>
        <aside class="esd-hero-panel">
            <strong>Authorized Crown Polymers Distributor</strong>
            <span>Serving contractors, facility managers, architects, engineers, and industrial project teams throughout California.</span>
            <div>
                @foreach ($heroStats as $stat)
                    <article>
                        <b>{{ $stat['value'] }}</b>
                        <small>{{ $stat['label'] }}</small>
                    </article>
                @endforeach
            </div>
        </aside>
    </section>

    <nav class="esd-page-nav" aria-label="ESD page sections">
        <a href="#overview">Overview</a>
        <a href="#risk">Risk</a>
        <a href="#industries">Industries</a>
        <a href="#systems">Systems</a>
        <a href="#consultation">Pricing</a>
    </nav>

    <section class="esd-check-strip esd-check-strip-polished">
        @foreach ($heroChecks as $item)
            <span>{{ $item }}</span>
        @endforeach
    </section>

    <section class="section esd-overview" id="overview">
        <div class="esd-overview-copy">
            <p class="eyebrow">What is ESD flooring?</p>
            <h2>ESD flooring gives static electricity a safe route out of the room.</h2>
            <p>When people walk, carts roll, chairs move, or equipment runs, small electrical charges can build up on the floor and on nearby objects. In electronics, data, lab, and manufacturing spaces, that charge can release suddenly into sensitive equipment.</p>
            <p>An ESD floor uses conductive or static-dissipative resin layers, plus grounding points, to move that charge away in a controlled way before it becomes a damaging static shock.</p>
        </div>
        <div class="esd-overview-visual" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .94), rgba(5, 18, 37, .34)), url('{{ asset('assets/home-esd-ai.png') }}')">
            <span>Controlled path to ground</span>
            <strong>Static charge starts here</strong>
            <small>Walking staff, rolling carts, chairs, pallet jacks, and operating equipment can create static.</small>
            <i></i>
            <strong>The ESD floor carries it away</strong>
            <small>Conductive or static-dissipative layers guide the charge through the floor system instead of letting it collect on the surface.</small>
            <i></i>
            <strong>Grounding points drain it safely</strong>
            <small>Copper grounding points connect the floor to the building ground, so static is released gradually and predictably.</small>
        </div>
    </section>

    <section class="section esd-risk-section" id="risk">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Why ESD flooring matters</p>
            <h2>Electrostatic discharge is a serious facility risk.</h2>
            <p>Modern industrial and technology-driven environments contain valuable equipment that can be affected by static generated through normal movement, wheeled traffic, packaging, and environmental conditions.</p>
        </div>
        <div class="esd-risk-grid esd-risk-grid-polished">
            @foreach ($riskCards as $card)
                <article>
                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $card['title'] }}</h3>
                    <p>{{ $card['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section esd-industries esd-industries-polished" id="industries">
        <div>
            <p class="eyebrow">Industries we serve</p>
            <h2>ESD systems for controlled commercial, industrial, and technology environments.</h2>
            <p>Common project types include data centers, semiconductor production, electronics manufacturing, aerospace assembly, laboratories, battery facilities, and telecommunications infrastructure.</p>
        </div>
        <div class="esd-industry-grid">
            @foreach ($industries as $industry)
                <article>
                    <strong>{{ $industry['title'] }}</strong>
                    <span>{{ $industry['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section esd-systems esd-systems-polished" id="systems">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Crown Polymers ESD systems</p>
            <h2>Conductive and static dissipative product paths.</h2>
            <p>Review Crown Polymers ESD system paths for conductive and static dissipative floors before requesting project pricing or specification support.</p>
        </div>
        <div class="esd-system-grid esd-system-grid-polished">
            @foreach ($systems as $system)
                <article class="esd-system-card">
                    <img src="{{ asset($system['image']) }}" alt="{{ $system['title'] }}" loading="lazy" decoding="async">
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
                        <a href="{{ url('/pages/esd-static-dissipative-conductive/'.$system['slug']) }}">System details</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section esd-benefits esd-benefits-polished">
        <div>
            <p class="eyebrow">Benefits</p>
            <h2>Designed to protect facilities where reliability matters.</h2>
        </div>
        <div class="esd-benefit-grid">
            @foreach ($benefits as $benefit)
                <article>
                    <strong>{{ $benefit['title'] }}</strong>
                    <span>{{ $benefit['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section esd-why esd-why-polished">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Why Bay Area Epoxy Wholesale</p>
            <h2>Contractor-focused ESD support from an authorized Crown Polymers distributor.</h2>
        </div>
        <div class="info-grid">
            @foreach ($whyUs as $item)
                <article class="info-panel">
                    <h2>{{ $item['title'] }}</h2>
                    <p>{{ $item['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="esd-consultation esd-consultation-polished" id="consultation">
        <div>
            <p class="eyebrow">Request an ESD flooring consultation</p>
            <h2>Planning a new construction project or facility upgrade?</h2>
            <p>Share your project location, industry, square footage, timeline, and performance requirements. Our team can help identify the right conductive or static dissipative path.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="ESD Flooring Consultation">Request Project Pricing</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="name" placeholder="Name">
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email">
            <input name="phone" placeholder="Phone">
            <input name="project_location" placeholder="Project Location">
            <input name="industry" placeholder="Industry">
            <input name="square_footage" placeholder="Estimated Square Footage">
            <input name="timeline" placeholder="Project Timeline">
            <textarea name="message" placeholder="Message"></textarea>
            <button class="button button-primary" type="submit">Request Project Pricing</button>
        </form>
    </section>
@endsection
