@extends('layouts.app')

@section('title', 'TinyCatStudio | Website, Mobile App, Branding & Ads')
@section('meta_description', 'TinyCatStudio adalah software house dan creative studio untuk pembuatan website, aplikasi mobile, logo design, graphic design, dan jasa iklan digital.')

@section('content')
    @php
        $highlights = [
            'Website yang cepat, SEO-friendly, dan mudah dikelola oleh tim Anda.',
            'Aplikasi mobile yang fokus pada usability, stabilitas, dan performa.',
            'Identitas visual yang konsisten untuk menaikkan trust dan daya ingat brand.',
            'Iklan digital yang dirancang untuk menghasilkan leads, bukan sekadar traffic.',
        ];

        $workflow = [
            ['step' => '01', 'title' => 'Discovery', 'description' => 'Kami petakan kebutuhan bisnis, target market, dan prioritas terdekat agar arah project selalu jelas sejak awal.'],
            ['step' => '02', 'title' => 'Strategy', 'description' => 'Struktur halaman, user flow, positioning visual, dan ruang pertumbuhan dirancang supaya hasilnya tidak sekadar bagus di permukaan.'],
            ['step' => '03', 'title' => 'Execution', 'description' => 'Desain, development, testing, dan quality control dijalankan cepat dengan komunikasi yang rapi dan milestone yang transparan.'],
            ['step' => '04', 'title' => 'Launch & Growth', 'description' => 'Setelah rilis, kami bantu optimasi funnel, maintenance, dan iterasi agar aset digital Anda terus berkembang.'],
        ];

        $valueProps = [
            [
                'label' => 'Strategic Execution',
                'title' => 'Satu partner untuk product, visual, dan akuisisi.',
                'description' => 'TinyCatStudio menggabungkan software development, branding, dan performance marketing dalam satu arah eksekusi yang lebih sinkron.',
                'points' => ['Lebih sedikit revisi yang tidak perlu', 'Keputusan desain selalu relevan dengan goal bisnis'],
            ],
            [
                'label' => 'Premium Delivery',
                'title' => 'Detail visual rapi, experience terasa mahal.',
                'description' => 'Kami merancang antarmuka dan materi visual yang terasa modern, terkurasi, dan siap dipresentasikan ke calon klien atau investor.',
                'points' => ['UI lebih clean dan terstruktur', 'Presentasi brand lebih percaya diri'],
            ],
            [
                'label' => 'Scalable Build',
                'title' => 'Pondasi yang enak dikembangkan setelah launch.',
                'description' => 'Mulai dari landing page hingga aplikasi internal, semuanya dibangun agar mudah dirawat, diukur, dan dilanjutkan ke tahap berikutnya.',
                'points' => ['Mudah ditambah fitur', 'Siap integrasi untuk growth berikutnya'],
            ],
        ];

        $studioSignals = [
            'Website Development',
            'Mobile App Development',
            'Logo Design',
            'Graphic Design',
            'Ads Management',
            'Landing Page Funnel',
            'Brand System',
            'SEO Content Support',
        ];

        $engagementModes = [
            ['title' => 'Fast Response', 'description' => 'Brief dipetakan cepat agar Anda langsung tahu next step.'],
            ['title' => 'Premium Craft', 'description' => 'Visual, copy, dan UX dipoles untuk menaikkan persepsi brand.'],
            ['title' => 'Business Driven', 'description' => 'Setiap output diarahkan ke trust, leads, atau efisiensi operasional.'],
        ];

        $pricingServices = $featuredPackages
            ->map(fn ($package) => $package->service)
            ->filter()
            ->unique('id')
            ->values();

        $featuredTestimonial = $testimonials->first();
        $otherTestimonials = $testimonials->skip(1)->take(3);
    @endphp

    <section class="relative mx-auto max-w-7xl px-6 pb-10 pt-16 lg:px-8 lg:pb-16 lg:pt-24">
        <div class="grid-pattern pointer-events-none absolute inset-0 -z-20 opacity-35"></div>
        <div class="ambient-orb ambient-orb--orange left-[2%] top-24 -z-10 h-56 w-56"></div>
        <div class="ambient-orb ambient-orb--white right-[8%] top-10 -z-10 h-44 w-44"></div>
        <div class="ambient-orb ambient-orb--orange bottom-8 right-[18%] -z-10 h-48 w-48"></div>

        <div class="grid gap-10 lg:grid-cols-[1.08fr_0.92fr] lg:items-center">
            <div class="space-y-8" data-reveal="left">
                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.35em] text-orange-300">PREMIUM DIGITAL EXECUTION</span>

                <div class="space-y-6">
                    <h1 class="max-w-5xl text-5xl font-semibold leading-[1.02] text-white md:text-6xl xl:text-7xl">
                        Bangun brand yang
                        <span class="bg-gradient-to-r from-white via-orange-200 to-orange-400 bg-clip-text text-transparent">terlihat premium</span>
                        dan sistem digital yang siap dipakai untuk growth.
                    </h1>
                    <p class="max-w-2xl text-lg leading-8 text-white/65">
                        {{ $siteSettings['site_tagline'] ?? 'TinyCatStudio membantu bisnis menghadirkan website, aplikasi mobile, desain visual, dan campaign digital yang rapi secara eksekusi serta kuat secara persepsi.' }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="#consultation" class="inline-flex items-center rounded-full bg-orange-500 px-6 py-3.5 text-sm font-semibold text-white shadow-[0_16px_40px_rgba(255,122,0,0.25)] transition hover:-translate-y-0.5 hover:bg-orange-400">Mulai Konsultasi</a>
                    <a href="{{ route('portfolios.index') }}" class="inline-flex items-center rounded-full border border-white/15 px-6 py-3.5 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5">Lihat Portfolio</a>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($engagementModes as $mode)
                        <div class="rounded-[1.6rem] border border-white/10 bg-white/[0.05] p-5 backdrop-blur-sm" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
                            <p class="text-sm font-semibold text-white">{{ $mode['title'] }}</p>
                            <p class="mt-2 text-sm leading-7 text-white/60">{{ $mode['description'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($highlights as $highlight)
                        <div class="rounded-[1.75rem] border border-white/10 bg-black/25 p-5 text-sm leading-7 text-white/70 backdrop-blur-sm" style="transition-delay: {{ $loop->index * 110 }}ms" data-reveal>
                            {{ $highlight }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative" data-reveal="right">
                <div class="floating-card absolute -left-4 top-10 hidden rounded-2xl border border-white/10 bg-neutral-950/80 px-4 py-3 text-sm text-white/70 shadow-2xl shadow-black/40 lg:block">
                    Fast launch <span class="text-orange-300">+</span> clean execution
                </div>
                <div class="floating-card absolute -right-4 bottom-14 hidden rounded-2xl border border-orange-400/30 bg-orange-500/10 px-4 py-3 text-sm font-semibold text-orange-200 shadow-2xl shadow-orange-950/30 lg:block" style="animation-delay: -2.4s;">
                    Black • White • Orange
                </div>

                <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 shadow-[0_35px_120px_rgba(0,0,0,0.45)] backdrop-blur-xl lg:p-8">
                    <div class="absolute inset-x-10 top-0 h-px bg-gradient-to-r from-transparent via-orange-400/70 to-transparent"></div>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,122,0,0.16),transparent_28%)]"></div>

                    <div class="relative space-y-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold tracking-[0.35em] text-orange-300">TINYCATSTUDIO</p>
                                <h2 class="mt-4 max-w-sm text-2xl font-semibold text-white">Studio partner untuk website, app, brand visual, dan growth campaign.</h2>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/65">Curated craft</span>
                        </div>

                        <div class="rounded-[2rem] border border-white/10 bg-neutral-950/80 p-5 lg:p-6">
                            <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-white/40">Core Service</p>
                                    <p class="mt-2 text-base font-semibold text-white">Full-stack Website & App Development</p>
                                </div>
                                <span class="rounded-full bg-orange-500 px-3 py-1 text-xs font-semibold text-white">Ready to Launch</span>
                            </div>

                            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                                @foreach ($metrics as $metric)
                                    <div class="rounded-[1.4rem] border border-white/10 bg-white/5 p-5">
                                        <p class="text-3xl font-semibold text-white">{{ str_pad((string) $metric['value'], 2, '0', STR_PAD_LEFT) }}</p>
                                        <p class="mt-2 text-sm text-white/55">{{ $metric['label'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-5">
                                <p class="text-xs uppercase tracking-[0.3em] text-white/40">Visual System</p>
                                <p class="mt-3 text-xl font-semibold text-white">Branding & Graphic Design</p>
                                <p class="mt-2 text-sm leading-7 text-white/60">Logo, key visual, social media assets, dan materi promosi yang konsisten di semua touchpoint.</p>
                            </div>
                            <div class="rounded-[1.75rem] border border-white/10 bg-orange-500/10 p-5">
                                <p class="text-xs uppercase tracking-[0.3em] text-orange-200/80">Growth Layer</p>
                                <p class="mt-3 text-xl font-semibold text-white">Ads & Funnel Optimization</p>
                                <p class="mt-2 text-sm leading-7 text-white/70">Landing page dan campaign dirancang agar visual yang bagus tetap berujung pada leads yang masuk.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-white/10 bg-white/[0.03] py-4">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 lg:px-8">
            <div class="marquee-track items-center gap-3 whitespace-nowrap text-sm text-white/65">
                @foreach (array_merge($studioSignals, $studioSignals) as $signal)
                    <span class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/[0.04] px-4 py-2">
                        <span class="text-orange-300">•</span>
                        <span>{{ $signal }}</span>
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
        <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between" data-reveal>
            <div class="max-w-3xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Why TinyCatStudio</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Bukan sekadar vendor, tapi partner eksekusi yang menjaga kualitas visual dan hasil bisnis berjalan bareng.</h2>
            </div>
            <p class="max-w-2xl text-white/65">Pendekatan kami cocok untuk brand yang ingin terlihat lebih matang, lebih dipercaya, dan lebih siap tumbuh lewat aset digital yang terukur.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="overflow-hidden rounded-[2.25rem] border border-white/10 bg-gradient-to-br from-white/[0.08] to-white/[0.03] p-8 shadow-[0_24px_80px_rgba(0,0,0,0.35)]" data-reveal="left">
                <div class="max-w-2xl space-y-4">
                    <span class="inline-flex rounded-full border border-orange-400/25 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.3em] text-orange-200">ONE STRATEGIC PARTNER</span>
                    <h3 class="text-3xl font-semibold text-white">Semua elemen digital Anda dirapikan dalam satu experience yang terasa premium.</h3>
                    <p class="text-white/65">Dari presentasi brand, landing page, aplikasi, sampai campaign iklan, semuanya disusun dengan standar visual yang konsisten dan alur kerja yang efisien.</p>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-3">
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
                    <article class="rounded-[2rem] border border-white/10 bg-black/25 p-6 transition duration-300 hover:-translate-y-1 hover:border-orange-400/30 hover:bg-white/[0.06]" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
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
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Solusi digital end-to-end untuk launch, branding, dan growth.</h2>
            </div>
            <p class="max-w-2xl text-white/65">Kami menyatukan development, design, dan marketing dalam satu workflow yang efisien sehingga Anda tidak perlu mengoordinasikan banyak vendor sekaligus.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
            @forelse ($services as $service)
                <article class="group relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.05] p-6 shadow-[0_16px_60px_rgba(0,0,0,0.22)] transition duration-300 hover:-translate-y-2 hover:border-orange-400/35 hover:bg-white/[0.08]" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal>
                    <div class="absolute inset-x-6 top-0 h-px bg-gradient-to-r from-transparent via-orange-400/70 to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></div>
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-orange-400/25 bg-orange-500/10 text-sm font-bold tracking-[0.3em] text-orange-300">
                            {{ $service->icon ?: strtoupper(substr($service->name, 0, 2)) }}
                        </div>
                        <span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/45">{{ $service->pricingPackages->count() }} paket</span>
                    </div>

                    <h3 class="text-2xl font-semibold text-white">{{ $service->name }}</h3>
                    <p class="mt-4 text-sm leading-7 text-white/65">{{ $service->description }}</p>

                    <div class="mt-6 space-y-3">
                        @foreach ($service->serviceDetails->take(3) as $detail)
                            <div class="rounded-2xl border border-white/10 bg-black/25 px-4 py-3 text-sm text-white/70">
                                <span class="font-semibold text-white">{{ $detail->title }}</span>
                                <p class="mt-1 text-white/55">{{ $detail->description }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/10 pt-5">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-white/40">Mulai dari</p>
                            <p class="mt-2 text-xl font-semibold text-white">Rp {{ number_format((float) ($service->pricingPackages->min('price') ?? 0), 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('services.show', $service) }}" class="inline-flex items-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Lihat Detail</a>
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
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Proses kerja yang jelas, cepat, dan tetap nyaman diikuti.</h2>
            </div>

            <div class="relative">
                <div class="absolute left-0 right-0 top-8 hidden h-px bg-gradient-to-r from-transparent via-orange-400/30 to-transparent lg:block"></div>
                <div class="grid gap-5 lg:grid-cols-4">
                    @foreach ($workflow as $item)
                        <article class="relative rounded-[1.8rem] border border-white/10 bg-black/25 p-5" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
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
            <div class="max-w-2xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Portfolio</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Project yang memperlihatkan kualitas visual, struktur, dan ketajaman eksekusi.</h2>
            </div>
            <a href="{{ route('portfolios.index') }}" class="inline-flex items-center text-sm font-semibold text-white/75 transition hover:text-orange-300">Lihat semua portfolio</a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($featuredPortfolios as $portfolio)
                <article class="group overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.05] shadow-[0_18px_60px_rgba(0,0,0,0.22)] {{ $loop->first ? 'lg:col-span-2 lg:grid lg:grid-cols-[1.05fr_0.95fr]' : '' }}" style="transition-delay: {{ $loop->index * 100 }}ms" data-reveal>
                    <div class="overflow-hidden {{ $loop->first ? 'min-h-[360px]' : '' }}">
                        <img src="{{ $portfolio->thumbnail }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                    </div>
                    <div class="space-y-4 p-6 lg:p-8">
                        <div class="flex items-center justify-between gap-4">
                            <span class="rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-200">{{ $portfolio->service->name }}</span>
                            @if ($portfolio->client_name)
                                <span class="text-sm text-white/45">{{ $portfolio->client_name }}</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-semibold text-white">{{ $portfolio->title }}</h3>
                        <p class="text-sm leading-7 text-white/60">{{ \Illuminate\Support\Str::limit($portfolio->description, 170) }}</p>
                        <a href="{{ route('portfolios.show', $portfolio) }}" class="inline-flex items-center rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Pelajari Project</a>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada portfolio unggulan.</div>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1fr_1fr]">
            @if ($featuredTestimonial)
                <article class="rounded-[2.25rem] border border-white/10 bg-gradient-to-br from-white/[0.08] to-orange-500/[0.08] p-8 shadow-[0_24px_80px_rgba(0,0,0,0.32)]" data-reveal="left">
                    <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Testimoni Utama</span>
                    <div class="mt-6 flex items-center gap-1 text-orange-300">
                        @for ($i = 0; $i < $featuredTestimonial->rating; $i++)
                            <span>★</span>
                        @endfor
                    </div>
                    <p class="mt-6 text-2xl font-medium leading-10 text-white">“{{ $featuredTestimonial->message }}”</p>
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
                    <article class="rounded-[2rem] border border-white/10 bg-black/25 p-6" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
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

                <div class="rounded-[2rem] border border-orange-400/25 bg-orange-500/10 p-6 md:col-span-2" data-reveal>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-orange-200">Client Experience</span>
                    <h3 class="mt-4 text-2xl font-semibold text-white">Tujuan kami bukan hanya membuat terlihat bagus, tapi membuat brand Anda lebih mudah dipercaya.</h3>
                    <p class="mt-3 text-sm leading-7 text-white/70">Itulah mengapa setiap project selalu kami jaga dari sisi struktur, pesan, visual, dan momentum launch.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="mx-auto max-w-7xl px-6 py-16 lg:px-8" x-data="{ activePricing: 'all' }">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between" data-reveal>
            <div class="max-w-2xl space-y-4">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Paket Harga</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Pilihan paket fleksibel untuk berbagai tahap bisnis dan skala project.</h2>
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

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($featuredPackages as $package)
                <article x-show="activePricing === 'all' || activePricing === '{{ $package->service->slug }}'" x-transition.opacity.duration.400ms class="rounded-[2rem] border {{ $package->is_popular ? 'border-orange-400/40 bg-orange-500/10' : 'border-white/10 bg-white/[0.05]' }} p-6 shadow-[0_16px_60px_rgba(0,0,0,0.2)]" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sm font-semibold tracking-[0.2em] text-orange-300">{{ strtoupper($package->service->name) }}</span>
                        @if ($package->is_popular)
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-neutral-950">Populer</span>
                        @endif
                    </div>
                    <h3 class="mt-5 text-2xl font-semibold text-white">{{ $package->name }}</h3>
                    <p class="mt-3 text-sm leading-7 text-white/65">{{ $package->description }}</p>
                    <p class="mt-6 text-4xl font-semibold text-white">Rp {{ number_format((float) $package->price, 0, ',', '.') }}</p>
                    <div class="mt-6 space-y-3 border-t border-white/10 pt-6">
                        @foreach ($package->features as $feature)
                            <div class="flex items-start gap-3 text-sm text-white/70">
                                <span class="mt-1 text-orange-300">•</span>
                                <span>{{ $feature->feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-8 text-white/55">Belum ada paket harga.</div>
            @endforelse
        </div>
    </section>

    <section id="faq" class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[0.75fr_1.25fr]">
            <div class="space-y-4" data-reveal="left">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">FAQ</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Pertanyaan yang paling sering muncul sebelum project dimulai.</h2>
                <p class="text-white/60">Kami sengaja menjaga proses tetap transparan supaya Anda bisa mengambil keputusan lebih cepat dan lebih yakin.</p>
            </div>
            <div class="space-y-4">
                @forelse ($faqs as $faq)
                    <details class="group rounded-[1.75rem] border border-white/10 bg-white/[0.05] p-5" style="transition-delay: {{ $loop->index * 80 }}ms" data-reveal>
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
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Blog & SEO</span>
                <h2 class="text-3xl font-semibold text-white md:text-4xl">Konten yang membantu brand Anda membangun trust dan trafik organik.</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-sm font-semibold text-white/75 transition hover:text-orange-300">Baca semua artikel</a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse ($blogPosts as $post)
                <article class="group overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.05] shadow-[0_16px_60px_rgba(0,0,0,0.22)]" style="transition-delay: {{ $loop->index * 90 }}ms" data-reveal>
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
        <div class="grid gap-6 lg:grid-cols-[0.78fr_1.22fr]">
            <div class="overflow-hidden rounded-[2.25rem] border border-white/10 bg-gradient-to-br from-white/[0.08] to-orange-500/[0.07] p-8 shadow-[0_24px_80px_rgba(0,0,0,0.32)]" data-reveal="left">
                <span class="text-sm font-semibold uppercase tracking-[0.35em] text-orange-300">Konsultasi Gratis</span>
                <h2 class="mt-5 text-3xl font-semibold text-white">Ceritakan kebutuhan project Anda, kami bantu petakan solusi terbaiknya.</h2>
                <p class="mt-4 text-sm leading-7 text-white/65">Isi brief singkat berikut untuk mendapatkan rekomendasi layanan, estimasi awal, dan langkah eksekusi yang paling relevan.</p>

                <div class="mt-8 space-y-4">
                    <div class="rounded-[1.5rem] border border-white/10 bg-black/25 p-5">
                        <p class="text-sm font-semibold text-white">Yang Anda dapatkan</p>
                        <ul class="mt-3 space-y-2 text-sm leading-7 text-white/65">
                            <li>• Rekomendasi layanan sesuai kebutuhan bisnis</li>
                            <li>• Estimasi awal budget dan ruang pengembangan</li>
                            <li>• Arah visual dan strategi launch yang lebih jelas</li>
                        </ul>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-5 text-sm leading-7 text-white/65">
                        Ideal untuk website company profile, landing page iklan, aplikasi internal, branding, sampai support materi campaign.
                    </div>
                </div>
            </div>

            <form action="{{ route('leads.store') }}" method="POST" class="space-y-5 rounded-[2.25rem] border border-white/10 bg-black/30 p-6 shadow-[0_20px_70px_rgba(0,0,0,0.28)] backdrop-blur-sm lg:p-8" data-reveal="right">
                @csrf
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="lead_name" class="mb-2 block text-sm text-white/70">Nama</label>
                        <input id="lead_name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Nama lengkap">
                        @error('name', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="lead_email" class="mb-2 block text-sm text-white/70">Email</label>
                        <input id="lead_email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="email@bisnisanda.com">
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
                            <option value="">Pilih layanan</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @error('service_id', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label for="lead_budget" class="mb-2 block text-sm text-white/70">Budget (opsional)</label>
                    <input id="lead_budget" name="budget" type="text" value="{{ old('budget') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Contoh: Rp 10.000.000 - Rp 25.000.000">
                </div>
                <div>
                    <label for="lead_message" class="mb-2 block text-sm text-white/70">Brief project</label>
                    <textarea id="lead_message" name="message" rows="5" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Ceritakan kebutuhan website, aplikasi, desain, atau iklan Anda">{{ old('message') }}</textarea>
                    @error('message', 'lead')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-5 py-3.5 font-semibold text-white shadow-[0_16px_40px_rgba(255,122,0,0.25)] transition hover:-translate-y-0.5 hover:bg-orange-400">Kirim Brief Project</button>
            </form>
        </div>
    </section>
@endsection
