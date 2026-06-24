@php
    $brand = config('bayarea.brand');
    $pageTitle = isset($title) ? $title.' | '.$brand : $brand;
    $pageDescription = $description ?? 'Wholesale epoxy flooring supplies and waterproofing products for Bay Area contractors.';
    $pageImage = $image ?? config('bayarea.hero_image');
    $whatsapp = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode('Hi Bay Area Epoxy Wholesale, I would like help with epoxy supplies.');
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('bayarea.legal_name') }}">
    <meta property="og:title" content="{{ $title ?? $brand }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? $brand }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">
    @foreach (config('bayarea.tracking.google_site_verifications') as $verification)
        <meta name="google-site-verification" content="{{ $verification }}">
    @endforeach
    <meta name="ahrefs-site-verification" content="{{ config('bayarea.tracking.ahrefs_site_verification') }}">
    <meta name="facebook-domain-verification" content="{{ config('bayarea.tracking.facebook_domain_verification') }}">
    <link rel="stylesheet" href="{{ asset('site.css') }}">
    @include('partials.tracking')
    @isset($schema)
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endisset
</head>
<body>
    @if (config('bayarea.tracking.gtm_id'))
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('bayarea.tracking.gtm_id') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <header class="site-header">
        <div class="nav-shell">
            <a class="brand" href="{{ route('home') }}" aria-label="{{ $brand }}">
                <img src="{{ config('bayarea.logo_image') }}" alt="{{ $brand }}" loading="eager" decoding="async">
            </a>
            <nav class="desktop-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ url('/collections/all') }}">Products</a>
                <a href="{{ url('/pages/structural-concrete-repair') }}">Repair</a>
                <a href="{{ url('/collections/epoxy-for-concrete-floors') }}">Epoxy</a>
                <a href="{{ url('/collections/protective-coat') }}">Protective</a>
                <a href="{{ url('/pages/deck-waterproofing-in-california') }}">Waterproofing</a>
                <a href="{{ url('/pages/esd-static-dissipative-conductive') }}">ESD</a>
                <a href="{{ url('/pages/training-schedule') }}">Training</a>
                <a href="{{ url('/blogs/news') }}">Blogs</a>
                <a href="{{ url('/pages/contact') }}">Contact</a>
            </nav>
            <div class="nav-actions header-contact">
                <a class="header-location" href="{{ url('/pages/contact') }}">Hayward, CA</a>
                <a class="header-phone" href="tel:{{ config('bayarea.phone_href') }}">{{ config('bayarea.phone') }}</a>
            </div>
            <details class="mobile-nav">
                <summary>Menu</summary>
                <nav aria-label="Mobile navigation">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ url('/collections/all') }}">Products</a>
                    <a href="{{ url('/pages/structural-concrete-repair') }}">Structural Concrete Repair</a>
                    <a href="{{ url('/collections/epoxy-for-concrete-floors') }}">Epoxy Floor Coatings</a>
                    <a href="{{ url('/collections/protective-coat') }}">Protective Coating</a>
                    <a href="{{ url('/pages/deck-waterproofing-in-california') }}">Waterproofing</a>
                    <a href="{{ url('/pages/esd-static-dissipative-conductive') }}">ESD Flooring</a>
                    <a href="{{ url('/pages/training-schedule') }}">Training</a>
                    <a href="{{ url('/blogs/news') }}">Blogs</a>
                    <a href="{{ url('/pages/about-us') }}">About</a>
                    <a href="{{ url('/pages/contact') }}">Contact</a>
                    <a href="{{ $whatsapp }}" data-track-enquiry data-product="General">Get Contractor Pricing</a>
                </nav>
            </details>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-grid">
            <div>
                <h2>{{ $brand }}</h2>
                <p>Industrial epoxy, urethane cement, waterproofing, decorative media, and installation supplies from Hayward, CA.</p>
            </div>
            <div>
                <h3>Catalog</h3>
                <a href="{{ url('/pages/structural-concrete-repair') }}">Structural Concrete Repair</a>
                <a href="{{ url('/collections/epoxy-for-concrete-floors') }}">Epoxy Floor Coatings</a>
                <a href="{{ url('/collections/protective-coat') }}">Protective Coatings</a>
                <a href="{{ url('/collections/urethane-cement') }}">Urethane Cement</a>
                <a href="{{ url('/collections/accessories') }}">Accessories</a>
            </div>
            <div>
                <h3>Company</h3>
                <a href="{{ url('/pages/about-us') }}">About Us</a>
                <a href="{{ url('/pages/contact') }}">Contact</a>
                <a href="{{ url('/pages/training-schedule') }}">Training Schedule</a>
                <a href="{{ url('/pages/brochures-resources') }}">Brochures Resources</a>
            </div>
            <div>
                <h3>Policies</h3>
                <a href="{{ url('/policies/privacy-policy') }}">Privacy Policy</a>
                <a href="{{ url('/policies/refund-policy') }}">Refund Policy</a>
                <a href="{{ url('/policies/shipping-policy') }}">Shipping Policy</a>
                <a href="{{ url('/policies/terms-of-service') }}">Terms of Service</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>Copyright &copy; {{ date('Y') }} {{ config('bayarea.legal_name') }}.</span>
            <a href="{{ $whatsapp }}" data-track-enquiry data-product="Footer">WhatsApp {{ config('bayarea.phone') }}</a>
        </div>
    </footer>

    <nav class="mobile-action-bar" aria-label="Quick actions">
        <a href="{{ url('/collections/all') }}">Products</a>
        <a href="tel:{{ config('bayarea.phone_href') }}">Call</a>
        <a class="mobile-action-primary" href="{{ $whatsapp }}" data-track-enquiry data-product="Mobile Bar">WhatsApp</a>
    </nav>

    <script src="{{ asset('site.js') }}" defer></script>
</body>
</html>
