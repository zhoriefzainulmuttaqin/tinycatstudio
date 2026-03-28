<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ ($siteSettings['site_name'] ?? 'TinyCatStudio') . ' | Masuk Admin' }}</title>
        <meta name="description" content="Halaman login admin {{ $siteSettings['site_name'] ?? 'TinyCatStudio' }}.">
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
        <div class="relative isolate min-h-screen overflow-hidden">
            <div class="site-background"></div>
            <div class="absolute inset-x-0 top-0 -z-10 h-[420px] bg-[radial-gradient(circle_at_top,_rgba(255,122,0,0.24),_transparent_50%)]"></div>
            <div class="ambient-orb ambient-orb--orange left-[-120px] top-20 hidden h-64 w-64 lg:block"></div>
            <div class="ambient-orb ambient-orb--white bottom-16 right-[-80px] hidden h-56 w-56 lg:block"></div>

            <main class="mx-auto flex min-h-screen w-full max-w-7xl items-center px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid w-full gap-6 lg:grid-cols-[1.08fr_0.92fr] lg:gap-10">
                    <section class="luxury-panel section-noise rounded-[2rem] border border-orange-400/15 bg-white/6 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] sm:p-8 lg:p-10">
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-3 py-2 text-sm text-white/70 transition hover:border-orange-400/30 hover:text-white">
                                <span class="flex h-9 w-9 items-center justify-center rounded-2xl border border-orange-400/35 bg-orange-500/15 text-[11px] font-semibold tracking-[0.28em] text-orange-300">TCS</span>
                                <span>{{ strtoupper($siteSettings['site_name'] ?? 'TinyCatStudio') }}</span>
                            </a>
                            <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.32em] text-orange-300">ADMIN ACCESS</span>
                        </div>

                        <div class="mt-8 max-w-2xl space-y-5">
                            <div class="space-y-3">
                                <p class="text-sm font-medium text-orange-300/90">Portal internal yang lebih rapi dan fokus.</p>
                                <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl lg:text-[2.75rem] lg:leading-[1.08]">Masuk ke ruang admin yang terasa premium, tenang, dan siap kerja.</h1>
                                <p class="text-sm leading-7 text-white/65 sm:text-base">Login ini hanya untuk admin TinyCatStudio. Sistem memverifikasi email, password, dan role admin sebelum mengizinkan akses ke dashboard internal melalui jalur tersembunyi <span class="font-semibold text-orange-300">/masuk-kucing</span>.</p>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl border border-white/10 bg-black/25 p-5">
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Keamanan</p>
                                    <p class="mt-3 text-lg font-semibold text-white">Session-based login</p>
                                    <p class="mt-2 text-sm leading-6 text-white/60">Sesi diregenerasi setelah login agar akses admin tetap aman dan lebih rapi dikelola.</p>
                                </div>
                                <div class="rounded-3xl border border-white/10 bg-black/25 p-5">
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Arah akses</p>
                                    <p class="mt-3 text-lg font-semibold text-white">Dashboard internal</p>
                                    <p class="mt-2 text-sm leading-6 text-white/60">Setelah berhasil login, admin langsung masuk ke workspace untuk memantau operasional website.</p>
                                </div>
                            </div>

                            <div class="rounded-[1.75rem] border border-white/10 bg-black/25 p-5 sm:p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Yang akan Anda akses</p>
                                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-sm font-semibold text-white">Ringkasan lead</p>
                                        <p class="mt-1 text-xs leading-5 text-white/55">Pantau prospek baru dan kebutuhan follow-up.</p>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-sm font-semibold text-white">Inbox kontak</p>
                                        <p class="mt-1 text-xs leading-5 text-white/55">Lihat pesan masuk dari pengunjung website.</p>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-sm font-semibold text-white">Status operasional</p>
                                        <p class="mt-1 text-xs leading-5 text-white/55">Cek layanan, konten, project, dan invoice aktif.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[2rem] border border-white/10 bg-black/45 p-5 shadow-[0_24px_80px_rgba(0,0,0,0.3)] backdrop-blur sm:p-6 lg:p-8">
                        <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-5 sm:p-6">
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-orange-300">Masuk Admin</p>
                                    <h2 class="mt-2 text-2xl font-semibold text-white sm:text-3xl">Autentikasi akun admin</h2>
                                    <p class="mt-2 max-w-md text-sm leading-6 text-white/60">Masukkan kredensial admin untuk membuka area internal TinyCatStudio.</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex rounded-full border border-white/10 bg-black/25 px-3 py-1.5 text-xs font-medium text-white/55">Hanya admin</span>
                                    <button type="button" data-theme-toggle class="theme-toggle inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-3.5 py-2 text-white">
                                        <span class="text-[11px] uppercase tracking-[0.18em] text-white/45">Tema</span>
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
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="mt-6 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mt-6 rounded-2xl border border-rose-400/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                                    Login belum berhasil. Pastikan email dan password admin sudah benar.
                                </div>
                            @endif

                            <form action="{{ route('login.store') }}" method="POST" class="mt-6 space-y-5">
                                @csrf
                                <div>
                                    <label for="email" class="mb-2 block text-sm text-white/70">Email admin</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition placeholder:text-white/30 focus:border-orange-400" placeholder="admin@tinycatstudio.tech">
                                    @error('email')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <div class="mb-2 flex items-center justify-between gap-3">
                                        <label for="password" class="block text-sm text-white/70">Password</label>
                                        <span class="text-xs text-white/40">Case sensitive</span>
                                    </div>
                                    <input id="password" name="password" type="password" autocomplete="current-password" required class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition placeholder:text-white/30 focus:border-orange-400" placeholder="Masukkan password admin">
                                    @error('password')<p class="mt-2 text-sm text-rose-300">{{ $message }}</p>@enderror
                                </div>

                                <div class="flex flex-col gap-3 rounded-[1.5rem] border border-white/10 bg-black/25 p-4 sm:flex-row sm:items-center sm:justify-between">
                                    <label class="flex items-center gap-3 text-sm text-white/70">
                                        <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-white/20 bg-transparent text-orange-500 focus:ring-orange-400">
                                        Ingat sesi admin di perangkat ini
                                    </label>
                                    <span class="text-xs text-white/45">URL login: /masuk-kucing</span>
                                </div>

                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-orange-500 px-5 py-3.5 font-semibold text-white transition hover:bg-orange-400">
                                    Masuk ke dashboard
                                </button>
                            </form>

                            <div class="mt-6 flex flex-wrap gap-3 text-xs text-white/55 sm:text-sm">
                                <a href="{{ route('home') }}" class="inline-flex items-center rounded-full border border-white/10 px-4 py-2 transition hover:border-orange-400/30 hover:text-white">Kembali ke website</a>
                                <span class="inline-flex items-center rounded-full border border-white/10 px-4 py-2">{{ $siteSettings['site_tagline'] ?? 'Software house premium untuk website, aplikasi mobile, branding, desain visual, dan digital ads.' }}</span>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
