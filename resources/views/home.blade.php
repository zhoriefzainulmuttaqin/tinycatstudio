@extends('layouts.app')

@section('title', 'TinyCatStudio | Software House Premium untuk Website, App, Design & Ads')
@section('meta_description', 'TinyCatStudio adalah software house premium yang menghadirkan jasa pembuatan website, aplikasi mobile, logo design, graphic design, dan iklan digital dengan eksekusi elegan dan conversion-minded.')

@section('content')
    @php
        $highlights = [
            'Custom website dengan UI premium, struktur rapi, dan fondasi SEO yang enak dipakai jangka panjang.',
            'Aplikasi mobile yang halus dipakai, stabil dioperasikan, dan siap dikembangkan saat bisnis bertumbuh.',
            'Logo design dan graphic design yang membuat brand terlihat lebih tajam, lebih mahal, dan lebih mudah diingat.',
            'Iklan digital yang diarahkan ke leads, dibantu landing page dan pesan yang tidak asal lempar budget.',
        ];

        $workflow = [
            ['step' => '01', 'title' => 'Discovery', 'description' => 'Kami bedah bisnis, audiens, dan target Anda lebih dulu supaya project tidak berlari ke mana-mana seperti kitten mengejar laser.'],
            ['step' => '02', 'title' => 'Strategy', 'description' => 'Struktur halaman, flow aplikasi, arah visual, dan funnel iklan disusun agar setiap keputusan terasa elegan sekaligus masuk akal.'],
            ['step' => '03', 'title' => 'Production', 'description' => 'Design, development, copy, dan quality control kami jalankan dalam ritme yang cepat, rapi, dan transparan.'],
            ['step' => '04', 'title' => 'Launch & Scale', 'description' => 'Setelah rilis, kami bantu polishing, iterasi, dan scale-up agar aset digital Anda terus menghasilkan value.'],
        ];

        $valueProps = [
            [
                'label' => 'Software + Brand + Ads',
                'title' => 'Satu studio untuk build, visual, dan growth yang saling menguatkan.',
                'description' => 'TinyCatStudio menyatukan software development, design, branding, dan ads supaya output tidak terasa sambung-tempel.',
                'points' => ['Brief lebih efisien', 'Eksekusi lebih sinkron'],
            ],
            [
                'label' => 'Luxury Experience',
                'title' => 'Antarmuka terasa premium, brand terasa lebih berkelas.',
                'description' => 'Kami meracik hierarchy, motion, typography, dan copy agar first impression Anda bekerja sekeras tim sales.',
                'points' => ['UI bersih dan berwibawa', 'Presentasi lebih meyakinkan'],
            ],
            [
                'label' => 'Sharp Scalability',
                'title' => 'Dibangun rapi sejak awal agar mudah tumbuh belakangan.',
                'description' => 'Dari landing page sampai aplikasi mobile, semuanya kami siapkan dengan fondasi yang enak dirawat dan enak dikembangkan.',
                'points' => ['Siap tambah fitur', 'Siap support campaign'],
            ],
        ];

        $studioSignals = [
            'Custom Website',
            'Mobile App Build',
            'Logo Identity',
            'Graphic Design System',
            'Ads Campaign Management',
            'Landing Page Funnel',
            'Brand Presentation Kit',
            'Conversion Copy Support',
        ];

        $engagementModes = [
            ['title' => 'Fast Mapping', 'description' => 'Brief cepat dipetakan supaya Anda langsung tahu langkah, prioritas, dan estimasi awal.'],
            ['title' => 'Premium Craft', 'description' => 'Code, visual, dan copy dipoles sampai terasa clean, mahal, dan siap dipamerkan.'],
            ['title' => 'Conversion Focus', 'description' => 'Setiap output diarahkan ke trust, leads, adoption, atau efisiensi operasional.'],
        ];

        $trustPills = [
            'Luxury UI & UX',
            'Scalable software build',
            'Branding with claws',
            'Ads that chase leads',
        ];

        $heroSignals = [
            ['label' => 'Brand Image', 'value' => 'Lebih prestisius'],
            ['label' => 'Launch Pace', 'value' => 'Lebih terarah'],
            ['label' => 'Conversion', 'value' => 'Lebih siap closing'],
        ];

        $conversionSignals = [
            ['value' => '72H', 'label' => 'untuk mapping awal, rekomendasi solusi, dan next move'],
            ['value' => '5', 'label' => 'layanan inti dalam satu partner premium'],
            ['value' => '1', 'label' => 'tiny team dengan perhatian detail yang serius'],
        ];

        $portfolioProofs = [
            'Visual dan positioning terasa lebih kredibel saat dipresentasikan ke calon klien atau investor.',
            'User flow, messaging, dan CTA bekerja lebih selaras untuk mendorong action.',
            'Software, design, dan campaign thinking terasa nyambung, bukan tempelan.',
        ];

        $pricingAssurances = [
            'Harga transparan dan bisa disesuaikan dengan scope, timeline, serta prioritas bisnis.',
            'Visual, struktur, dan deliverable dipikirkan dari awal, bukan diimprovisasi di tengah jalan.',
            'Setiap paket siap dikembangkan ke fitur baru, campaign baru, atau retainer support.',
        ];

        $serviceAudienceResolver = static function (string $serviceName): string {
            $normalized = strtolower($serviceName);

            return match (true) {
                str_contains($normalized, 'website') => 'Cocok untuk company profile premium, landing page campaign, katalog produk, atau website penjualan yang harus tampil elegan sekaligus gampang dipakai.',
                str_contains($normalized, 'mobile') => 'Ideal untuk bisnis yang ingin layanan lebih dekat ke pengguna lewat aplikasi membership, booking, operasional, atau commerce.',
                str_contains($normalized, 'logo') => 'Pas untuk brand baru maupun brand lama yang ingin tampil lebih tajam, lebih konsisten, dan lebih mudah diingat.',
                str_contains($normalized, 'graphic') => 'Cocok untuk social media kit, deck, materi campaign, dan aset visual yang perlu terlihat satu kelas.',
                str_contains($normalized, 'ads') => 'Relevan untuk brand yang butuh traffic berkualitas, funnel rapi, dan iklan yang tidak buang budget seperti kucing iseng menjatuhkan gelas.',
                default => 'Bisa disesuaikan untuk software, branding, visual campaign, maupun support growth dengan pendekatan yang lebih presisi.',
            };
        };

        $serviceOutcomeResolver = static function (string $serviceName): array {
            $normalized = strtolower($serviceName);

            return match (true) {
                str_contains($normalized, 'website') => ['UI lebih elegan', 'Flow lebih jelas', 'Lebih siap closing'],
                str_contains($normalized, 'mobile') => ['Experience lebih halus', 'Retention lebih sehat', 'Siap scale fitur'],
                str_contains($normalized, 'logo') => ['Identitas lebih ikonik', 'Brand lebih konsisten', 'Lebih layak dipresentasikan'],
                str_contains($normalized, 'graphic') => ['Materi lebih classy', 'Campaign lebih rapi', 'Konten lebih mudah dibedakan'],
                str_contains($normalized, 'ads') => ['Angle lebih tajam', 'Landing lebih sinkron', 'Leads lebih serius'],
                default => ['Lebih rapi', 'Lebih meyakinkan', 'Lebih siap scale'],
            };
        };

        $pricingServices = $featuredPackages
            ->map(fn ($package) => $package->service)
            ->filter()
            ->unique('id')
            ->values();

        $featuredTestimonial = $testimonials->first();
        $otherTestimonials = $testimonials->skip(1)->take(3);
        $featuredPortfolio = $featuredPortfolios->first();
        $supportingPortfolios = $featuredPortfolios->skip(1)->take(2);
    @endphp

    <section class="section-noise relative mx-auto max-w-7xl px-4 pb-8 pt-12 sm:px-6 sm:pb-10 sm:pt-16 lg:px-8 lg:pb-16 lg:pt-24">
        <div class="grid-pattern pointer-events-none absolute inset-0 -z-20 opacity-35"></div>
        <div class="ambient-orb ambient-orb--orange left-[2%] top-24 -z-10 hidden h-56 w-56 sm:block"></div>
        <div class="ambient-orb ambient-orb--white right-[8%] top-10 -z-10 hidden h-44 w-44 sm:block"></div>
        <div class="ambient-orb ambient-orb--orange bottom-8 right-[18%] -z-10 hidden h-48 w-48 sm:block"></div>

        <div class="grid gap-10 sm:gap-12 md:grid-cols-[0.94fr_1.06fr] md:items-start lg:grid-cols-[1.02fr_0.98fr] lg:items-center">
            <div class="space-y-8" data-reveal="left">
                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.3em] text-orange-300 sm:text-xs sm:tracking-[0.35em]">PREMIUM SOFTWARE HOUSE</span>

                <div class="space-y-6">
                    <h1 class="max-w-5xl text-4xl font-semibold leading-[0.98] text-white sm:text-5xl md:text-[3.75rem] lg:text-6xl xl:text-[5.2rem]">
                        Website, mobile app, dan brand assets yang
                        <span class="bg-gradient-to-r from-white via-orange-200 to-orange-400 bg-clip-text text-transparent">terlihat elegan</span>
                        dan bekerja presisi untuk growth.
                    </h1>
                    <p class="max-w-2xl text-base leading-7 text-white/65 sm:text-lg sm:leading-8">
                        TinyCatStudio adalah software house premium untuk website, aplikasi mobile, logo design, graphic design, dan jasa iklan—tenang di tampilan, tajam di eksekusi, sedikit seperti tiny cat yang kelihatan manis tapi refleksnya cepat.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:gap-4">
                    <a href="#consultation" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-6 py-3.5 text-sm font-semibold text-white shadow-[0_18px_48px_rgba(255,122,0,0.28)] transition hover:-translate-y-0.5 hover:bg-orange-400 sm:w-auto">Mulai Brief Project</a>
                    <a href="#portfolio" class="inline-flex w-full items-center justify-center rounded-full border border-white/15 px-6 py-3.5 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5 sm:w-auto">Lihat Case Study</a>
                </div>

                <div class="grid gap-3 sm:grid-cols-3">
                    @foreach ($conversionSignals as $signal)
                        <div class="luxury-panel rounded-[1.35rem] border border-white/10 px-4 py-4 backdrop-blur-sm" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
                            <p class="text-2xl font-semibold text-white">{{ $signal['value'] }}</p>
                            <p class="mt-2 text-sm leading-6 text-white/60">{{ $signal['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach (array_slice($highlights, 0, 2) as $highlight)
                        <div class="luxury-panel rounded-[1.75rem] border border-white/10 bg-black/25 p-5 text-sm leading-7 text-white/70 backdrop-blur-sm" style="transition-delay: {{ $loop->index * 110 }}ms" data-reveal>
                            {{ $highlight }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="parallax-scene relative w-full max-w-xl mx-auto lg:max-w-none" data-reveal="right" data-parallax-scene>
                <div class="luxury-panel parallax-layer relative overflow-hidden rounded-[2.5rem] border border-white/10 bg-neutral-950/40 p-5 shadow-[0_35px_120px_rgba(0,0,0,0.48)] backdrop-blur-xl sm:p-6" data-parallax="16" data-rotate="8" data-tilt-card data-tilt-intensity="7">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,122,0,0.12),transparent_45%)]"></div>
                    <div class="absolute inset-0 bg-[linear-gradient(145deg,rgba(255,255,255,0.03),rgba(255,255,255,0.01))]"></div>
                    <div class="absolute inset-x-10 top-0 h-px bg-gradient-to-r from-transparent via-orange-400/40 to-transparent"></div>

                    <div class="relative space-y-4">
                        <div class="rounded-[2rem] border border-white/10 bg-white/[0.03] p-6 sm:p-8">
                            <div class="mb-5 flex items-center justify-between">
                                <p class="text-xs font-semibold tracking-[0.3em] text-orange-300">TINYCATSTUDIO</p>
                                <div class="flex items-center gap-2 rounded-full border border-orange-500/20 bg-orange-500/10 px-3 py-1">
                                    <span class="relative flex h-2 w-2">
                                      <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75"></span>
                                      <span class="relative inline-flex h-2 w-2 rounded-full bg-orange-500"></span>
                                    </span>
                                    <span class="text-[10px] font-medium uppercase tracking-wider text-orange-200">Open for build</span>
                                </div>
                            </div>
                            <h2 class="text-2xl font-semibold leading-snug text-white sm:text-3xl">Desain mahal,<br/>eksekusi tajam.</h2>
                            <p class="mt-4 text-sm leading-7 text-white/60">Menyediakan satu sistem kerja untuk software, branding, dan growth yang tenang dilihat dan jelas dipahami.</p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/40">Premium UI</p>
                                <p class="mt-3 text-lg font-semibold text-white">Classy, tidak ramai.</p>
                                <p class="mt-2 text-xs leading-6 text-white/50">Hierarchy & spacing tertata rapi.</p>
                            </div>
                            <div class="rounded-[1.75rem] border border-white/10 bg-black/40 p-6">
                                <p class="text-xs uppercase tracking-[0.3em] text-orange-200/60">Growth Layer</p>
                                <p class="mt-3 text-lg font-semibold text-white">Siap mengejar lead.</p>
                                <p class="mt-2 text-xs leading-6 text-white/50">Funnel didesain untuk closing.</p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach ($metrics as $metric)
                                <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6">
                                    <p class="text-3xl font-semibold text-white">{{ str_pad((string) $metric['value'], 2, '0', STR_PAD_LEFT) }}</p>
                                    <p class="mt-1 text-xs text-white/50">{{ $metric['label'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-white/10 bg-white/[0.03] py-4">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 lg:px-8">
            <div class="marquee-track items-center gap-6 whitespace-nowrap text-sm text-white/65">
                @foreach (array_merge($studioSignals, $studioSignals) as $signal)
                    <span class="inline-flex items-center gap-3">
                        <span class="text-orange-300">•</span>
                        <span>{{ $signal }}</span>
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div class="max-w-3xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Why TinyCatStudio</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Nama boleh TinyCatStudio, tapi standar craft, code, dan conversion-nya jelas tidak kecil.</h2>
            </div>
            <p class="max-w-2xl text-white/65">Kami cocok untuk bisnis yang ingin satu partner premium untuk software development, design system, dan campaign yang saling menguatkan dari launch sampai growth.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-[1.04fr_0.96fr] lg:grid-cols-[1.1fr_0.9fr]">
            <div class="luxury-panel rounded-[2.25rem] border border-white/10 p-8 shadow-[0_24px_80px_rgba(0,0,0,0.35)]" data-reveal="left" data-tilt-card data-tilt-intensity="5">
                <div class="max-w-2xl space-y-4">
                    <span class="inline-flex rounded-full border border-orange-400/25 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.3em] text-orange-200">ONE STRATEGIC PARTNER</span>
                    <h3 class="text-3xl font-semibold text-white">Satu studio untuk software, design, dan ads yang bergerak dalam ritme yang sama.</h3>
                    <p class="text-white/65">Dari website, aplikasi mobile, logo, graphic design, sampai campaign iklan, semuanya dikerjakan dengan standar visual yang konsisten dan alur kerja yang efisien.</p>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($engagementModes as $mode)
                        <div class="rounded-[1.5rem] border border-white/10 bg-black/25 p-5">
                            <p class="text-sm font-semibold text-white">{{ $mode['title'] }}</p>
                            <p class="mt-2 text-sm leading-7 text-white/60">{{ $mode['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-6">
                @foreach ($valueProps as $item)
                    <article class="luxury-panel hover-lift rounded-[2rem] border border-white/10 p-6" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal data-tilt-card data-tilt-intensity="4">
                        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-300">{{ $item['label'] }}</span>
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-white/60">{{ $item['description'] }}</p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            @foreach ($item['points'] as $point)
                                <span class="rounded-full border border-white/10 px-3 py-2 text-xs font-semibold text-white/65">{{ $point }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="services" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div class="max-w-2xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Layanan Utama</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Layanan inti untuk brand yang butuh build, look, dan growth dalam satu orbit.</h2>
            </div>
            <p class="max-w-2xl text-white/65">Anda tidak perlu memecah project ke banyak vendor. TinyCatStudio menyatukan software development, design, branding, dan ads dalam workflow yang lebih tenang dan lebih presisi.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($services as $service)
                <article class="luxury-panel hover-lift group rounded-[2rem] border border-white/10 p-5 shadow-[0_16px_60px_rgba(0,0,0,0.22)] sm:p-6" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal data-tilt-card data-tilt-intensity="5">
                    <div class="absolute inset-x-6 top-0 h-px bg-gradient-to-r from-transparent via-orange-400/70 to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></div>
                    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-orange-400/25 bg-orange-500/10 text-sm font-bold tracking-[0.3em] text-orange-300 sm:h-14 sm:w-14">
                            {{ $service->icon ?: strtoupper(substr($service->name, 0, 2)) }}
                        </div>
                        <span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/45">{{ $service->pricingPackages->count() }} paket</span>
                    </div>

                    <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $service->name }}</h3>
                    <p class="mt-4 text-sm leading-7 text-white/65">{{ $service->description }}</p>

                    <div class="mt-6 space-y-3">
                        @foreach ($service->serviceDetails->take(3) as $detail)
                            <div class="rounded-2xl border border-white/10 bg-black/25 px-4 py-3 text-sm text-white/70">
                                <span class="font-semibold text-white">{{ $detail->title }}</span>
                                <p class="mt-1 text-white/55">{{ $detail->description }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-col items-start gap-4 border-t border-white/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/40">Mulai dari</p>
                            <p class="mt-2 text-xl font-semibold text-white">Rp {{ number_format((float) ($service->pricingPackages->min('price') ?? 0), 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('services.show', $service) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Pelajari Layanan</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada layanan yang tersedia.</div>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="overflow-hidden rounded-[2.25rem] border border-white/10 bg-white/[0.04] p-8 lg:p-10">
            <div class="mb-10 max-w-3xl space-y-4" data-reveal>
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Workflow</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Workflow yang elegan, jelas, dan tidak bikin project berlarian liar.</h2>
            </div>

            <div class="relative">
                <div class="absolute left-0 right-0 top-8 hidden h-px bg-gradient-to-r from-transparent via-orange-400/30 to-transparent lg:block"></div>
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @foreach ($workflow as $item)
                        <article class="luxury-panel rounded-[1.8rem] border border-white/10 p-5" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
                            <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-2xl border border-orange-400/25 bg-orange-500/10 text-sm font-semibold tracking-[0.35em] text-orange-300">{{ $item['step'] }}</div>
                            <h3 class="text-xl font-semibold text-white">{{ $item['title'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-white/60">{{ $item['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div class="max-w-3xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Portfolio</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Case study yang menunjukkan bagaimana software, visual, dan strategy membuat brand tampak lebih serius dan lebih siap deal.</h2>
            </div>
            <a href="{{ route('portfolios.index') }}" class="inline-flex items-center text-sm font-semibold text-white/75 transition hover:text-orange-300">Lihat semua case study</a>
        </div>

        <div class="grid gap-6 md:grid-cols-[1.04fr_0.96fr] lg:grid-cols-[1.1fr_0.9fr]">
            @if ($featuredPortfolio)
                <article class="group luxury-panel overflow-hidden rounded-[2.5rem] border border-white/10 shadow-[0_28px_90px_rgba(0,0,0,0.32)]" data-reveal="left" data-tilt-card data-tilt-intensity="6">
                    <div class="relative min-h-[620px] overflow-hidden sm:min-h-[440px]">
                        <img src="{{ $featuredPortfolio->thumbnail }}" alt="{{ $featuredPortfolio->title }}" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/55 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8 lg:p-10">
                            <div class="max-w-2xl space-y-5">
                                <div class="flex flex-wrap items-center gap-3 text-sm">
                                    <span class="rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1 font-semibold text-orange-200">{{ $featuredPortfolio->service->name }}</span>
                                    @if ($featuredPortfolio->client_name)
                                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white/70">{{ $featuredPortfolio->client_name }}</span>
                                    @endif
                                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-white/70">Featured build</span>
                                </div>

                                <div>
                                    <h3 class="text-2xl font-semibold text-white break-words sm:text-3xl lg:text-4xl">{{ $featuredPortfolio->title }}</h3>
                                    <p class="mt-4 max-w-xl text-sm leading-7 text-white/75">{{ \Illuminate\Support\Str::limit($featuredPortfolio->description, 220) }}</p>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-3">
                                    @foreach ($serviceOutcomeResolver($featuredPortfolio->service->name) as $point)
                                        <div class="rounded-[1.4rem] border border-white/10 bg-white/[0.08] px-4 py-4 text-sm font-medium text-white/80 backdrop-blur-sm">
                                            {{ $point }}
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:flex-wrap sm:gap-4">
                                    <a href="{{ route('portfolios.show', $featuredPortfolio) }}" class="inline-flex w-full items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-orange-500 hover:text-white sm:w-auto">Pelajari Case Study</a>
                                    <a href="#consultation" class="inline-flex w-full items-center justify-center rounded-full border border-white/15 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Saya Mau Hasil Selevel Ini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @else
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio unggulan.</div>
            @endif

            <div class="grid gap-6">
                <div class="luxury-panel rounded-[2rem] border border-white/10 p-6" data-reveal="right">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-300">Kenapa ini penting?</span>
                    <h3 class="mt-4 text-2xl font-semibold text-white">Portfolio kami bukan pajangan manis semata.</h3>
                    <p class="mt-3 text-sm leading-7 text-white/65">Setiap case memperlihatkan bagaimana TinyCatStudio menggabungkan interface, messaging, dan build quality untuk hasil yang enak dilihat sekaligus enak dijual.</p>
                    <div class="mt-6 space-y-3">
                        @foreach ($portfolioProofs as $proof)
                            <div class="rounded-2xl border border-white/10 bg-black/25 px-4 py-4 text-sm text-white/70">{{ $proof }}</div>
                        @endforeach
                    </div>
                </div>

                @forelse ($supportingPortfolios as $portfolio)
                    <article class="group luxury-panel hover-lift overflow-hidden rounded-[2rem] border border-white/10" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal data-tilt-card data-tilt-intensity="4">
                        <div class="grid gap-0 sm:grid-cols-[0.95fr_1.05fr]">
                            <div class="overflow-hidden">
                                <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->title }}" class="h-full min-h-[220px] w-full object-cover transition duration-700 group-hover:scale-105">
                            </div>
                            <div class="space-y-4 p-6">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <span class="rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-200">{{ $portfolio->service->name }}</span>
                                    @if ($portfolio->client_name)
                                        <span class="text-sm text-white/45 break-words">{{ $portfolio->client_name }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-semibold text-white break-words sm:text-2xl">{{ $portfolio->title }}</h3>
                                <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit($portfolio->description, 130) }}</p>
                                <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10 sm:w-auto">Lihat Detail Project</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio tambahan.</div>
                @endforelse
            </div>
        </div>

        <div class="luxury-panel mt-8 rounded-[2rem] border border-orange-400/25 p-6 lg:p-8" data-reveal>
            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div class="max-w-2xl">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-200">Next Featured Case</span>
                    <h3 class="mt-3 text-2xl font-semibold text-white">Ingin project Anda jadi case study berikutnya yang bikin calon klien berhenti scroll?</h3>
                    <p class="mt-3 text-sm leading-7 text-white/65">Kami bantu merapikan visual, produk, dan angle penawaran agar brand Anda terasa lebih mahal dan lebih gampang dipercaya.</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="#consultation" class="inline-flex items-center rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Diskusikan Project Saya</a>
                    <a href="{{ route('portfolios.index') }}" class="inline-flex items-center rounded-full border border-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Eksplor Semua Case Study</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid gap-6 md:grid-cols-[1fr_1fr]">
            @if ($featuredTestimonial)
                <article class="luxury-panel rounded-[2.25rem] border border-white/10 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.32)] sm:p-8" data-reveal="left" data-tilt-card data-tilt-intensity="4">
                    <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Client Voice</span>
                    <div class="mt-6 flex items-center gap-1 text-orange-300">
                        @for ($i = 0; $i < $featuredTestimonial->rating; $i++)
                            <span>★</span>
                        @endfor
                    </div>
                    <p class="mt-6 text-xl font-medium leading-8 text-white sm:text-2xl sm:leading-10">“{{ $featuredTestimonial->message }}”</p>
                    <div class="mt-8 border-t border-white/10 pt-6">
                        <p class="font-semibold text-white">{{ $featuredTestimonial->name }}</p>
                        <p class="text-sm text-white/45">{{ $featuredTestimonial->company ?: 'Klien TinyCatStudio' }}</p>
                    </div>
                </article>
            @else
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada testimoni utama.</div>
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                @forelse ($otherTestimonials as $testimonial)
                    <article class="luxury-panel rounded-[2rem] border border-white/10 p-6" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
                        <div class="mb-5 flex items-center gap-1 text-orange-300">
                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                <span>★</span>
                            @endfor
                        </div>
                        <p class="text-sm leading-7 text-white/70">“{{ $testimonial->message }}”</p>
                        <div class="mt-6">
                            <p class="font-semibold text-white">{{ $testimonial->name }}</p>
                            <p class="text-sm text-white/45">{{ $testimonial->company ?: 'Klien TinyCatStudio' }}</p>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55 md:col-span-2">Belum ada testimoni tambahan.</div>
                @endforelse

                <div class="luxury-panel rounded-[2rem] border border-orange-400/25 p-6 md:col-span-2" data-reveal>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-200">Client Trust</span>
                    <h3 class="mt-4 text-2xl font-semibold text-white">Target kami sederhana: ketika orang melihat brand Anda, rasa percayanya datang lebih dulu.</h3>
                    <p class="mt-3 text-sm leading-7 text-white/70">Kalau tiny cat biasanya mencuri perhatian dengan muka lucu, kami melakukannya lewat UI yang elegan, software yang stabil, dan positioning yang presisi.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="mx-auto max-w-7xl px-6 py-16 lg:px-8" x-data="{ activePricing: 'all' }">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between" data-reveal>
            <div class="max-w-3xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Investment Plans</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Paket investasi yang transparan, terasa premium, dan gampang dipilih sesuai ambisi project Anda.</h2>
                <p class="text-white/65">Mulai dari layanan inti yang paling relevan hari ini, lalu scale ke build, design, atau ads berikutnya tanpa kehilangan arah.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="button" @click="activePricing = 'all'" :class="activePricing === 'all' ? 'border-orange-400/50 bg-orange-500 text-white' : 'border-white/10 text-white/65 hover:border-white/30 hover:text-white'" class="rounded-full border px-4 py-2 text-sm font-semibold transition">
                    Semua
                </button>
                @foreach ($pricingServices as $pricingService)
                    <button type="button" @click="activePricing = '{{ $pricingService->slug }}'" :class="activePricing === '{{ $pricingService->slug }}' ? 'border-orange-400/50 bg-orange-500 text-white' : 'border-white/10 text-white/65 hover:border-white/30 hover:text-white'" class="rounded-full border px-4 py-2 text-sm font-semibold transition">
                        {{ $pricingService->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="mb-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($pricingAssurances as $assurance)
                <div class="luxury-panel rounded-[1.6rem] border border-white/10 p-5 text-sm leading-7 text-white/70" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal>
                    {{ $assurance }}
                </div>
            @endforeach
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($featuredPackages as $package)
                <article x-show="activePricing === 'all' || activePricing === '{{ $package->service->slug }}'" x-transition.opacity.duration.400ms class="luxury-panel pricing-glow hover-lift rounded-[2rem] border {{ $package->is_popular ? 'border-orange-400/40' : 'border-white/10' }} p-5 shadow-[0_18px_70px_rgba(0,0,0,0.22)] sm:p-6" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal data-tilt-card data-tilt-intensity="5">
                    <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <span class="text-sm font-semibold tracking-[0.2em] text-orange-300 break-words">{{ strtoupper($package->service->name) }}</span>
                        @if ($package->is_popular)
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-neutral-950">Best Seller</span>
                        @endif
                    </div>

                    <div class="mt-5">
                        <h3 class="text-2xl font-semibold text-white break-words">{{ $package->name }}</h3>
                        <p class="mt-3 text-sm leading-7 text-white/65">{{ $package->description }}</p>
                    </div>

                    <div class="mt-6 flex flex-col items-start gap-4 border-b border-white/10 pb-6 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/35">Investasi mulai dari</p>
                            <p class="mt-2 text-3xl font-semibold text-white sm:text-4xl">Rp {{ number_format((float) $package->price, 0, ',', '.') }}</p>
                        </div>
                        <span class="w-full rounded-full border border-white/10 px-3 py-2 text-center text-xs font-semibold text-white/65 sm:w-auto">Custom scope available</span>
                    </div>

                    <div class="mt-6 rounded-[1.5rem] border border-white/10 bg-black/25 p-4">
                        <p class="text-xs uppercase tracking-[0.3em] text-orange-300">Best fit</p>
                        <p class="mt-3 text-sm leading-7 text-white/70">{{ $serviceAudienceResolver($package->service->name) }}</p>
                    </div>

                    <div class="mt-6 space-y-3">
                        @foreach ($package->features as $feature)
                            <div class="flex items-start gap-3 text-sm text-white/70">
                                <span class="mt-1 text-orange-300">•</span>
                                <span>{{ $feature->feature }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="#consultation" data-service-target="{{ $package->service->id }}" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Pilih Paket Ini</a>
                        <a href="{{ route('services.show', $package->service) }}" class="inline-flex w-full items-center justify-center rounded-full border border-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Lihat Detail Layanan</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada paket harga.</div>
            @endforelse
        </div>

        <div class="luxury-panel mt-8 rounded-[2rem] border border-white/10 p-6 lg:p-8" data-reveal>
            <div class="grid gap-6 md:grid-cols-[1.05fr_0.95fr] md:items-center lg:grid-cols-[1.15fr_0.85fr]">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-300">Need custom proposal?</span>
                    <h3 class="mt-3 text-2xl font-semibold text-white">Kalau kebutuhan Anda lebih kompleks, kami siapkan proposal yang terasa tailor-made, bukan copy-paste.</h3>
                    <p class="mt-3 text-sm leading-7 text-white/65">Ideal untuk website multi-page, aplikasi custom, rebranding menyeluruh, graphic system, funnel iklan, atau kombinasi beberapa layanan sekaligus.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-1">
                    <a href="#consultation" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-orange-500 hover:text-white">Minta Proposal Custom</a>
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center rounded-full border border-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Diskusi via WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid gap-6 md:grid-cols-[0.82fr_1.18fr] lg:grid-cols-[0.75fr_1.25fr]">
            <div class="space-y-4" data-reveal="left">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">FAQ</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Pertanyaan yang biasanya muncul sebelum brand Anda build bareng TinyCatStudio.</h2>
                <p class="text-white/60">Kami menjaga proses tetap terbuka, rapi, dan minim drama karena project premium seharusnya terasa tenang dari awal.</p>
            </div>
            <div class="space-y-4">
                @forelse ($faqs as $faq)
                    <details class="group luxury-panel rounded-[1.75rem] border border-white/10 p-5" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-lg font-semibold text-white">
                            <span>{{ $faq->question }}</span>
                            <span class="text-2xl text-white/35 transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-4 text-sm leading-7 text-white/60">{{ $faq->answer }}</p>
                    </details>
                @empty
                    <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada FAQ.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div class="max-w-2xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Insights</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Insight software house, design, dan growth yang membantu keputusan digital Anda terasa lebih cerdas.</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-sm font-semibold text-white/75 transition hover:text-orange-300">Lihat semua insight</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($blogPosts as $post)
                <article class="group luxury-panel hover-lift overflow-hidden rounded-[2rem] border border-white/10 shadow-[0_16px_60px_rgba(0,0,0,0.22)]" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal data-tilt-card data-tilt-intensity="4">
                    <div class="overflow-hidden">
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="h-56 w-full object-cover transition duration-700 group-hover:scale-105">
                    </div>
                    <div class="space-y-4 p-6">
                        <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-orange-300">
                            @foreach ($post->categories as $category)
                                <span>{{ $category->name }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-2xl font-semibold text-white">{{ $post->title }}</h3>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}</p>
                        <a href="{{ route('blog.show', $post) }}" class="inline-flex items-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Baca Artikel</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada artikel.</div>
            @endforelse
        </div>
    </section>

    <section id="consultation" class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:pb-24">
        <div class="grid gap-6 md:grid-cols-[0.92fr_1.08fr] lg:grid-cols-[0.78fr_1.22fr]">
            <div class="luxury-panel rounded-[2.25rem] border border-white/10 p-8 shadow-[0_24px_80px_rgba(0,0,0,0.32)]" data-reveal="left">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Project Brief</span>
                <h2 class="mt-5 text-3xl font-semibold text-white">Ceritakan apa yang ingin Anda bangun, kami bantu susun solusi yang paling pas.</h2>
                <p class="mt-4 text-sm leading-7 text-white/65">Brief singkat ini kami gunakan untuk memetakan scope, estimasi awal, dan arah eksekusi tanpa jawaban generik atau template yang terasa asal copy.</p>

                <div class="mt-8 space-y-4">
                    <div class="rounded-[1.5rem] border border-white/10 bg-black/25 p-5">
                        <p class="text-sm font-semibold text-white">Yang Anda dapatkan</p>
                        <ul class="mt-3 space-y-2 text-sm leading-7 text-white/65">
                            <li>• Rekomendasi layanan dan prioritas build yang paling relevan</li>
                            <li>• Estimasi awal budget, timeline, dan fase pengembangan</li>
                            <li>• Arah visual, fitur, serta funnel yang lebih jelas</li>
                        </ul>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-5 text-sm leading-7 text-white/65">
                        Cocok untuk company profile premium, landing page iklan, aplikasi mobile/internal, logo system, graphic campaign, sampai scale-up ads.
                    </div>
                </div>
            </div>

            <form action="{{ route('leads.store') }}" method="POST" class="luxury-panel space-y-5 rounded-[2.25rem] border border-white/10 p-6 shadow-[0_20px_70px_rgba(0,0,0,0.28)] backdrop-blur-sm lg:p-8" data-reveal="right">
                @csrf
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="lead_name" class="mb-2 block text-sm text-white/70">Nama</label>
                        <input id="lead_name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Nama PIC / brand">
                        @error('name', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="lead_email" class="mb-2 block text-sm text-white/70">Email</label>
                        <input id="lead_email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="email@brandanda.com">
                        @error('email', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="lead_phone" class="mb-2 block text-sm text-white/70">No. WhatsApp</label>
                        <input id="lead_phone" name="phone" type="text" value="{{ old('phone') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="08xxxxxxxxxx">
                        @error('phone', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="lead_service" class="mb-2 block text-sm text-white/70">Layanan</label>
                        <select id="lead_service" name="service_id" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400">
                            <option value="">Pilih layanan utama</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @error('service_id', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label for="lead_budget" class="mb-2 block text-sm text-white/70">Budget (opsional)</label>
                    <input id="lead_budget" name="budget" type="text" value="{{ old('budget') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Contoh: Rp 15.000.000 - Rp 50.000.000">
                </div>
                <div>
                    <label for="lead_message" class="mb-2 block text-sm text-white/70">Brief project</label>
                    <textarea id="lead_message" name="message" rows="5" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Ceritakan target, fitur, style visual, atau campaign yang ingin Anda jalankan">{{ old('message') }}</textarea>
                    @error('message', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-5 py-3.5 font-semibold text-white shadow-[0_16px_40px_rgba(255,122,0,0.25)] transition hover:-translate-y-0.5 hover:bg-orange-400">Kirim Brief ke TinyCatStudio</button>
            </form>
        </div>
    </section>
@endsection
