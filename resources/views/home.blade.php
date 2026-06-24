@php
    $products = collect(config('bayarea.products'))->values();
    $posts = collect($posts ?? config('bayarea.posts'))->sortByDesc('date')->take(3)->values();
    $productsBySlug = $products->keyBy('slug');
    $heroMessage = 'Hi Bay Area Epoxy Wholesale, I need contractor pricing for an industrial flooring or waterproofing project.';
    $heroWhatsapp = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($heroMessage);
    $heroAsset = asset('assets/home-reference-hero.png');
    $legacyHeroAsset = asset('assets/home-industrial-hero.png');
    $esdAsset = asset('assets/home-esd-ai.png');

    $featuredProducts = collect([
        $productsBySlug->get('crown-polymers-blue-label-epoxy-100-3-gallons-clear'),
        $productsBySlug->get('crown-polymers-blue-label-polyaspartic-100-3-gallons-clear'),
        $productsBySlug->get('814-crowncrete-u-1-4'),
        $productsBySlug->get('1-4-40-lbs-flakes-box'),
    ])->filter()->values();

    $heroBadges = [
        ['icon' => 'shield', 'title' => 'Authorized Crown Distributor'],
        ['icon' => 'gear', 'title' => 'Technical Support'],
        ['icon' => 'cap', 'title' => 'Contractor Training'],
        ['icon' => 'truck', 'title' => 'In Stock California Warehouse'],
        ['icon' => 'fast', 'title' => 'Fast Delivery Across CA'],
    ];

    $stats = [
        ['icon' => 'trophy', 'value' => '50+', 'label' => 'Years Combined Industry Experience'],
        ['icon' => 'plant', 'value' => '1,000+', 'label' => 'Projects Supported'],
        ['icon' => 'shield', 'value' => '4', 'label' => 'Premium Coating Brands'],
        ['icon' => 'gear', 'value' => '100%', 'label' => 'California Coverage'],
        ['icon' => 'headset', 'value' => '24/7', 'label' => 'Technical Support'],
        ['icon' => 'ca', 'value' => '', 'label' => 'Proudly Serving California'],
    ];

    $solutions = [
        [
            'title' => 'Data Centers',
            'subtitle' => 'ESD & Conductive Flooring Systems',
            'url' => url('/pages/esd-static-dissipative-conductive'),
            'image' => $heroAsset,
            'position' => 'center',
        ],
        [
            'title' => 'Warehouses & Logistics',
            'subtitle' => 'Durable Floors Built For Heavy Traffic',
            'url' => url('/blogs/news/best-epoxy-flooring-for-warehouse-in-usa-complete-industrial-guide'),
            'image' => $legacyHeroAsset,
            'position' => 'center',
        ],
        [
            'title' => 'Manufacturing Facilities',
            'subtitle' => 'Chemical & Wear Resistant Systems',
            'url' => url('/collections/urethane-cement'),
            'image' => $heroAsset,
            'position' => '55% center',
        ],
        [
            'title' => 'Parking Structures & Decks',
            'subtitle' => 'Waterproofing & Traffic Coating Systems',
            'url' => url('/pages/deck-waterproofing-in-california'),
            'image' => config('bayarea.collections.protective-coat.image'),
            'position' => 'center',
        ],
        [
            'title' => 'Commercial Spaces',
            'subtitle' => 'Decorative & High Performance Floors',
            'url' => url('/collections/metallic-colors'),
            'image' => config('bayarea.collections.metallic-colors.image'),
            'position' => 'center',
        ],
        [
            'title' => 'Food & Beverage Facilities',
            'subtitle' => 'Hygienic & Seamless Urethane Systems',
            'url' => url('/blogs/news/epoxy-concrete-coatings-the-ideal-solution-for-food-beverage-manufacturing'),
            'image' => config('bayarea.collections.urethane-cement.image'),
            'position' => 'center',
        ],
    ];

    $manufacturers = ['Crown Polymers', 'Polycoat Products', 'Premera', 'General Coatings'];
    $resourceImages = [$heroAsset, $legacyHeroAsset, config('bayarea.collections.protective-coat.image')];

    $capabilities = [
        ['icon' => 'molecule', 'title' => 'Premium Products', 'copy' => 'Industrial grade materials from leading global manufacturers'],
        ['icon' => 'gear', 'title' => 'Technical Expertise', 'copy' => 'On-site recommendations & system selection'],
        ['icon' => 'building', 'title' => 'Training & Education', 'copy' => 'Hands-on programs to build contractor success'],
        ['icon' => 'support', 'title' => 'Project Support', 'copy' => 'Estimations, details & installation guidance'],
        ['icon' => 'quality', 'title' => 'Quality Assurance', 'copy' => 'Consistent performance on every project'],
    ];

    $systemTiles = [
        [
            'label' => 'ESD Flooring Systems',
            'title' => 'For Data Centers & Technology Facilities',
            'copy' => 'Our ESD flooring systems help prevent electrostatic discharge and support long-term performance.',
            'url' => url('/pages/esd-static-dissipative-conductive'),
            'cta' => 'Learn More',
            'image' => $esdAsset,
            'accent' => 'blue',
        ],
        [
            'label' => 'Waterproofing Solutions',
            'title' => 'For Commercial & Industrial Projects',
            'copy' => 'From balconies and decks to rooftops and parking structures, our systems are built to protect and last.',
            'url' => url('/pages/deck-waterproofing-in-california'),
            'cta' => 'Learn More',
            'image' => config('bayarea.collections.protective-coat.image'),
            'accent' => 'gold',
        ],
        [
            'label' => 'Urethane Cement Flooring Systems',
            'title' => 'Built For Extreme Performance',
            'copy' => 'High-strength, chemical resistant and thermal shock resistant systems for the toughest environments.',
            'url' => url('/collections/urethane-cement'),
            'cta' => 'Learn More',
            'image' => $legacyHeroAsset,
            'accent' => 'gold',
        ],
        [
            'label' => 'Contractor Training',
            'title' => 'Hands-On. Real World. Jobsite Focused.',
            'copy' => 'Monthly training programs covering surface prep, moisture mitigation, installation techniques and system applications.',
            'url' => url('/pages/training-schedule'),
            'cta' => 'View Training Schedule',
            'image' => config('bayarea.hero_image'),
            'accent' => 'blue',
        ],
    ];
@endphp

<section class="ref-hero" style="background-image: linear-gradient(90deg, rgba(5, 17, 34, .96) 0%, rgba(5, 17, 34, .82) 31%, rgba(5, 17, 34, .25) 64%, rgba(5, 17, 34, .06) 100%), url('{{ $heroAsset }}')">
    <div class="hero-wall-logo" aria-hidden="true">
        <strong>BAE</strong>
        <span>Bay Area<br>Epoxy Wholesale</span>
    </div>

    <div class="ref-hero-inner">
        <div class="ref-hero-copy">
            <h1>California&rsquo;s Most Trusted Industrial Flooring & Waterproofing <span>Partner</span></h1>
            <p>High-performance epoxy, ESD flooring, urethane cement and waterproofing systems for data centers, warehouses, manufacturing and commercial facilities.</p>

            <div class="ref-hero-badges">
                @foreach ($heroBadges as $badge)
                    <div>
                        <i class="ref-icon ref-icon-{{ $badge['icon'] }}"></i>
                        <strong>{{ $badge['title'] }}</strong>
                    </div>
                @endforeach
            </div>

            <div class="ref-hero-actions">
                <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="Home Contractor Pricing">Get Contractor Pricing</a>
                <a class="button button-outline-light" href="{{ url('/collections/all') }}">Explore Systems</a>
            </div>
        </div>

        <aside class="ref-location-card">
            <div>
                <i class="ref-icon ref-icon-pin"></i>
                <strong>Hayward, California Distribution Hub</strong>
            </div>
            <ul>
                <li>Local Pickup</li>
                <li>Technical Assistance</li>
                <li>Jobsite Support</li>
                <li>California Wide Shipping</li>
            </ul>
        </aside>
    </div>

    <div class="ref-stats-panel" aria-label="Company proof points">
        @foreach ($stats as $stat)
            <div class="ref-stat">
                <i class="ref-icon ref-icon-{{ $stat['icon'] }}"></i>
                @if ($stat['value'])
                    <strong>{{ $stat['value'] }}</strong>
                @endif
                <span>{{ $stat['label'] }}</span>
            </div>
        @endforeach
    </div>
</section>

<section class="ref-solutions">
    <div class="ref-solutions-heading">
        <h2>Solutions For Every Industry</h2>
        <span></span>
    </div>

    <div class="ref-solutions-grid">
        @foreach ($solutions as $solution)
            <a class="ref-solution-card" href="{{ $solution['url'] }}" style="background-image: linear-gradient(180deg, rgba(6, 20, 39, .05), rgba(6, 20, 39, .92)), url('{{ $solution['image'] }}'); background-position: {{ $solution['position'] }};">
                <div>
                    <h3>{{ $solution['title'] }}</h3>
                    <p>{{ $solution['subtitle'] }}</p>
                    <span></span>
                </div>
            </a>
        @endforeach

        <a class="ref-esd-card" href="{{ url('/pages/esd-static-dissipative-conductive') }}" style="background-image: linear-gradient(90deg, rgba(5, 18, 40, .98), rgba(5, 18, 40, .4)), url('{{ $esdAsset }}')">
            <h3>ESD Flooring<br>For The AI Era</h3>
            <p>Future-ready solutions for mission critical infrastructure.</p>
            <span>Learn More</span>
        </a>
    </div>
</section>

<section class="ref-manufacturer-strip">
    <span>Trusted Manufacturers</span>
    @foreach ($manufacturers as $manufacturer)
        <strong>{{ $manufacturer }}</strong>
    @endforeach
</section>

<section class="ref-capabilities">
    <div class="ref-capability-list">
        @foreach ($capabilities as $capability)
            <article>
                <i class="ref-icon ref-icon-{{ $capability['icon'] }}"></i>
                <div>
                    <h3>{{ $capability['title'] }}</h3>
                    <p>{{ $capability['copy'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
    <div class="ref-facility-image" style="background-image: linear-gradient(90deg, rgba(5, 18, 40, .04), rgba(5, 18, 40, .12)), url('{{ $heroAsset }}')">
        <div aria-hidden="true">
            <strong>BAE</strong>
            <span>Epoxy Wholesale</span>
        </div>
    </div>
</section>

<section class="homepage-system-band restored-system-band">
    @foreach ($systemTiles as $tile)
        <a class="homepage-system-tile tile-{{ $tile['accent'] }}" href="{{ $tile['url'] }}" style="background-image: linear-gradient(180deg, rgba(5, 14, 28, .16), rgba(5, 14, 28, .94)), url('{{ $tile['image'] }}')">
            <span>{{ $tile['label'] }}</span>
            <h2>{{ $tile['title'] }}</h2>
            <p>{{ $tile['copy'] }}</p>
            <strong>{{ $tile['cta'] }}</strong>
        </a>
    @endforeach
</section>

<section class="homepage-products-feature section" id="products">
    <div class="homepage-products-copy">
        <p class="eyebrow">Featured products</p>
        <h2>Stock the right system before the crew mobilizes.</h2>
        <p>Browse contractor-ready epoxy, polyaspartic, urethane cement, flakes, pigments, topcoats, and tools. Product pages are built for pricing, stock, pickup, and technical guidance from the Bay Area Epoxy Wholesale team.</p>
        <ul>
            <li>Epoxy base coats and decorative metallic systems</li>
            <li>Polyaspartic and urethane protective topcoats</li>
            <li>CrownCrete U systems for heavy-service floors</li>
            <li>Flakes, pigments, rollers, squeegees, and accessories</li>
        </ul>
        <a class="button button-primary" href="{{ url('/collections/all') }}">View All Products</a>
    </div>
    <div class="home-featured-product-grid">
        @foreach ($featuredProducts as $product)
            @php
                $productUrl = url('/products/'.$product['slug']);
                $priceLabel = isset($product['price']) ? '$'.rtrim(rtrim(number_format((float) $product['price'], 2), '0'), '.') : 'Quote';
            @endphp
            <a class="home-featured-product" href="{{ $productUrl }}">
                <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" loading="lazy">
                <div>
                    <span>{{ $product['category'] }}</span>
                    <h3>{{ $product['title'] }}</h3>
                    <p>{{ $product['summary'] }}</p>
                    <strong>{{ $priceLabel }}</strong>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="homepage-resources section">
    <div class="resources-intro">
        <p class="eyebrow">Latest insights & resources</p>
        <h2>Expert knowledge. Better results.</h2>
        <p>Actionable guides, product notes, and field-focused insights to help you choose the right system before work starts.</p>
        <a class="button button-secondary" href="{{ url('/blogs/news') }}">View All Articles</a>
    </div>
    <div class="resource-card-grid">
        @foreach ($posts as $post)
            @php($resourceImage = $resourceImages[$loop->index] ?? $heroAsset)
            <a class="resource-card" href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">
                <img src="{{ $resourceImage }}" alt="{{ $post['title'] }}" loading="lazy">
                <time datetime="{{ $post['date'] }}">{{ strtoupper(date('M j, Y', strtotime($post['date']))) }}</time>
                <h3>{{ $post['title'] }}</h3>
                <span>Read More</span>
            </a>
        @endforeach
    </div>
</section>

<section class="homepage-final-cta">
    <div>
        <span>Ready to start your next project?</span>
        <p>Our team is here to help you choose the right products and systems.</p>
    </div>
    <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="Home Final CTA">Contact Our Team</a>
</section>
