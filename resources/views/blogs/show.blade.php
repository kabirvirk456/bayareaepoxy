@php
    $message = 'Hi Bay Area Epoxy Wholesale, I read '.$post['title'].' and would like product guidance.';
    $whatsappUrl = 'https://wa.me/'.config('bayarea.whatsapp_number').'?text='.rawurlencode($message);
    $renderBlogBlock = function (string $block) {
        $html = '';
        $offset = 0;
        preg_match_all('/\[([^\]]+)\]\(([^)\s]+)\)/', $block, $matches, PREG_OFFSET_CAPTURE);

        foreach ($matches[0] as $index => $match) {
            [$fullMatch, $position] = $match;
            $html .= e(substr($block, $offset, $position - $offset));

            $label = $matches[1][$index][0];
            $url = trim($matches[2][$index][0]);
            $allowedUrl = str_starts_with($url, '/') || str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:');

            if ($allowedUrl) {
                $isExternal = str_starts_with($url, 'http://') || str_starts_with($url, 'https://');
                $html .= '<a href="'.e($url).'"'.($isExternal ? ' target="_blank" rel="noopener"' : '').'>'.e($label).'</a>';
            } else {
                $html .= e($fullMatch);
            }

            $offset = $position + strlen($fullMatch);
        }

        return $html.e(substr($block, $offset));
    };
@endphp

@extends('layouts.app')

@section('content')
    <article class="article-detail">
        <p class="eyebrow">Blog</p>
        <time datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('F j, Y') }}</time>
        <h1>{{ $post['title'] }}</h1>
        <p class="lead">{{ $post['summary'] }}</p>
        @if (! empty($post['image']))
            <img class="article-hero-image" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" decoding="async">
        @endif
        <div class="article-body">
            @if (! empty($post['body']))
                @foreach (is_array($post['body']) ? $post['body'] : [$post['body']] as $block)
                    <p>{!! $renderBlogBlock((string) $block) !!}</p>
                @endforeach
            @else
                <p>Bay Area Epoxy Wholesale supports contractors with product selection, availability checks, and material planning for epoxy, urethane cement, waterproofing, and concrete coating projects.</p>
                <p>For project guidance, share the substrate condition, traffic type, required finish, square footage, and timeline with the team.</p>
            @endif
        </div>
        <a class="button button-primary" href="{{ $whatsappUrl }}" data-track-enquiry data-product="{{ $post['title'] }}">Discuss This Topic</a>
    </article>
@endsection
