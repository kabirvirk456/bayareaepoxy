@php
    $heroMessage = 'Hi Bay Area Epoxy Wholesale, I need help with epoxy flooring supplies for a project.';
    $heroWhatsapp = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($heroMessage);
    $systems = [
        [
            'title' => 'Epoxy Floor Coatings',
            'url' => url('/collections/epoxy-for-concrete-floors'),
            'copy' => '100% solids epoxy, clear epoxy, pigment systems, and base coat materials for garages, warehouses, showrooms, and industrial concrete floors.',
            'keywords' => ['Epoxy resin', 'Concrete coatings', 'Solid color systems'],
        ],
        [
            'title' => 'Polyaspartic & Urethane Topcoats',
            'url' => url('/collections/protective-coat'),
            'copy' => 'Abrasion-resistant clear topcoats, UV-stable urethane finishes, and polyaspartic coatings for longer gloss retention and faster return to service.',
            'keywords' => ['Polyaspartic', 'UV stable topcoat', 'Chemical resistance'],
        ],
        [
            'title' => 'Urethane Cement Systems',
            'url' => url('/collections/urethane-cement'),
            'copy' => 'CrownCrete U skim coat, self-leveling, and trowel-grade materials for kitchens, breweries, food plants, manufacturing, and thermal shock areas.',
            'keywords' => ['Urethane cement', 'Thermal shock', 'Industrial floors'],
        ],
        [
            'title' => 'Flakes, Metallics & Pigments',
            'url' => url('/collections/flakes'),
            'copy' => 'Decorative flakes, metallic pigments, standard epoxy colors, and broadcast media for durable floors with cleaner finish control.',
            'keywords' => ['Epoxy flakes', 'Metallic pigments', 'Color systems'],
        ],
    ];
    $industries = [
        'Commercial garages and showrooms',
        'Warehouses and logistics floors',
        'Food and beverage manufacturing',
        'Wineries, breweries, and production spaces',
        'Commercial kitchens and wet-service areas',
        'Industrial shops and maintenance facilities',
    ];
    $areas = ['Hayward', 'Oakland', 'San Jose', 'San Francisco', 'Fremont', 'San Leandro', 'Santa Clara', 'Walnut Creek', 'Palo Alto', 'Sacramento'];
    $faqs = [
        [
            'question' => 'Do you sell epoxy flooring supplies directly online?',
            'answer' => 'This website is built as a contractor enquiry catalog. Review the products, then send a WhatsApp enquiry for availability, pickup timing, system guidance, and quote support.',
        ],
        [
            'question' => 'What epoxy products do you supply in California?',
            'answer' => 'The catalog includes epoxy coatings, polyaspartic topcoats, urethane topcoats, urethane cement, cove base epoxy, flakes, metallic pigments, solid pigments, rollers, and squeegees.',
        ],
        [
            'question' => 'Can you help choose a complete floor coating system?',
            'answer' => 'Yes. Share the square footage, concrete condition, traffic, chemical exposure, desired finish, and installation schedule. The team can help narrow the primer, base coat, broadcast, and topcoat path.',
        ],
        [
            'question' => 'Where can contractors pick up products?',
            'answer' => 'Bay Area Epoxy Wholesale supports contractors from 2495 American Ave, Hayward, CA 94545. Contact the team before arrival to confirm product availability.',
        ],
    ];
@endphp

<section class="home-hero" style="background-image: linear-gradient(90deg, rgba(9, 11, 10, .9), rgba(9, 11, 10, .62), rgba(9, 11, 10, .22)), url('{{ config('bayarea.hero_image') }}')">
    <div class="home-hero-inner">
        <p class="eyebrow">Epoxy supplier in Hayward, California</p>
        <h1>Epoxy flooring supplies for Bay Area contractors.</h1>
        <p>Wholesale epoxy coatings, urethane cement, polyaspartic topcoats, flakes, pigments, and installation tools with direct WhatsApp quote support from a local supply team.</p>
        <form class="hero-search" action="{{ route('search') }}" method="get">
            <input type="search" name="q" placeholder="Search epoxy, urethane cement, flakes, pigments">
            <button type="submit">Search Catalog</button>
        </form>
        <div class="hero-actions">
            <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="SEO Home Hero">Get Product Guidance</a>
            <a class="button button-light-solid" href="{{ url('/collections/all') }}">View Wholesale Catalog</a>
        </div>
        <div class="hero-trust-line">
            <span>Hayward warehouse</span>
            <span>Contractor pricing enquiries</span>
            <span>Epoxy, urethane cement, topcoats, flakes</span>
        </div>
    </div>
</section>

<section class="intent-panel">
    <div>
        <span>01</span>
        <strong>Find the correct coating system</strong>
        <p>Compare epoxy, urethane cement, protective topcoats, flakes, pigments, and accessories by project need.</p>
    </div>
    <div>
        <span>02</span>
        <strong>Send job details through WhatsApp</strong>
        <p>Share square footage, substrate condition, traffic, finish, and pickup timeline for faster guidance.</p>
    </div>
    <div>
        <span>03</span>
        <strong>Confirm availability before mobilizing</strong>
        <p>Coordinate stock, system components, and contractor pickup from the Hayward supply location.</p>
    </div>
</section>

<section class="section seo-intro">
    <div class="seo-intro-copy">
        <p class="eyebrow">Wholesale epoxy flooring supplies California</p>
        <h2>Built for installers who need the right material before the crew arrives.</h2>
        <p>Bay Area Epoxy Wholesale helps contractors source professional resinous flooring products for concrete floors across California. The catalog is organized for real project decisions: base coat, body coat, broadcast media, color, cove base, urethane cement, polyaspartic topcoat, and installation tools.</p>
        <p>Instead of forcing a generic checkout, every product path leads to an enquiry so you can confirm compatibility, coverage, availability, and pickup timing before work starts.</p>
    </div>
    <aside class="seo-proof">
        <strong>Primary supply categories</strong>
        <ul>
            <li>Epoxy floor coating materials</li>
            <li>Polyaspartic and urethane topcoats</li>
            <li>CrownCrete U urethane cement</li>
            <li>Decorative flakes and metallic pigments</li>
            <li>Rollers, squeegees, and coating tools</li>
        </ul>
    </aside>
</section>

<section class="section solutions-section">
    <div class="section-heading wide-heading">
        <p class="eyebrow">Floor coating systems</p>
        <h2>Professional product paths for concrete coating projects.</h2>
        <p>Choose the system family first, then send a product enquiry for job-specific recommendations and availability.</p>
    </div>
    <div class="solution-grid">
        @foreach ($systems as $system)
            <a class="solution-card" href="{{ $system['url'] }}">
                <span>{{ str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                <h3>{{ $system['title'] }}</h3>
                <p>{{ $system['copy'] }}</p>
                <div>
                    @foreach ($system['keywords'] as $keyword)
                        <em>{{ $keyword }}</em>
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="section industries-section">
    <div>
        <p class="eyebrow">Commercial and industrial applications</p>
        <h2>Epoxy flooring products for demanding concrete environments.</h2>
        <p>From decorative garage systems to heavy-service urethane cement, product selection should follow traffic, chemical exposure, cleaning method, temperature swing, and downtime requirements.</p>
        <a class="button button-primary" href="{{ url('/pages/contact') }}">Request System Help</a>
    </div>
    <div class="industry-list">
        @foreach ($industries as $industry)
            <span>{{ $industry }}</span>
        @endforeach
    </div>
</section>

<section class="section product-showcase">
    <div class="section-heading wide-heading">
        <p class="eyebrow">High-demand contractor supplies</p>
        <h2>Fast paths to popular epoxy, urethane cement, topcoat, and flake products.</h2>
        <p>Each product page keeps the existing Shopify slug for SEO continuity while replacing “Buy Now” with direct enquiry for pricing, stock, and project guidance.</p>
    </div>
    <div class="product-grid dense">
        @foreach ($products as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

<section class="section service-area">
    <div>
        <p class="eyebrow">Bay Area and California supply support</p>
        <h2>Local epoxy supplier for contractors across Northern California.</h2>
        <p>Based in Hayward, Bay Area Epoxy Wholesale supports coating crews, builders, facility teams, and installers looking for professional epoxy flooring supplies near the Bay Area.</p>
    </div>
    <div class="area-grid">
        @foreach ($areas as $area)
            <span>{{ $area }}</span>
        @endforeach
    </div>
</section>

<section class="section faq-section" id="faq">
    <div class="section-heading">
        <p class="eyebrow">Epoxy supplier FAQ</p>
        <h2>Common questions before requesting a quote.</h2>
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

<section class="final-cta">
    <div>
        <p class="eyebrow">Ready to source materials?</p>
        <h2>Send the product list, job size, and timeline. We’ll help you move faster.</h2>
    </div>
    <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="Home Final CTA">Start WhatsApp Enquiry</a>
</section>
