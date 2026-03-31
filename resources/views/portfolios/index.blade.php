@extends('layouts.app')

@section('title', 'Portfolio | ' . ($siteSettings['site_name'] ?? 'TinyCatStudio'))
@section('meta_description', 'Lihat hasil kerja ' . ($siteSettings['site_name'] ?? 'TinyCatStudio') . ' untuk project website, aplikasi mobile, branding, graphic design, dan ads management.')
@section('meta_keywords', 'portfolio software house, case study pembuatan aplikasi, hasil kerja desain logo, website perusahaan')
@section('og_type', 'website')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-24">
        <div class="max-w-3xl space-y-6">
            <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.3em] text-orange-300 sm:text-xs sm:tracking-[0.35em]">PORTFOLIO</span>
            <h1 class="text-3xl font-semibold text-white sm:text-4xl md:text-5xl">Project yang menunjukkan kombinasi strategi, visual, dan performa.</h1>
            <p class="text-base leading-7 text-white/65 sm:text-lg sm:leading-8">Setiap project dirancang agar relevan dengan objective bisnis klien, baik untuk kebutuhan branding, conversion, maupun efisiensi operasional.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8 lg:pb-20">
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($portfolios as $portfolio)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $portfolio->thumbnail_url }}" alt="{{ $portfolio->title }}" class="h-56 w-full object-cover sm:h-60">
                    <div class="space-y-4 p-6">
                        <div class="flex flex-wrap items-center justify-between gap-3 text-sm text-white/50">
                            <span class="rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-200">{{ $portfolio->service->name }}</span>
                            @if ($portfolio->client_name)
                                <span class="break-words">{{ $portfolio->client_name }}</span>
                            @endif
                        </div>
                        <h2 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $portfolio->title }}</h2>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit(strip_tags($portfolio->description), 130) }}</p>
                        <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Lihat Project</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio tersedia.</div>
            @endforelse
        </div>
    </section>
@endsection
