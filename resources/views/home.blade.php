@php
    $heroMessage = 'Hi Bay Area Epoxy Wholesale, I need help choosing epoxy flooring supplies.';
    $heroWhatsapp = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($heroMessage);
@endphp
<section class="hero" style="background-image: linear-gradient(90deg, rgba(12, 15, 18, .88), rgba(12, 15, 18, .55), rgba(12, 15, 18, .18)), url('{{ config('bayarea.hero_image') }}')">
    <div class="hero-content">
        <p class="eyebrow">Hayward, CA wholesale supply</p>
        <h1>Bay Area Epoxy Wholesale</h1>
        <p>Industrial epoxy, urethane cement, waterproofing, flakes, pigments, and installation supplies for contractors across the Bay Area and California.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="Home Hero">Enquire Now</a>
            <a class="button button-light" href="{{ url('/collections/all') }}">View Products</a>
        </div>
    </div>
</section>

<section class="trust-strip">
    <div>
        <strong>Local pickup</strong>
        <span>Hayward warehouse support</span>
    </div>
    <div>
        <strong>Contractor focused</strong>
        <span>System-based product guidance</span>
    </div>
    <div>
        <strong>Direct enquiry</strong>
        <span>WhatsApp and call/text support</span>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Shop by system</p>
        <h2>Find the right coating path faster.</h2>
        <p>Products are grouped by real floor systems so crews can move from project condition to material list quickly.</p>
    </div>
    <div class="system-grid">
        @foreach ($collections as $slug => $collection)
            <a class="system-panel" href="{{ url('/collections/'.$slug) }}">
                <img src="{{ $collection['image'] }}" alt="{{ $collection['title'] }}" loading="lazy">
                <span>{{ $collection['title'] }}</span>
                <p>{{ $collection['summary'] }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="section muted">
    <div class="section-heading">
        <p class="eyebrow">Featured catalog</p>
        <h2>Wholesale products ready for enquiry.</h2>
        <p>No checkout detour. Open the product, send the enquiry, and coordinate availability with the Hayward team.</p>
    </div>
    <div class="product-grid">
        @foreach ($products as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

<section class="split-band">
    <div>
        <p class="eyebrow">Project support</p>
        <h2>From material selection to crew-ready supply.</h2>
        <p>Share the square footage, substrate condition, desired finish, traffic level, and project timeline. The team can help narrow the system and product list before pickup or delivery planning.</p>
        <a class="button button-primary" href="{{ url('/pages/contact') }}">Contact the Warehouse</a>
    </div>
    <ul class="check-list">
        <li>Epoxy flake, solid color, quartz, and metallic systems</li>
        <li>Urethane cement for thermal shock and industrial abuse</li>
        <li>Protective topcoats for abrasion, stains, and gloss retention</li>
        <li>Tools, rollers, squeegees, pigments, and broadcast media</li>
    </ul>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Resources</p>
        <h2>Contractor notes and product education.</h2>
    </div>
    <div class="article-grid">
        @foreach ($posts as $post)
            <article class="article-card">
                <time datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}</time>
                <h3><a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">{{ $post['title'] }}</a></h3>
                <p>{{ $post['summary'] }}</p>
                <a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">Read More</a>
            </article>
        @endforeach
    </div>
</section>
