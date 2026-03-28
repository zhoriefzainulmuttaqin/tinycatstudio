@extends('layouts.app')

@section('title', $post->title . ' | ' . ($siteSettings['site_name'] ?? 'TinyCatStudio'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->content), 150))
@section('meta_keywords', implode(', ', explode(' ', strtolower($post->title))) . ', software house, blog, artikel')
@section('og_type', 'article')
@section('og_image', $post->thumbnail)

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8 lg:py-24">
        <div class="space-y-6">
            <div class="flex flex-wrap gap-3 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300">
                @foreach ($post->categories as $category)
                    <span>{{ $category->name }}</span>
                @endforeach
            </div>
            <h1 class="text-3xl font-semibold leading-tight text-white break-words sm:text-4xl md:text-5xl">{{ $post->title }}</h1>
            <p class="text-sm text-white/45">Dipublikasikan {{ optional($post->published_at)->translatedFormat('d F Y') }}</p>
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="max-h-[420px] w-full rounded-[2rem] border border-white/10 object-cover">
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-4 pb-14 sm:px-6 lg:px-8 lg:pb-16">
        <article class="rounded-[2rem] border border-white/10 bg-white/5 px-5 py-6 text-[15px] leading-7 break-words text-white/75 sm:px-6 sm:py-8 sm:text-base sm:leading-8 lg:px-10 lg:py-10">
            {!! nl2br(e($post->content)) !!}
        </article>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8 lg:pb-20">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Artikel Lainnya</span>
                <h2 class="text-3xl font-semibold text-white">Insight terbaru dari TinyCatStudio.</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-white/75 transition hover:text-orange-300">Kembali ke blog</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($recentPosts as $related)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" class="h-52 w-full object-cover">
                    <div class="space-y-4 p-6">
                        <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $related->title }}</h3>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit(strip_tags($related->content), 120) }}</p>
                        <a href="{{ route('blog.show', $related) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Baca Artikel</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada artikel lain.</div>
            @endforelse
        </div>
    </section>
@endsection
