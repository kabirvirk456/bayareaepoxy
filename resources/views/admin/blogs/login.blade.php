@extends('layouts.app')

@section('content')
    <section class="admin-shell admin-login-shell">
        <div class="admin-panel narrow">
            <p class="eyebrow">Blog backend</p>
            <h1>Sign in to add blog posts.</h1>
            <p>Use this backend to publish SEO-focused blog content directly to the public blog pages.</p>

            <form class="admin-form" action="{{ route('admin.blogs.authenticate') }}" method="post">
                @csrf
                <label>
                    <span>Password</span>
                    <input type="password" name="password" value="{{ old('password') }}" required autocomplete="current-password">
                    @error('password')
                        <em>{{ $message }}</em>
                    @enderror
                </label>
                <button class="button button-primary" type="submit">Sign In</button>
            </form>
        </div>
    </section>
@endsection
