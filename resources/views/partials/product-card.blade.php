@php
    $productUrl = url('/products/'.$product['slug']);
    $message = 'Hi Bay Area Epoxy Wholesale, I would like to enquire about '.$product['title'].'. '.$productUrl;
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
@endphp
<article class="product-card">
    <a class="product-image" href="{{ $productUrl }}">
        <img src="{{ $product['image'] ?: config('bayarea.hero_image') }}" alt="{{ $product['title'] }}" loading="lazy">
    </a>
    <div class="product-card-body">
        <div class="eyebrow">{{ $product['category'] }}</div>
        <h3><a href="{{ $productUrl }}">{{ $product['title'] }}</a></h3>
        <p>{{ $product['summary'] }}</p>
        <div class="tag-row">
            @foreach (array_slice($product['tags'], 0, 3) as $tag)
                <span>{{ $tag }}</span>
            @endforeach
        </div>
        <div class="card-actions">
            <a class="button button-secondary" href="{{ $productUrl }}">View Details</a>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Enquire Now</a>
        </div>
    </div>
</article>
