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

        <div class="relative isolate">
            <div class="site-background"></div>
            <div class="absolute inset-x-0 top-0 -z-10 h-[420px] bg-[radial-gradient(circle_at_top,_rgba(255,122,0,0.22),_transparent_46%)]"></div>

            <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-orange-400/10 bg-neutral-950/80 shadow-[0_12px_40px_rgba(0,0,0,0.28)] backdrop-blur-xl">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-orange-400/40 bg-orange-500/15 text-xs font-semibold tracking-[0.26em] text-orange-300 sm:h-11 sm:w-11 sm:text-sm sm:tracking-[0.3em]">TCS</span>
                        <div class="min-w-0">
                            <p class="truncate text-xs font-semibold tracking-[0.22em] text-white sm:text-sm sm:tracking-[0.25em]">{{ strtoupper($siteSettings['site_name'] ?? 'TinyCatStudio') }}</p>
                            <p class="hidden text-xs text-white/55 sm:block">Software House • Mobile • Design • Ads</p>
                        </div>
                    </a>

                    <nav class="hidden items-center text-white/75 md:flex md:gap-5 md:text-xs lg:gap-8 lg:text-sm">
                        <a href="{{ $servicesLink }}" class="transition hover:text-white">Layanan</a>
                        <a href="{{ route('portfolios.index') }}" class="transition hover:text-white">Portfolio</a>
                        <a href="{{ route('blog.index') }}" class="transition hover:text-white">Blog</a>
                        <a href="{{ $pricingLink }}" class="transition hover:text-white">Harga</a>
                        <a href="{{ $contactLink }}" class="transition hover:text-white">Kontak</a>
                    </nav>

                    <div class="hidden lg:block">
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noreferrer" class="inline-flex items-center rounded-full border border-orange-400/40 bg-orange-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">
                            Mulai Brief
                        </a>
                    </div>

                    <button type="button" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-white/10 text-sm text-white md:hidden" @click="open = !open" aria-label="Buka menu">
                        <span x-show="!open">Menu</span>
                        <span x-show="open" x-cloak>Tutup</span>
                    </button>
                </div>

                <div x-show="open" x-transition class="border-t border-white/10 px-4 py-5 sm:px-6 md:hidden">
                    <div class="flex flex-col gap-4 text-sm text-white/75">
                        <a href="{{ $servicesLink }}" @click="open = false">Layanan</a>
                        <a href="{{ route('portfolios.index') }}" @click="open = false">Portfolio</a>
                        <a href="{{ route('blog.index') }}" @click="open = false">Blog</a>
                        <a href="{{ $pricingLink }}" @click="open = false">Harga</a>
                        <a href="{{ $contactLink }}" @click="open = false">Kontak</a>
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
                        <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-xs font-semibold tracking-[0.3em] text-orange-300">TINYCATSTUDIO</span>
                        <h2 class="max-w-2xl text-2xl font-semibold text-white sm:text-3xl md:text-4xl">Bangun website, aplikasi, dan brand assets yang terlihat mahal, bergerak rapi, dan siap mengejar growth.</h2>
                        <p class="max-w-2xl text-sm leading-7 text-white/65 sm:text-base">TinyCatStudio membantu bisnis, startup, dan personal brand menghadirkan software, visual, dan campaign yang terasa premium—manis di first impression, tajam di hasil.</p>
                        <div class="flex flex-wrap gap-3 text-xs text-white/65 sm:text-sm">
                            <span class="break-all rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['email'] ?? 'hello@tinycatstudio.tech' }}</span>
                            <span class="break-all rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['whatsapp_number'] ?? '+62 812-3456-7890' }}</span>
                            <span class="break-words rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['address'] ?? 'Indonesia' }}</span>
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
