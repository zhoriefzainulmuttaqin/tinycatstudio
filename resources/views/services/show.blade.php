@extends('layouts.app')

@section('title', $service->name . ' | TinyCatStudio')
@section('meta_description', $service->description)

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-24">
        <div class="grid gap-8 md:grid-cols-[1.02fr_0.98fr] md:items-start lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-6">
                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.3em] text-orange-300 sm:text-xs sm:tracking-[0.35em]">LAYANAN</span>
                <h1 class="text-3xl font-semibold text-white sm:text-4xl md:text-5xl">{{ $service->name }}</h1>
                <p class="max-w-3xl text-base leading-7 text-white/65 sm:text-lg sm:leading-8">{{ $service->description }}</p>
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:gap-4">
                    <a href="#packages" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-400 sm:w-auto">Lihat Paket</a>
                    <a href="{{ route('home') }}#consultation" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Konsultasi Sekarang</a>
                </div>
            </div>
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 sm:p-8">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-300">Why it matters</p>
                <div class="mt-6 grid gap-4">
                    @foreach ($service->serviceDetails as $detail)
                        <div class="rounded-2xl border border-white/10 bg-black/20 p-5">
                            <h2 class="text-lg font-semibold text-white break-words">{{ $detail->title }}</h2>
                            <p class="mt-2 text-sm leading-7 text-white/60">{{ $detail->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="packages" class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:pb-16">
        <div class="mb-8 max-w-2xl space-y-4">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Paket Harga</span>
            <h2 class="text-3xl font-semibold text-white">Pilihan paket untuk {{ $service->name }}</h2>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($service->pricingPackages as $package)
                <div class="rounded-[2rem] border {{ $package->is_popular ? 'border-orange-400/40 bg-orange-500/10' : 'border-white/10 bg-white/5' }} p-5 sm:p-6">
                    <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $package->name }}</h3>
                        @if ($package->is_popular)
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-neutral-950">Populer</span>
                        @endif
                    </div>
                    <p class="mt-4 text-sm leading-7 text-white/60">{{ $package->description }}</p>
                    <p class="mt-6 text-3xl font-semibold text-white sm:text-4xl">Rp {{ number_format((float) $package->price, 0, ',', '.') }}</p>
                    <div class="mt-6 space-y-3 border-t border-white/10 pt-6">
                        @foreach ($package->features as $feature)
                            <div class="flex items-start gap-3 text-sm text-white/70">
                                <span class="mt-1 text-orange-300">•</span>
                                <span>{{ $feature->feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:pb-16">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Portfolio Terkait</span>
                <h2 class="text-3xl font-semibold text-white">Contoh hasil kerja untuk layanan ini.</h2>
            </div>
            <a href="{{ route('portfolios.index') }}" class="text-sm font-semibold text-white/75 transition hover:text-orange-300">Semua portfolio</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($service->portfolios as $portfolio)
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5">
                    <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->title }}" class="h-52 w-full object-cover sm:h-56">
                    <div class="space-y-4 p-6">
                        <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $portfolio->title }}</h3>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit($portfolio->description, 120) }}</p>
                        <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Lihat Detail</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio untuk layanan ini.</div>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:pb-20">
        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 sm:p-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Next Step</p>
                    <h2 class="mt-4 text-3xl font-semibold text-white">Butuh layanan serupa untuk bisnis Anda?</h2>
                </div>
                <a href="{{ route('home') }}#consultation" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-400 sm:w-auto">Diskusikan Project</a>
            </div>
        </div>
    </section>
@endsection
