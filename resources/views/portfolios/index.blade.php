@extends('layouts.app')

@section('title', 'Portfolio | TinyCatStudio')
@section('meta_description', 'Lihat hasil kerja TinyCatStudio untuk website, aplikasi mobile, branding, graphic design, dan ads management.')

@section('content')
    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-24">
        <div class="max-w-3xl space-y-6">
            <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.35em] text-orange-300">PORTFOLIO</span>
            <h1 class="text-4xl font-semibold text-white md:text-5xl">Project yang menunjukkan kombinasi strategi, visual, dan performa.</h1>
            <p class="text-lg leading-8 text-white/65">Setiap project dirancang agar relevan dengan objective bisnis klien, baik untuk kebutuhan branding, conversion, maupun efisiensi operasional.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 pb-20 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($portfolios as $portfolio)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->title }}" class="h-60 w-full object-cover">
                    <div class="space-y-4 p-6">
                        <div class="flex items-center justify-between gap-3 text-sm text-white/50">
                            <span class="rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-200">{{ $portfolio->service->name }}</span>
                            @if ($portfolio->client_name)
                                <span>{{ $portfolio->client_name }}</span>
                            @endif
                        </div>
                        <h2 class="text-2xl font-semibold text-white">{{ $portfolio->title }}</h2>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit($portfolio->description, 130) }}</p>
                        <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-flex rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Lihat Project</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio tersedia.</div>
            @endforelse
        </div>
    </section>
@endsection
