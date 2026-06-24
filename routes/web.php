<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$products = fn () => collect(config('bayarea.products'));
$collections = fn () => collect(config('bayarea.collections'));
$pages = fn () => collect(config('bayarea.pages'));
$policies = fn () => collect(config('bayarea.policies'));
$blogPostsPath = storage_path('app/blog-posts.json');
$customPosts = function () use ($blogPostsPath) {
    if (! File::exists($blogPostsPath)) {
        return collect();
    }

    $decoded = json_decode(File::get($blogPostsPath), true);

    return collect(is_array($decoded) ? $decoded : [])
        ->filter(fn ($post) => is_array($post) && isset($post['blog'], $post['slug'], $post['title'], $post['summary'], $post['date']))
        ->values();
};
$writeCustomPosts = function (array $posts) use ($blogPostsPath) {
    File::ensureDirectoryExists(dirname($blogPostsPath));
    File::put($blogPostsPath, json_encode(array_values($posts), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
};
$postKey = fn (array $post) => $post['blog'].'|'.$post['slug'];
$posts = fn () => collect(config('bayarea.posts'))
    ->keyBy($postKey)
    ->merge($customPosts()->keyBy($postKey))
    ->values();

Route::get('/', function () use ($posts) {
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
        'posts' => $posts()->sortByDesc('date')->take(3),
        'schema' => $schema,
    ]);
})->name('home');

Route::redirect('/cart', '/pages/contact', 301);
Route::redirect('/account', '/pages/contact', 301);

Route::get('/admin/blogs/login', function () {
    if (session('blog_admin_authenticated')) {
        return redirect()->route('admin.blogs.index');
    }

    return view('admin.blogs.login', [
        'title' => 'Blog Admin Login',
        'description' => 'Sign in to add SEO blog posts.',
    ]);
})->name('admin.blogs.login');

Route::post('/admin/blogs/login', function (Request $request) {
    $validated = $request->validate([
        'password' => ['required', 'string'],
    ]);

    if (! hash_equals((string) config('bayarea.blog_admin_password'), $validated['password'])) {
        return back()
            ->withErrors(['password' => 'The blog admin password is incorrect.'])
            ->withInput();
    }

    session(['blog_admin_authenticated' => true]);

    return redirect()->route('admin.blogs.index');
})->name('admin.blogs.authenticate');

Route::post('/admin/blogs/logout', function () {
    session()->forget('blog_admin_authenticated');

    return redirect()->route('admin.blogs.login');
})->name('admin.blogs.logout');

Route::get('/admin/blogs', function () use ($posts) {
    if (! session('blog_admin_authenticated')) {
        return redirect()->route('admin.blogs.login');
    }

    return view('admin.blogs.index', [
        'title' => 'Blog Admin',
        'description' => 'Add SEO blog posts to the Bay Area Epoxy Wholesale blog.',
        'posts' => $posts()->sortByDesc('date')->values(),
        'blogOptions' => [
            'news' => 'Main blog',
            'epoxy' => 'Epoxy articles',
        ],
    ]);
})->name('admin.blogs.index');

Route::post('/admin/blogs', function (Request $request) use ($posts, $customPosts, $writeCustomPosts) {
    if (! session('blog_admin_authenticated')) {
        return redirect()->route('admin.blogs.login');
    }

    $validated = $request->validate([
        'blog' => ['required', 'in:news,epoxy'],
        'title' => ['required', 'string', 'max:180'],
        'slug' => ['nullable', 'string', 'max:180'],
        'date' => ['required', 'date'],
        'summary' => ['required', 'string', 'max:320'],
        'meta_title' => ['nullable', 'string', 'max:180'],
        'meta_description' => ['nullable', 'string', 'max:320'],
        'image' => ['nullable', 'url', 'max:600'],
        'body' => ['required', 'string', 'min:80'],
    ]);

    $slug = Str::slug($validated['slug'] ?: $validated['title']);

    if ($posts()->contains(fn (array $post) => $post['blog'] === $validated['blog'] && $post['slug'] === $slug)) {
        return back()
            ->withErrors(['slug' => 'A blog post with this URL slug already exists.'])
            ->withInput();
    }

    $body = collect(preg_split('/\R{2,}/', trim($validated['body'])))
        ->map(fn (string $block) => trim(preg_replace('/\R+/', ' ', $block)))
        ->filter()
        ->values()
        ->all();

    $newPost = [
        'blog' => $validated['blog'],
        'slug' => $slug,
        'title' => $validated['title'],
        'date' => $validated['date'],
        'summary' => $validated['summary'],
        'meta_title' => ($validated['meta_title'] ?? null) ?: $validated['title'],
        'meta_description' => ($validated['meta_description'] ?? null) ?: $validated['summary'],
        'image' => ($validated['image'] ?? null) ?: config('bayarea.hero_image'),
        'body' => $body,
    ];

    $storedPosts = $customPosts()->prepend($newPost)->values()->all();
    $writeCustomPosts($storedPosts);

    return redirect('/blogs/'.$newPost['blog'].'/'.$newPost['slug']);
})->name('admin.blogs.store');

Route::get('/admin/blogs/{blog}/{slug}/edit', function (string $blog, string $slug) use ($posts) {
    if (! session('blog_admin_authenticated')) {
        return redirect()->route('admin.blogs.login');
    }

    $post = $posts()->first(fn (array $post) => $post['blog'] === $blog && $post['slug'] === $slug);
    abort_unless($post, 404);

    $body = $post['body'] ?? [
        'Bay Area Epoxy Wholesale supports contractors with product selection, availability checks, and material planning for epoxy, urethane cement, waterproofing, and concrete coating projects.',
        'For project guidance, share the substrate condition, traffic type, required finish, square footage, and timeline with the team.',
    ];

    return view('admin.blogs.edit', [
        'title' => 'Edit Blog Post',
        'description' => 'Edit an existing SEO blog post.',
        'post' => $post,
        'bodyText' => collect(is_array($body) ? $body : [$body])->filter()->implode("\n\n"),
    ]);
})->name('admin.blogs.edit');

Route::put('/admin/blogs/{blog}/{slug}', function (Request $request, string $blog, string $slug) use ($posts, $customPosts, $writeCustomPosts) {
    if (! session('blog_admin_authenticated')) {
        return redirect()->route('admin.blogs.login');
    }

    $existingPost = $posts()->first(fn (array $post) => $post['blog'] === $blog && $post['slug'] === $slug);
    abort_unless($existingPost, 404);

    $validated = $request->validate([
        'title' => ['required', 'string', 'max:180'],
        'date' => ['required', 'date'],
        'summary' => ['required', 'string', 'max:320'],
        'meta_title' => ['nullable', 'string', 'max:180'],
        'meta_description' => ['nullable', 'string', 'max:320'],
        'image' => ['nullable', 'url', 'max:600'],
        'body' => ['required', 'string', 'min:80'],
    ]);

    $body = collect(preg_split('/\R{2,}/', trim($validated['body'])))
        ->map(fn (string $block) => trim(preg_replace('/\R+/', ' ', $block)))
        ->filter()
        ->values()
        ->all();

    $updatedPost = [
        'blog' => $blog,
        'slug' => $slug,
        'title' => $validated['title'],
        'date' => $validated['date'],
        'summary' => $validated['summary'],
        'meta_title' => ($validated['meta_title'] ?? null) ?: $validated['title'],
        'meta_description' => ($validated['meta_description'] ?? null) ?: $validated['summary'],
        'image' => ($validated['image'] ?? null) ?: ($existingPost['image'] ?? config('bayarea.hero_image')),
        'body' => $body,
        'updated_at' => now()->toIso8601String(),
    ];

    $storedPosts = $customPosts()
        ->reject(fn (array $post) => $post['blog'] === $blog && $post['slug'] === $slug)
        ->prepend($updatedPost)
        ->values()
        ->all();
    $writeCustomPosts($storedPosts);

    return redirect('/blogs/'.$blog.'/'.$slug);
})->name('admin.blogs.update');

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

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product['title'],
        'description' => $product['summary'],
        'image' => $product['image'] ?: config('bayarea.hero_image'),
        'category' => $product['category'],
        'brand' => [
            '@type' => 'Brand',
            'name' => str_contains($product['title'], 'Crown') ? 'Crown Polymers' : config('bayarea.brand'),
        ],
        'offers' => [
            '@type' => 'Offer',
            'url' => url('/products/'.$product['slug']),
            'priceCurrency' => 'USD',
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'LocalBusiness',
                'name' => config('bayarea.brand'),
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
            ],
        ],
    ];

    if (isset($product['price'])) {
        $schema['offers']['price'] = number_format((float) $product['price'], 2, '.', '');
    }

    return view('products.show', [
        'title' => $product['title'],
        'description' => $product['summary'].' Request contractor pricing, availability, and pickup support from Bay Area Epoxy Wholesale in Hayward, CA.',
        'image' => $product['image'],
        'product' => $product,
        'related' => $related,
        'schema' => $schema,
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

    if ($slug === 'epoxy-for-concrete-floors') {
        return view('collections.epoxy', [
            'title' => 'Epoxy For Concrete Floors',
            'description' => 'Epoxy floor coatings, clear epoxy, flakes, pigments, and metallic systems for concrete floor projects in California.',
            'image' => $collection['image'],
            'collection' => $collection,
            'products' => $collectionProducts,
        ]);
    }

    if ($slug === 'protective-coat') {
        return view('collections.protective', [
            'title' => 'Protective Coating Systems',
            'description' => 'Protective coating products, clear topcoats, urethane finishes, and concrete protection options for California contractors.',
            'image' => $collection['image'],
            'collection' => $collection,
            'products' => $collectionProducts,
        ]);
    }

    if ($slug === 'urethane-cement') {
        $faqs = [
            [
                'question' => 'What is urethane cement flooring used for?',
                'answer' => 'Urethane cement flooring is used on industrial concrete where floors face moisture, thermal shock, chemicals, abrasion, impact, and repeated cleaning.',
            ],
            [
                'question' => 'Is urethane cement better than epoxy?',
                'answer' => 'It depends on exposure. Epoxy is useful for many concrete coating projects, while urethane cement is often chosen for wet processing, hot washdown, freezer, and thermal cycling environments.',
            ],
            [
                'question' => 'Which CrownCrete U product should I choose?',
                'answer' => 'Choose based on profile thickness and service condition. Skim coat, 1/8 inch, 1/4 inch, and 3/8 inch trowel-grade systems serve different resurfacing and heavy-duty needs.',
            ],
            [
                'question' => 'Can Bay Area Epoxy Wholesale help with product selection?',
                'answer' => 'Yes. Send square footage, floor condition, use environment, cleaning exposure, temperature conditions, and target schedule so the Hayward team can help organize the material request.',
            ],
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'CollectionPage',
                    'name' => 'Urethane Cement Flooring Systems California',
                    'description' => 'CrownCrete U urethane cement flooring products for industrial kitchens, breweries, food processing, manufacturing, thermal shock, wet service, and heavy-duty concrete floors.',
                    'url' => url('/collections/urethane-cement'),
                    'image' => $collection['image'],
                    'mainEntity' => [
                        '@type' => 'ItemList',
                        'itemListElement' => $collectionProducts->values()->map(fn (array $product, int $index) => [
                            '@type' => 'ListItem',
                            'position' => $index + 1,
                            'url' => url('/products/'.$product['slug']),
                            'name' => $product['title'],
                            'description' => $product['summary'],
                        ])->all(),
                    ],
                ],
                [
                    '@type' => 'FAQPage',
                    'mainEntity' => collect($faqs)->map(fn (array $faq) => [
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq['answer'],
                        ],
                    ])->all(),
                ],
            ],
        ];

        return view('collections.urethane', [
            'title' => 'Urethane Cement Flooring Systems California',
            'description' => 'CrownCrete U urethane cement flooring products for industrial kitchens, breweries, food processing, manufacturing, thermal shock, wet service, and heavy-duty concrete floors.',
            'image' => $collection['image'],
            'collection' => $collection,
            'products' => $collectionProducts,
            'schema' => $schema,
        ]);
    }

    return view('collections.show', [
        'title' => $collection['title'],
        'description' => $collection['summary'],
        'image' => $collection['image'],
        'collection' => $collection,
        'products' => $collectionProducts,
    ]);
})->name('collections.show');

Route::redirect('/pages/waterproofing', '/pages/deck-waterproofing-in-california', 301);

Route::get('/pages/waterproofing/{application}', function (string $application) {
    return redirect('/pages/deck-waterproofing-in-california/'.$application, 301);
});

Route::get('/pages/deck-waterproofing-in-california/{application}', function (string $application) {
    $applications = collect(config('bayarea.waterproofing_applications'));
    $current = $applications->get($application);
    abort_unless($current, 404);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $current['title'].' | Polycoat Waterproofing Systems',
        'description' => $current['summary'],
        'url' => url('/pages/deck-waterproofing-in-california/'.$current['slug']),
        'image' => $current['image'],
        'mainEntity' => [
            '@type' => 'ItemList',
            'itemListElement' => collect($current['products'])->values()->map(fn (array $product, int $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $product['title'],
            ])->all(),
        ],
    ];

    return view('pages.waterproofing-application', [
        'title' => $current['title'].' | Polycoat Waterproofing Systems',
        'description' => $current['summary'].' Request Bay Area Epoxy Wholesale quote support from Hayward, CA.',
        'image' => $current['image'],
        'application' => $current,
        'applications' => $applications->values(),
        'schema' => $schema,
    ]);
})->name('pages.waterproofing.application');

Route::get('/pages/structural-concrete-repair/{category}', function (string $category) {
    $categories = collect(config('bayarea.chemco_structural_repair_categories'));
    $current = $categories->get($category);
    abort_unless($current, 404);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $current['title'].' | Chemco Systems CCS',
        'description' => $current['summary'].' '.$current['fit'],
        'image' => $current['image'],
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Chemco Systems',
        ],
        'seller' => [
            '@type' => 'LocalBusiness',
            'name' => config('bayarea.brand'),
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
        ],
    ];

    return view('pages.structural-concrete-repair-category', [
        'title' => $current['title'].' | Structural Concrete Repair',
        'description' => $current['summary'].' Request Chemco CCS quote support from Bay Area Epoxy Wholesale.',
        'image' => $current['image'],
        'category' => $current,
        'categories' => $categories->values(),
        'schema' => $schema,
    ]);
})->name('pages.structural-concrete-repair.category');

Route::get('/pages/esd-static-dissipative-conductive/{system}', function (string $system) {
    $systems = collect(config('bayarea.esd_systems'));
    $current = $systems->get($system);
    abort_unless($current, 404);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $current['title'].' | Crown Polymers ESD System',
        'description' => $current['summary'],
        'image' => asset($current['image']),
        'category' => 'ESD flooring system',
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Crown Polymers',
        ],
        'seller' => [
            '@type' => 'LocalBusiness',
            'name' => config('bayarea.brand'),
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
        ],
    ];

    return view('pages.esd-system', [
        'title' => $current['title'].' | ESD Flooring Systems California',
        'description' => $current['summary'].' Request ESD flooring system quote support from Bay Area Epoxy Wholesale.',
        'image' => asset($current['image']),
        'system' => $current,
        'systems' => $systems->values(),
        'schema' => $schema,
    ]);
})->name('pages.esd.system');

Route::get('/pages/{slug}', function (string $slug) use ($pages) {
    $page = $pages()->get($slug);
    abort_unless($page, 404);

    if ($slug === 'esd-static-dissipative-conductive') {
        return view('pages.esd', [
            'title' => 'ESD Flooring Systems California',
            'description' => 'Conductive and static dissipative flooring solutions for data centers, electronics manufacturing, laboratories, battery facilities, telecom hubs, and mission-critical California facilities.',
            'image' => asset('assets/esd-crown-hero.jpg'),
            'page' => $page,
        ]);
    }

    if ($slug === 'structural-concrete-repair') {
        $image = 'https://www.chemcosystems.com/images/ccs-1.png';
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'Structural Concrete Repair Products California',
            'description' => 'Authorized Chemco Systems distributor support for CCS epoxy and polyurea products for structural concrete crack repair, bonding, grouting, coatings, and concrete protection.',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => config('bayarea.brand'),
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
            ],
            'areaServed' => ['Bay Area', 'California', 'Hayward', 'San Jose', 'Oakland', 'San Francisco'],
            'serviceType' => ['Structural concrete repair', 'Epoxy crack injection', 'Concrete bonding adhesives', 'Control joint fillers', 'Concrete protection coatings'],
            'image' => $image,
        ];

        return view('pages.structural-concrete-repair', [
            'title' => 'Structural Concrete Repair Products California | Chemco CCS Distributor',
            'description' => 'Authorized Chemco Systems distributor for CCS epoxies and polyureas used by concrete repair contractors, property managers, and structural engineers.',
            'image' => $image,
            'page' => $page,
            'schema' => $schema,
        ]);
    }

    if ($slug === 'deck-waterproofing-in-california') {
        $image = 'https://www.polycoatusa.com/wp-content/uploads/2026/02/Waterproofing-Header-Hero-LAX.jpg';
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'Deck Waterproofing in California',
            'description' => 'Authorized Polycoat distributor support for commercial waterproofing systems, deck coatings, parking structures, below-grade protection, and water containment projects.',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => config('bayarea.brand'),
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
            ],
            'areaServed' => ['Bay Area', 'California', 'Hayward', 'San Jose', 'Oakland', 'San Francisco'],
            'serviceType' => ['Waterproofing systems', 'Deck waterproofing', 'Traffic coatings', 'Below-grade waterproofing', 'Water containment coatings'],
            'image' => $image,
        ];

        return view('pages.waterproofing', [
            'title' => 'Deck Waterproofing in California | Polycoat Waterproofing Systems',
            'description' => 'Deck waterproofing in California with authorized Polycoat distributor support for roof decks, plaza decks, parking structures, foundations, and containment systems.',
            'image' => $image,
            'page' => $page,
            'applications' => collect(config('bayarea.waterproofing_applications'))->values(),
            'schema' => $schema,
        ]);
    }

    return view('pages.show', [
        'title' => $page['title'],
        'description' => $page['summary'],
        'page' => $page,
    ]);
})->name('pages.show');

Route::get('/blogs/{blog}', function (string $blog) use ($posts) {
    abort_unless(in_array($blog, ['news', 'epoxy'], true), 404);

    return view('blogs.index', [
        'title' => $blog === 'epoxy' ? 'Epoxy Articles' : 'Blogs',
        'description' => 'Contractor-focused epoxy flooring, waterproofing, and urethane cement articles.',
        'blog' => $blog,
        'posts' => $posts()->where('blog', $blog)->sortByDesc('date')->values(),
    ]);
})->name('blogs.index');

Route::get('/blogs/{blog}/{slug}', function (string $blog, string $slug) use ($posts) {
    $post = $posts()->first(fn (array $post) => $post['blog'] === $blog && $post['slug'] === $slug);
    abort_unless($post, 404);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post['title'],
        'description' => $post['meta_description'] ?? $post['summary'],
        'datePublished' => $post['date'],
        'dateModified' => $post['updated_at'] ?? $post['date'],
        'image' => $post['image'] ?? config('bayarea.hero_image'),
        'author' => [
            '@type' => 'Organization',
            'name' => config('bayarea.brand'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => config('bayarea.brand'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => config('bayarea.logo_image'),
            ],
        ],
        'mainEntityOfPage' => url('/blogs/'.$post['blog'].'/'.$post['slug']),
    ];

    return view('blogs.show', [
        'title' => $post['meta_title'] ?? $post['title'],
        'description' => $post['meta_description'] ?? $post['summary'],
        'image' => $post['image'] ?? config('bayarea.hero_image'),
        'post' => $post,
        'schema' => $schema,
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
