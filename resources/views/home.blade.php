@php
    $heroMessage = 'Hi Bay Area Epoxy Wholesale, I need help choosing epoxy flooring supplies.';
    $heroWhatsapp = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($heroMessage);
@endphp
<section class="command-hero">
    <div class="hero-copy">
        <p class="eyebrow">Hayward contractor supply desk</p>
        <h1>Industrial coating materials without the checkout friction.</h1>
        <p>Epoxy, urethane cement, topcoats, flakes, pigments, and installation tools organized around real jobsite decisions for Bay Area coating crews.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="{{ $heroWhatsapp }}" data-track-enquiry data-product="Home Hero">Enquire Now</a>
            <a class="button button-secondary" href="{{ url('/collections/all') }}">Browse Catalog</a>
        </div>
        <dl class="hero-metrics">
            <div>
                <dt>17</dt>
                <dd>catalog products migrated</dd>
            </div>
            <div>
                <dt>7</dt>
                <dd>system categories</dd>
            </div>
            <div>
                <dt>CA</dt>
                <dd>contractor supply support</dd>
            </div>
        </dl>
    </div>
    <div class="hero-visual">
        <img src="{{ config('bayarea.hero_image') }}" alt="Crown Polymers epoxy product">
        <div class="supply-board">
            <span>Fast enquiry path</span>
            <strong>No cart. No checkout. Direct product support.</strong>
        </div>
    </div>
</section>

<section class="decision-strip">
    <a href="{{ url('/collections/epoxy-for-concrete-floors') }}">
        <span>01</span>
        <strong>Build an epoxy system</strong>
        <em>Base coat, pigment, flakes, topcoat</em>
    </a>
    <a href="{{ url('/collections/urethane-cement') }}">
        <span>02</span>
        <strong>Specify urethane cement</strong>
        <em>Thermal shock and industrial abuse</em>
    </a>
    <a href="{{ url('/pages/contact') }}">
        <span>03</span>
        <strong>Confirm availability</strong>
        <em>Pickup, delivery, and quote support</em>
    </a>
</section>

<section class="section systems-section">
    <div class="section-heading">
        <p class="eyebrow">Shop by system</p>
        <h2>Choose by coating workflow, not store aisle.</h2>
        <p>Each category maps to a jobsite decision: base system, protection layer, broadcast media, specialty mortar, or crew tools.</p>
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

<section class="section product-showcase">
    <div class="section-heading">
        <p class="eyebrow">Featured supply</p>
        <h2>Quote-ready product cards for mobile crews.</h2>
        <p>Cards stay compact, scannable, and action-focused so phone users can move from product interest to WhatsApp enquiry quickly.</p>
    </div>
    <div class="product-grid dense">
        @foreach ($products as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

<section class="workflow-band">
    <div>
        <p class="eyebrow">Project support</p>
        <h2>From substrate notes to crew-ready material list.</h2>
        <p>Share square footage, concrete condition, desired finish, traffic level, and project timeline. The team can help narrow the system before pickup or delivery planning.</p>
        <a class="button button-primary" href="{{ url('/pages/contact') }}">Contact the Warehouse</a>
    </div>
    <div class="workflow-grid">
        <span>Prep</span>
        <span>Prime</span>
        <span>Build</span>
        <span>Broadcast</span>
        <span>Topcoat</span>
        <span>Maintain</span>
    </div>
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
