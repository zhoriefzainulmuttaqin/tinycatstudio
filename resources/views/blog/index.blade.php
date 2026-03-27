@extends('layouts.app')

@section('title', 'Blog | TinyCatStudio')
@section('meta_description', 'Artikel TinyCatStudio seputar website, aplikasi mobile, branding, graphic design, dan digital ads.')

@section('content')
    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-24">
        <div class="grid gap-8 lg:grid-cols-[1fr_0.6fr]">
            <div class="space-y-6">
                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.35em] text-orange-300">BLOG</span>
                <h1 class="text-4xl font-semibold text-white md:text-5xl">Insight untuk membantu brand Anda lebih siap di ranah digital.</h1>
                <p class="text-lg leading-8 text-white/65">Berisi artikel strategis seputar website, aplikasi, desain visual, conversion, dan digital marketing agar keputusan bisnis Anda makin terarah.</p>
            </div>
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-300">Kategori</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    @foreach ($categories as $category)
                        <span class="rounded-full border border-white/10 px-4 py-2 text-sm text-white/65">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 pb-20 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="h-56 w-full object-cover">
                    <div class="space-y-4 p-6">
                        <p class="text-xs uppercase tracking-[0.25em] text-orange-300">{{ optional($post->published_at)->translatedFormat('d M Y') }}</p>
                        <h2 class="text-2xl font-semibold text-white">{{ $post->title }}</h2>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}</p>
                        <a href="{{ route('blog.show', $post) }}" class="inline-flex rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Baca Artikel</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada artikel.</div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
