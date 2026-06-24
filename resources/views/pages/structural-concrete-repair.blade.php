@php
    $message = 'Hi Bay Area Epoxy Wholesale, I need help with Chemco Systems CCS structural concrete repair products.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $phoneHref = 'tel:'.config('bayarea.phone_href');
    $chemcoBase = 'https://www.chemcosystems.com/';
    $categoryCards = collect(config('bayarea.chemco_structural_repair_categories'))->values();

    $audiences = [
        ['title' => 'Concrete repair contractors', 'copy' => 'Fast product direction for crack injection, bonding, patching, grouting, joint repair, control joint fillers, and concrete protection scopes.'],
        ['title' => 'Property managers', 'copy' => 'Practical repair-product support for parking structures, industrial facilities, commercial buildings, warehouses, podium slabs, and maintenance programs.'],
        ['title' => 'Structural engineers', 'copy' => 'Open-specification CCS product direction for ASTM C881, AASHTO M235, Buy America, VOC, LEED, load-bearing, underwater, and chemical-resistant requirements.'],
    ];

    $proofPoints = [
        ['label' => '100% solids', 'copy' => 'Most CCS epoxies and polyureas are built to meet strict VOC requirements and qualify for LEED IEQ 4.1 credits.'],
        ['label' => 'ASTM C881', 'copy' => 'Chemco states CCS structural crack injection products exceed ASTM C881 Type IV / AASHTO M235 requirements for load-bearing applications.'],
        ['label' => '1:1 or 2:1', 'copy' => 'CCS concrete repair products are designed around simple mix ratios for field usability.'],
        ['label' => 'Buy America', 'copy' => 'Chemco states CCS products fully comply with the Buy America Act for U.S. transportation projects using federal funding.'],
    ];

    $applications = [
        'Structural crack injection',
        'Concrete bonding and paste adhesive repairs',
        'Patching, spall repair, and polymer concrete grout',
        'Control joint filler and FAA P606 grout conversations',
        'High-solids concrete protection coatings',
        'Underwater, marine, pier, pile, and port repairs',
        'Chemical-resistant, high-temperature, and large-void repairs',
        'Open specifications for architect and engineer design documents',
    ];

    $resources = [
        ['title' => 'CCS Brochure', 'url' => $chemcoBase.'pdf/CCS-Brochure.pdf'],
        ['title' => 'CCS Chemical Resistance Guide', 'url' => $chemcoBase.'pdf/CCS-Chemical-Resistance-Guide.pdf'],
        ['title' => 'Epoxies for ASTM C881', 'url' => $chemcoBase.'ccs-astm-c881-epoxies.php'],
        ['title' => 'Coating and Crack Quantity Calculator', 'url' => $chemcoBase.'pdf/ccc.pdf'],
        ['title' => 'Product Spec Template', 'url' => $chemcoBase.'ccs_product_spec.php'],
    ];

    $repairTypes = [
        'Crack injection',
        'Bonding adhesive',
        'Control joint filler',
        'Patching or grout',
        'Protective coating',
        'Marine or underwater repair',
        'Engineer specification',
        'Not sure yet',
    ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="chemco-hero" style="background-image: linear-gradient(90deg, rgba(5, 18, 37, .96), rgba(5, 18, 37, .78), rgba(5, 18, 37, .35)), url('{{ $chemcoBase }}images/ccs-1.png')">
        <div class="chemco-hero-copy">
            <p class="eyebrow">Authorized Chemco Systems distributor</p>
            <h1>Structural Concrete Repair Products For Contractors, Property Managers, And Engineers</h1>
            <p>Bay Area Epoxy Wholesale supports Chemco Systems CCS epoxy and polyurea product selection for concrete repair, maintenance, crack injection, bonding, grouting, joint filling, and concrete protection projects.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#chemco-quote" data-track-enquiry data-product="Chemco Structural Concrete Repair">Request Chemco Quote</a>
                <a class="button button-outline-light" href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>
            </div>
            <div class="chemco-hero-proof">
                <span>CCS epoxies and polyureas</span>
                <span>ASTM C881 support</span>
                <span>0 VOC / high-solids options</span>
            </div>
        </div>
    </section>

    <nav class="chemco-page-nav" aria-label="Structural concrete repair sections">
        <a href="#chemco-products">Products</a>
        <a href="#chemco-specs">Specs</a>
        <a href="#chemco-resources">Resources</a>
        <a href="#chemco-quote">Quote</a>
    </nav>

    <section class="chemco-audience-strip">
        @foreach ($audiences as $audience)
            <article>
                <strong>{{ $audience['title'] }}</strong>
                <span>{{ $audience['copy'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="section chemco-intro" id="chemco-overview">
        <div>
            <p class="eyebrow">CCS product line</p>
            <h2>Epoxies and polyureas for structural concrete repair, maintenance, and protection.</h2>
        </div>
        <div class="chemco-prose">
            <p>Chemco CCS Products include a wide selection of epoxy and polyurea products for concrete repair, maintenance, and protection. Bay Area Epoxy Wholesale helps qualified contractors, industrial end users, government agencies, facility maintenance departments, architects, and engineers organize the right repair-product request.</p>
            <p>For design documents, the CCS product line can support open specifications. That makes this page useful for structural engineers and property teams who need repair products organized around performance requirements instead of installer-only programs.</p>
        </div>
    </section>

    <section class="section chemco-products" id="chemco-products">
        <div class="section-heading wide-heading">
            <p class="eyebrow">Chemco CCS categories</p>
            <h2>Match the repair condition to the correct CCS product path.</h2>
        </div>
        <div class="chemco-product-grid">
            @foreach ($categoryCards as $category)
                <article>
                    <a class="chemco-product-image" href="{{ url('/pages/structural-concrete-repair/'.$category['slug']) }}">
                        <img src="{{ $category['image'] }}" alt="{{ $category['title'] }}" loading="lazy" decoding="async">
                    </a>
                    <div>
                        <span>Chemco Systems</span>
                        <h3>{{ $category['title'] }}</h3>
                        <p>{{ $category['summary'] }}</p>
                        <small>{{ $category['fit'] }}</small>
                        <ul class="chemco-card-product-list">
                            @foreach (array_slice($category['products'], 0, 3) as $product)
                                <li>{{ $product['name'] }}</li>
                            @endforeach
                            @if (count($category['products']) > 3)
                                <li>{{ count($category['products']) - 3 }} more products</li>
                            @endif
                        </ul>
                        <a href="{{ url('/pages/structural-concrete-repair/'.$category['slug']) }}">View Product Path</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section chemco-specs" id="chemco-specs">
        <div>
            <p class="eyebrow">Specification notes</p>
            <h2>Use the repair conditions to narrow gel time, viscosity, temperature, water sensitivity, and performance.</h2>
            <p>Chemco highlights CCS options for load-bearing, high-temperature, underwater, primer coating, green concrete, chemical-resistant, large-void, and radiation-tolerant epoxy applications.</p>
        </div>
        <div class="chemco-proof-grid">
            @foreach ($proofPoints as $point)
                <article>
                    <strong>{{ $point['label'] }}</strong>
                    <span>{{ $point['copy'] }}</span>
                </article>
            @endforeach
        </div>
    </section>

    <section class="chemco-application-band">
        <div>
            <p class="eyebrow">Common project requests</p>
            <h2>Send the repair scope, exposure, and structural requirement.</h2>
        </div>
        <ul>
            @foreach ($applications as $application)
                <li>{{ $application }}</li>
            @endforeach
        </ul>
    </section>

    <section class="section chemco-resources" id="chemco-resources">
        <div class="chemco-resource-media">
            <img src="{{ $chemcoBase }}images/ccs-1.png" alt="Chemco CCS structural concrete repair product media" loading="lazy" decoding="async">
        </div>
        <div>
            <p class="eyebrow">Chemco resources</p>
            <h2>Product literature and calculators for repair planning.</h2>
            <p>Use these Chemco resources for submittals, chemical resistance checks, ASTM C881 questions, coating and crack quantity planning, and specification conversations.</p>
            <div class="chemco-resource-links">
                @foreach ($resources as $resource)
                    <a href="{{ $resource['url'] }}" target="_blank" rel="noopener">{{ $resource['title'] }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="chemco-quote" id="chemco-quote">
        <div>
            <p class="eyebrow">Request a Chemco CCS quote</p>
            <h2>We will help organize the repair-product request before the crew mobilizes.</h2>
            <p>For the fastest response, call or text <a href="{{ $phoneHref }}">{{ config('bayarea.phone') }}</a>. Include drawings, crack width/depth, substrate condition, moisture exposure, temperature, traffic, chemical exposure, and schedule.</p>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="Chemco Structural Concrete Repair">WhatsApp Chemco Quote</a>
        </div>
        <form action="mailto:{{ config('bayarea.email') }}" method="post" enctype="text/plain">
            <input name="name" placeholder="Name" required>
            <input name="company" placeholder="Company">
            <input name="email" type="email" placeholder="Email" required>
            <input name="phone" placeholder="Phone" required>
            <input name="project_location" placeholder="Project location">
            <select name="repair_type" required>
                <option value="">Repair type</option>
                @foreach ($repairTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <input name="quantity" placeholder="Linear feet, square feet, or volume">
            <input name="timeline" placeholder="Bid or install timeline">
            <textarea name="message" placeholder="Crack details, substrate, exposure, required standard/specification, product name if known, and any drawings or notes"></textarea>
            <button class="button button-primary" type="submit">Submit Repair Request</button>
        </form>
    </section>
@endsection
