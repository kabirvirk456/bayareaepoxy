@php
    $productUrl = url('/products/'.$product['slug']);
    $message = 'Hi Bay Area Epoxy Wholesale, I would like to enquire about '.$product['title'].'. '.$productUrl;
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $priceLabel = isset($product['price']) ? '$'.rtrim(rtrim(number_format((float) $product['price'], 2), '0'), '.') : 'Quote';
@endphp
<article class="product-card" data-product-card data-category="{{ $product['category'] }}">
    <a class="product-image" href="{{ $productUrl }}">
        <img src="{{ $product['image'] ?: config('bayarea.hero_image') }}" alt="{{ $product['title'] }}" loading="lazy" decoding="async">
    </a>
    <div class="product-card-body">
        <div class="product-meta-row">
            <span>{{ $product['category'] }}</span>
            <strong>{{ $priceLabel }}</strong>
        </div>
        <h3><a href="{{ $productUrl }}">{{ $product['title'] }}</a></h3>
        <p>{{ $product['summary'] }}</p>
        <div class="tag-row">
            @foreach (array_slice($product['tags'], 0, 2) as $tag)
                <span>{{ $tag }}</span>
            @endforeach
        </div>
        <div class="card-actions">
            <a class="button button-secondary" href="{{ $productUrl }}">Details</a>
            <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $product['title'] }}">Enquire</a>
        </div>
    </div>
</article>
