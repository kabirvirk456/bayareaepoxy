<?php

use Illuminate\Support\Facades\Route;

$products = fn () => collect(config('bayarea.products'));
$collections = fn () => collect(config('bayarea.collections'));
$pages = fn () => collect(config('bayarea.pages'));
$posts = fn () => collect(config('bayarea.posts'));
$policies = fn () => collect(config('bayarea.policies'));

Route::get('/', function () {
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'LocalBusiness',
                '@id' => url('/').'#localbusiness',
                'name' => config('bayarea.brand'),
                'url' => url('/'),
                'image' => config('bayarea.hero_image'),
                'telephone' => config('bayarea.phone'),
                'email' => config('bayarea.email'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => '2495 American Ave',
                    'addressLocality' => 'Hayward',
                    'addressRegion' => 'CA',
                    'postalCode' => '94545',
                    'addressCountry' => 'US',
                ],
                'areaServed' => ['Bay Area', 'California', 'Hayward', 'San Jose', 'Oakland', 'San Francisco'],
            ],
            [
                '@type' => 'FAQPage',
                '@id' => url('/').'#faq',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name' => 'Do you sell epoxy flooring supplies directly online?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'The website is built as an enquiry catalog. Contractors can review epoxy, urethane cement, flakes, pigments, tools, and topcoats, then request availability and pricing through WhatsApp, call, or text.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Where is Bay Area Epoxy Wholesale located?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Bay Area Epoxy Wholesale supports contractors from 2495 American Ave, Hayward, CA 94545.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Which flooring systems can you help source?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'The catalog covers epoxy floor coatings, polyaspartic and urethane topcoats, urethane cement, cove base epoxy, flakes, metallic pigments, solid pigments, rollers, and squeegees.',
                        ],
                    ],
                ],
            ],
        ],
    ];

    return view('welcome', [
        'title' => 'Epoxy Flooring Supplies California | Bay Area Epoxy Supplier',
        'description' => 'Wholesale epoxy flooring supplies in Hayward, CA for contractors across the Bay Area and California. Epoxy coatings, urethane cement, flakes, pigments, polyaspartic topcoats, tools, and WhatsApp quote support.',
        'image' => config('bayarea.hero_image'),
        'products' => collect(config('bayarea.products'))->take(8),
        'collections' => collect(config('bayarea.collections')),
        'posts' => collect(config('bayarea.posts'))->sortByDesc('date')->take(3),
        'schema' => $schema,
    ]);
})->name('home');

Route::redirect('/cart', '/pages/contact', 301);
Route::redirect('/account', '/pages/contact', 301);

Route::get('/search', function () use ($products) {
    $query = trim((string) request('q', ''));
    $results = $query === ''
        ? $products()->take(8)
        : $products()->filter(function (array $product) use ($query) {
            $haystack = strtolower($product['title'].' '.$product['category'].' '.implode(' ', $product['tags']).' '.$product['summary']);

            return str_contains($haystack, strtolower($query));
        })->values();

    return view('search', [
        'title' => 'Search',
        'description' => 'Search Bay Area Epoxy Wholesale products and coating systems.',
        'query' => $query,
        'products' => $results,
    ]);
})->name('search');

Route::get('/products/{slug}', function (string $slug) use ($products) {
    $product = $products()->firstWhere('slug', $slug);
    abort_unless($product, 404);

    $related = $products()
        ->where('category', $product['category'])
        ->where('slug', '!=', $product['slug'])
        ->take(3)
        ->values();

    return view('products.show', [
        'title' => $product['title'],
        'description' => $product['summary'],
        'image' => $product['image'],
        'product' => $product,
        'related' => $related,
    ]);
})->name('products.show');

Route::get('/collections/all', function () use ($products) {
    return view('collections.show', [
        'title' => 'All Products',
        'description' => 'Browse the complete Bay Area Epoxy Wholesale product catalog.',
        'collection' => [
            'title' => 'All Products',
            'summary' => 'The full contractor catalog for epoxy flooring, urethane cement, decorative media, protective coatings, and installation tools.',
            'image' => config('bayarea.hero_image'),
        ],
        'products' => $products(),
    ]);
})->name('collections.all');

Route::get('/collections/{slug}', function (string $slug) use ($collections, $products) {
    $collection = $collections()->get($slug);
    abort_unless($collection, 404);

    $collectionProducts = $products()
        ->filter(fn (array $product) => in_array($product['slug'], $collection['products'], true))
        ->values();

    return view('collections.show', [
        'title' => $collection['title'],
        'description' => $collection['summary'],
        'image' => $collection['image'],
        'collection' => $collection,
        'products' => $collectionProducts,
    ]);
})->name('collections.show');

Route::get('/pages/{slug}', function (string $slug) use ($pages) {
    $page = $pages()->get($slug);
    abort_unless($page, 404);

    return view('pages.show', [
        'title' => $page['title'],
        'description' => $page['summary'],
        'page' => $page,
    ]);
})->name('pages.show');

Route::get('/blogs/{blog}', function (string $blog) use ($posts) {
    abort_unless(in_array($blog, ['news', 'epoxy'], true), 404);

    return view('blogs.index', [
        'title' => $blog === 'epoxy' ? 'Epoxy Articles' : 'Blog',
        'description' => 'Contractor-focused epoxy flooring, waterproofing, and urethane cement articles.',
        'blog' => $blog,
        'posts' => $posts()->where('blog', 'news')->sortByDesc('date')->values(),
    ]);
})->name('blogs.index');

Route::get('/blogs/{blog}/{slug}', function (string $blog, string $slug) use ($posts) {
    $post = $posts()->first(fn (array $post) => $post['blog'] === $blog && $post['slug'] === $slug);
    abort_unless($post, 404);

    return view('blogs.show', [
        'title' => $post['title'],
        'description' => $post['summary'],
        'post' => $post,
    ]);
})->name('blogs.show');

Route::get('/policies/{slug}', function (string $slug) use ($policies) {
    $policy = $policies()->get($slug);
    abort_unless($policy, 404);

    return view('policies.show', [
        'title' => $policy['title'],
        'description' => $policy['summary'],
        'policy' => $policy,
    ]);
})->name('policies.show');
