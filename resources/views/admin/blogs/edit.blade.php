@extends('layouts.app')

@section('content')
    <section class="admin-shell">
        <div class="admin-heading">
            <div>
                <p class="eyebrow">Blog backend</p>
                <h1>Edit blog post.</h1>
                <p>The public URL is preserved for SEO. Edits are saved to the blog JSON store and override migrated posts when needed.</p>
            </div>
            <div class="admin-heading-actions">
                <a class="button button-secondary" href="{{ route('admin.blogs.index') }}">Back To Admin</a>
                <a class="button button-secondary" href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}" target="_blank" rel="noopener">View Post</a>
            </div>
        </div>

        <form class="admin-panel admin-form" action="{{ route('admin.blogs.update', ['blog' => $post['blog'], 'slug' => $post['slug']]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="admin-form-grid">
                <label>
                    <span>Blog page</span>
                    <input type="text" value="{{ $post['blog'] }}" readonly>
                </label>
                <label>
                    <span>Publish date</span>
                    <input type="date" name="date" value="{{ old('date', $post['date']) }}" required>
                </label>
            </div>

            <label>
                <span>Title</span>
                <input type="text" name="title" value="{{ old('title', $post['title']) }}" required maxlength="180">
                @error('title')
                    <em>{{ $message }}</em>
                @enderror
            </label>

            <label>
                <span>URL slug locked</span>
                <input type="text" value="{{ $post['slug'] }}" readonly>
            </label>

            <label>
                <span>Meta title</span>
                <input type="text" name="meta_title" value="{{ old('meta_title', $post['meta_title'] ?? $post['title']) }}" maxlength="180">
            </label>

            <label>
                <span>Meta description / summary</span>
                <textarea name="summary" required maxlength="320" rows="3">{{ old('summary', $post['summary']) }}</textarea>
                @error('summary')
                    <em>{{ $message }}</em>
                @enderror
            </label>

            <label>
                <span>Custom meta description</span>
                <textarea name="meta_description" maxlength="320" rows="3">{{ old('meta_description', $post['meta_description'] ?? $post['summary']) }}</textarea>
            </label>

            <label>
                <span>Featured image URL</span>
                <input type="url" name="image" value="{{ old('image', $post['image'] ?? '') }}" maxlength="600">
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
                <textarea name="body" required rows="16" data-link-editor>{{ old('body', $bodyText) }}</textarea>
                @error('body')
                    <em>{{ $message }}</em>
                @enderror
            </label>

            <button class="button button-primary" type="submit">Save Blog Post</button>
        </form>
    </section>
@endsection
