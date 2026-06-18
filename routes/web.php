<?php

use Illuminate\Support\Facades\Route;

$products = fn () => collect(config('bayarea.products'));
$collections = fn () => collect(config('bayarea.collections'));
$pages = fn () => collect(config('bayarea.pages'));
$posts = fn () => collect(config('bayarea.posts'));
$policies = fn () => collect(config('bayarea.policies'));

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Epoxy Supplier California | Flooring Products',
        'description' => 'Wholesale epoxy flooring supplies and waterproofing products near Hayward, CA. Built for Bay Area contractors who need fast product guidance.',
        'image' => config('bayarea.hero_image'),
        'products' => collect(config('bayarea.products'))->take(8),
        'collections' => collect(config('bayarea.collections')),
        'posts' => collect(config('bayarea.posts'))->sortByDesc('date')->take(3),
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
