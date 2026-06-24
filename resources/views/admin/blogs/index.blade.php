@extends('layouts.app')

@section('content')
    <section class="admin-shell">
        <div class="admin-heading">
            <div>
                <p class="eyebrow">Blog backend</p>
                <h1>Add SEO blog posts.</h1>
                <p>Create a post here and it will publish immediately to the selected public blog page.</p>
            </div>
            <form action="{{ route('admin.blogs.logout') }}" method="post">
                @csrf
                <button class="button button-secondary" type="submit">Sign Out</button>
            </form>
        </div>

        <div class="admin-blog-layout">
            <form class="admin-panel admin-form" action="{{ route('admin.blogs.store') }}" method="post">
                @csrf
                <div class="admin-form-grid">
                    <label>
                        <span>Blog page</span>
                        <select name="blog" required>
                            @foreach ($blogOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('blog', 'news') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>
                        <span>Publish date</span>
                        <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" required>
                    </label>
                </div>

                <label>
                    <span>Title</span>
                    <input type="text" name="title" value="{{ old('title') }}" required maxlength="180" placeholder="Best epoxy coating system for warehouse floors">
                    @error('title')
                        <em>{{ $message }}</em>
                    @enderror
                </label>

                <label>
                    <span>URL slug</span>
                    <input type="text" name="slug" value="{{ old('slug') }}" maxlength="180" placeholder="Leave blank to generate from title">
                    @error('slug')
                        <em>{{ $message }}</em>
                    @enderror
                </label>

                <label>
                    <span>Meta title</span>
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" maxlength="180" placeholder="Optional SEO title">
                </label>

                <label>
                    <span>Meta description / summary</span>
                    <textarea name="summary" required maxlength="320" rows="3" placeholder="Short search-result description">{{ old('summary') }}</textarea>
                    @error('summary')
                        <em>{{ $message }}</em>
                    @enderror
                </label>

                <label>
                    <span>Custom meta description</span>
                    <textarea name="meta_description" maxlength="320" rows="3" placeholder="Optional. Uses summary if blank.">{{ old('meta_description') }}</textarea>
                </label>

                <label>
                    <span>Featured image URL</span>
                    <input type="url" name="image" value="{{ old('image') }}" maxlength="600" placeholder="https://example.com/image.jpg">
                </label>

                <label>
                    <span>Article body</span>
                    <div class="admin-link-tools" data-link-tools>
                        <input type="text" data-link-text placeholder="Link text">
                        <input type="text" data-link-url placeholder="/collections/all or https://example.com">
                        <select data-link-url-preset>
                            <option value="">Quick internal link</option>
                            <option value="/collections/epoxy-for-concrete-floors">Epoxy products</option>
                            <option value="/collections/protective-coat">Protective coating</option>
                            <option value="/pages/esd-static-dissipative-conductive">ESD flooring</option>
                            <option value="/pages/contact">Contact</option>
                            <option value="/blogs/news">Blogs</option>
                        </select>
                        <button class="button button-secondary" type="button" data-insert-link>Insert Link</button>
                    </div>
                    <textarea name="body" required rows="14" data-link-editor placeholder="Write the article here. Use a blank line between paragraphs. Add links like [Contact us](/pages/contact).">{{ old('body') }}</textarea>
                    @error('body')
                        <em>{{ $message }}</em>
                    @enderror
                </label>

                <button class="button button-primary" type="submit">Publish Blog Post</button>
            </form>

            <aside class="admin-panel">
                <h2>Current posts</h2>
                <div class="admin-post-list">
                    @foreach ($posts->take(12) as $post)
                        <article>
                            <span>{{ \Carbon\Carbon::parse($post['date'])->format('M j, Y') }} · {{ $post['blog'] }}</span>
                            <strong>{{ $post['title'] }}</strong>
                            <div class="admin-post-actions">
                                <a href="{{ route('admin.blogs.edit', ['blog' => $post['blog'], 'slug' => $post['slug']]) }}">Edit</a>
                                <a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}" target="_blank" rel="noopener">View</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>
@endsection
