<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', ($siteSettings['site_name'] ?? 'TinyCatStudio') . ' | Software House Premium')</title>
        <meta
            name="description"
            content="@yield('meta_description', $siteSettings['site_tagline'] ?? 'TinyCatStudio adalah software house premium untuk website, aplikasi mobile, logo design, graphic design, dan jasa iklan digital.')"
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
        <script>
            (() => {
                try {
                    const storedTheme = localStorage.getItem('tinycatstudio-theme');
                    const theme = storedTheme === 'light' || storedTheme === 'dark'
                        ? storedTheme
                        : (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');

                    document.documentElement.setAttribute('data-theme', theme);
                    document.documentElement.style.colorScheme = theme;
                } catch {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    document.documentElement.style.colorScheme = 'dark';
                }
            })();
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-neutral-950 text-white antialiased">
        @php
            $navHome = route('home');
            $servicesLink = request()->routeIs('home') ? '#services' : $navHome . '#services';
            $portfolioLink = request()->routeIs('home') ? '#portfolio' : $navHome . '#portfolio';
            $pricingLink = request()->routeIs('home') ? '#pricing' : $navHome . '#pricing';
            $contactLink = request()->routeIs('home') ? '#contact' : $navHome . '#contact';
        @endphp

        <div class="relative isolate overflow-x-clip">
            <div class="site-background"></div>
            <div class="absolute inset-x-0 top-0 -z-10 h-[420px] bg-[radial-gradient(circle_at_top,_rgba(255,122,0,0.22),_transparent_46%)]"></div>

            <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-orange-400/10 bg-neutral-950/80 shadow-[0_12px_40px_rgba(0,0,0,0.28)] backdrop-blur-xl">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-2 sm:gap-3">
                        @if(!empty($siteSettings['site_logo']))
                            <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Logo' }}" class="h-9 w-9 shrink-0 rounded-xl object-cover sm:h-11 sm:w-11 sm:rounded-2xl">
                        @else
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-orange-400/40 bg-orange-500/15 text-[10px] font-semibold tracking-[0.2em] text-orange-300 sm:h-11 sm:w-11 sm:rounded-2xl sm:text-sm sm:tracking-[0.3em]">TCS</span>
                        @endif
                        <div class="min-w-0">
                            <p class="truncate text-[11px] font-semibold tracking-[0.18em] text-white sm:text-sm sm:tracking-[0.25em]">{{ strtoupper($siteSettings['site_name'] ?? 'TinyCatStudio') }}</p>
                            <p class="hidden text-xs text-white/55 sm:block">Software House • Mobile • Design • Ads</p>
                        </div>
                    </a>

                    <nav class="hidden items-center text-white/75 md:flex md:gap-5 md:text-xs lg:gap-8 lg:text-sm">
                        <a href="{{ $servicesLink }}" class="theme-nav-link transition hover:text-white">Layanan</a>
                        <a href="{{ route('portfolios.index') }}" class="theme-nav-link transition hover:text-white">Portfolio</a>
                        <a href="{{ route('blog.index') }}" class="theme-nav-link transition hover:text-white">Blog</a>
                        <a href="{{ $pricingLink }}" class="theme-nav-link transition hover:text-white">Harga</a>
                        <a href="{{ $contactLink }}" class="theme-nav-link transition hover:text-white">Kontak</a>
                    </nav>

                    <div class="hidden items-center gap-3 md:flex">
                        <button type="button" data-theme-toggle class="theme-toggle inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2.5 text-white shadow-[0_10px_30px_rgba(0,0,0,0.12)] backdrop-blur-sm">
                            <span class="text-[10px] font-semibold uppercase tracking-[0.24em] text-white/45">Tema</span>
                            <span class="theme-toggle-icons" aria-hidden="true">
                                <span class="theme-toggle-chip theme-toggle-chip--light" data-theme-chip="light">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                                <span class="theme-toggle-chip theme-toggle-chip--dark" data-theme-chip="dark">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                            </span>
                            <span data-theme-current class="sr-only">Mode gelap aktif dengan ikon kucing hitam</span>
                            <span data-theme-next class="sr-only">Aktifkan mode terang dengan ikon kucing putih</span>
                        </button>
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noreferrer" class="hidden items-center rounded-full border border-orange-400/40 bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-400 lg:inline-flex">
                            Mulai Brief
                        </a>
                    </div>

                    <div class="flex shrink-0 items-center gap-2 md:hidden">
                        <button type="button" data-theme-toggle class="theme-toggle inline-flex items-center justify-center transition hover:opacity-80">
                            <span class="theme-toggle-icons" aria-hidden="true">
                                <span class="theme-toggle-chip theme-toggle-chip--light" data-theme-chip="light">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                                <span class="theme-toggle-chip theme-toggle-chip--dark" data-theme-chip="dark">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                            </span>
                            <span data-theme-current class="sr-only">Mode gelap aktif</span>
                            <span data-theme-next class="sr-only">Aktifkan mode terang</span>
                        </button>
                        <button type="button" class="inline-flex h-[40px] shrink-0 items-center justify-center rounded-full border border-white/10 bg-white/5 px-4 text-xs font-medium text-white transition hover:bg-white/10" @click="open = !open" aria-label="Buka menu">
                            <span x-show="!open">Menu</span>
                            <span x-show="open" x-cloak>Tutup</span>
                        </button>
                    </div>
                </div>

                <div x-show="open" x-transition class="border-t border-white/10 px-4 py-5 sm:px-6 md:hidden">
                    <div class="flex flex-col gap-4 text-sm text-white/75">
                        <a href="{{ $servicesLink }}" class="theme-nav-link" @click="open = false">Layanan</a>
                        <a href="{{ route('portfolios.index') }}" class="theme-nav-link" @click="open = false">Portfolio</a>
                        <a href="{{ route('blog.index') }}" class="theme-nav-link" @click="open = false">Blog</a>
                        <a href="{{ $pricingLink }}" class="theme-nav-link" @click="open = false">Harga</a>
                        <a href="{{ $contactLink }}" class="theme-nav-link" @click="open = false">Kontak</a>
                        <button type="button" data-theme-toggle class="theme-toggle inline-flex w-fit items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-2.5 text-white">
                            <span class="text-white/45">Tema</span>
                            <span class="theme-toggle-icons" aria-hidden="true">
                                <span class="theme-toggle-chip theme-toggle-chip--light" data-theme-chip="light">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                                <span class="theme-toggle-chip theme-toggle-chip--dark" data-theme-chip="dark">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546"></path>
                                        <path d="M2 16h5l-4 4"></path>
                                        <path d="M22 16h-5l4 4"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M9 11v.01"></path>
                                        <path d="M15 11v.01"></path>
                                    </svg>
                                </span>
                            </span>
                            <span data-theme-current class="sr-only">Mode gelap aktif dengan ikon kucing hitam</span>
                            <span data-theme-next class="sr-only">Aktifkan mode terang dengan ikon kucing putih</span>
                        </button>
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noreferrer" class="inline-flex w-fit rounded-full bg-orange-500 px-5 py-3 font-semibold text-white">
                            Mulai Brief
                        </a>
                    </div>
                </div>
            </header>

            @if (session('success'))
                <div class="mx-auto max-w-7xl px-6 pt-6 lg:px-8">
                    <div class="rounded-3xl border border-emerald-400/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-200">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <main>
                @yield('content')
            </main>

            <footer id="contact" class="border-t border-white/10 bg-black/40">
                <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-[1.05fr_0.95fr] lg:grid-cols-[1.4fr_1fr] lg:px-8">
                    <div class="space-y-5">
                        <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.3em] text-orange-300">{{ strtoupper($siteSettings['site_name'] ?? 'TINYCATSTUDIO') }}</span>
                        <h2 class="max-w-2xl text-2xl font-semibold text-white sm:text-3xl md:text-4xl">Bangun website, aplikasi, dan brand assets yang terlihat mahal, bergerak rapi, dan siap mengejar growth.</h2>
                        <p class="max-w-2xl text-sm leading-7 text-white/65 sm:text-base">{{ $siteSettings['site_tagline'] ?? 'TinyCatStudio membantu bisnis, startup, dan personal brand menghadirkan software, visual, dan campaign yang terasa premium—manis di first impression, tajam di hasil.' }}</p>
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-wrap gap-3 text-xs text-white/65 sm:text-sm">
                                <span class="break-all rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['email'] ?? 'hello@tinycatstudio.tech' }}</span>
                                <span class="break-all rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['whatsapp_number'] ?? '+62 812-3456-7890' }}</span>
                                @if(str_starts_with($siteSettings['address'] ?? 'Indonesia', 'http'))
                                    <a href="{{ $siteSettings['address'] }}" target="_blank" class="break-words rounded-full border border-white/10 px-4 py-2 hover:border-orange-400 hover:text-orange-300 transition">Buka Google Maps</a>
                                @elseif(!str_contains($siteSettings['address'] ?? '', '<iframe'))
                                    <span class="break-words rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['address'] ?? 'Indonesia' }}</span>
                                @endif
                            </div>

                            @if(str_contains($siteSettings['address'] ?? '', '<iframe'))
                                <div class="mt-4 overflow-hidden rounded-2xl border border-white/10 [&>iframe]:h-56 [&>iframe]:w-full">
                                    {!! $siteSettings['address'] !!}
                                </div>
                            @endif

                            @if(!empty($siteSettings['facebook']) || !empty($siteSettings['instagram']) || !empty($siteSettings['tiktok']))
                                <div class="mt-2 flex items-center gap-5">
                                    @if(!empty($siteSettings['facebook']))
                                        <a href="{{ $siteSettings['facebook'] }}" target="_blank" rel="noreferrer" class="text-white/40 hover:text-orange-400 transition" aria-label="Facebook">
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                        </a>
                                    @endif
                                    @if(!empty($siteSettings['instagram']))
                                        <a href="{{ $siteSettings['instagram'] }}" target="_blank" rel="noreferrer" class="text-white/40 hover:text-orange-400 transition" aria-label="Instagram">
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                                        </a>
                                    @endif
                                    @if(!empty($siteSettings['tiktok']))
                                        <a href="{{ $siteSettings['tiktok'] }}" target="_blank" rel="noreferrer" class="text-white/40 hover:text-orange-400 transition" aria-label="TikTok">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('contacts.store') }}" method="POST" class="space-y-4 rounded-[2rem] border border-white/10 bg-white/5 p-5 sm:p-6">
                        @csrf
                        <div>
                            <label for="footer_name" class="mb-2 block text-sm text-white/70">Nama</label>
                            <input id="footer_name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Nama Anda / brand">
                            @error('name', 'contact')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="footer_email" class="mb-2 block text-sm text-white/70">Email</label>
                            <input id="footer_email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="email@brandanda.com">
                            @error('email', 'contact')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="footer_message" class="mb-2 block text-sm text-white/70">Pesan</label>
                            <textarea id="footer_message" name="message" rows="4" class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition focus:border-orange-400" placeholder="Ceritakan kebutuhan project Anda. Tenang, kami hanya menggigit bug, bukan klien.">{{ old('message') }}</textarea>
                            @error('message', 'contact')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-white px-5 py-3 font-semibold text-neutral-950 transition hover:bg-orange-500 hover:text-white">Kirim ke TinyCatStudio</button>
                    </form>
                </div>
            </footer>
        </div>
    </body>
</html>
