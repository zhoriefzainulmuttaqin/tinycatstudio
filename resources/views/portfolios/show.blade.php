@extends('layouts.app')

@section('title', $portfolio->title . ' | Portfolio ' . ($siteSettings['site_name'] ?? 'TinyCatStudio'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($portfolio->description), 150))
@section('meta_keywords', implode(', ', explode(' ', strtolower($portfolio->title))) . ', portfolio, case study, project')
@section('og_type', 'article')
@section('og_image', $portfolio->thumbnail)

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-24">
        <div class="grid gap-10 md:grid-cols-[1.02fr_0.98fr] md:items-start lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-6">
                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.3em] text-orange-300 sm:text-xs sm:tracking-[0.35em]">CASE STUDY</span>
                <h1 class="text-3xl font-semibold text-white break-words sm:text-4xl md:text-5xl">{{ $portfolio->title }}</h1>
                <p class="text-base leading-7 text-white/65 sm:text-lg sm:leading-8">{{ $portfolio->description }}</p>
                <div class="flex flex-wrap gap-3 text-sm text-white/60">
                    <span class="rounded-full border border-white/10 px-4 py-2">{{ $portfolio->service->name }}</span>
                    @if ($portfolio->client_name)
                        <span class="rounded-full border border-white/10 px-4 py-2 break-words">{{ $portfolio->client_name }}</span>
                    @endif
                    @if ($portfolio->project_url)
                        <a href="{{ $portfolio->project_url }}" target="_blank" rel="noreferrer" class="rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-orange-200">Kunjungi Project</a>
                    @endif
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->title }}" class="h-full min-h-[240px] w-full object-cover sm:min-h-[320px]">
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:pb-16">
        <div class="mb-8 max-w-2xl space-y-4">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Gallery</span>
            <h2 class="text-3xl font-semibold text-white">Preview hasil kerja</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($portfolio->images as $image)
                <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $image->image }}" alt="{{ $portfolio->title }}" class="h-60 w-full object-cover sm:h-72">
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada gallery tambahan untuk project ini.</div>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:pb-20">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Project Terkait</span>
                <h2 class="text-3xl font-semibold text-white">Lihat project lain dalam layanan yang sama.</h2>
            </div>
            <a href="{{ route('portfolios.index') }}" class="text-sm font-semibold text-white/75 transition hover:text-orange-300">Semua portfolio</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($relatedPortfolios as $related)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" class="h-52 w-full object-cover">
                    <div class="space-y-4 p-6">
                        <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $related->title }}</h3>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit($related->description, 110) }}</p>
                        <a href="{{ route('portfolios.show', $related) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Lihat Detail</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada project terkait.</div>
            @endforelse
        </div>
    </section>
@endsection
