@extends('layouts.app')

@section('content')
    <section class="page-title-band">
        <p class="eyebrow">Blogs</p>
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
    </section>

    <section class="section">
        <div class="article-grid">
            @forelse ($posts as $post)
                <article class="article-card">
                    @if (! empty($post['image']))
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" loading="lazy" decoding="async">
                    @endif
                    <time datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}</time>
                    <h2><a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">{{ $post['title'] }}</a></h2>
                    <p>{{ $post['summary'] }}</p>
                    <a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">Read More</a>
                </article>
            @empty
                <div class="empty-state">
                    <h2>No posts yet</h2>
                    <p>New posts published from the blog backend will appear here.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
