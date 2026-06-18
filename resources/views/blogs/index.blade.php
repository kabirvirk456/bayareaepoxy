@extends('layouts.app')

@section('content')
    <section class="page-title-band">
        <p class="eyebrow">Resources</p>
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
    </section>

    <section class="section">
        <div class="article-grid">
            @foreach ($posts as $post)
                <article class="article-card">
                    <time datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}</time>
                    <h2><a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">{{ $post['title'] }}</a></h2>
                    <p>{{ $post['summary'] }}</p>
                    <a href="{{ url('/blogs/'.$post['blog'].'/'.$post['slug']) }}">Read More</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
