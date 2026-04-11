<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ ($siteSettings['site_name'] ?? 'TinyCatStudio') . ' | Dashboard Admin' }}</title>
        <meta name="description" content="Dashboard admin {{ $siteSettings['site_name'] ?? 'TinyCatStudio' }}.">
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
            <div class="absolute inset-x-0 top-0 -z-10 h-[360px] bg-[radial-gradient(circle_at_top,_rgba(255,122,0,0.22),_transparent_46%)]"></div>

            <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
                <section class="luxury-panel section-noise overflow-hidden rounded-[2rem] border border-white/10 bg-black/40 p-5 shadow-[0_24px_80px_rgba(0,0,0,0.28)] backdrop-blur sm:p-6 lg:p-8">
                    <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                        <div class="max-w-3xl space-y-4">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-4 py-2 text-[11px] font-semibold tracking-[0.32em] text-orange-300">ADMIN DASHBOARD</span>
                                <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs text-white/55">Masuk via /masuk-kucing</span>
                            </div>
                            <div>
                                <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl lg:text-[2.7rem] lg:leading-[1.08]">Selamat datang, {{ $user->name }}.</h1>
                                <p class="mt-3 max-w-2xl text-sm leading-7 text-white/65 sm:text-base">Dashboard ini sekarang dirapikan agar lebih nyaman dipakai untuk memantau lead, pesan masuk, status project, konten website, dan kondisi invoice dalam satu tempat.</p>
                            </div>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-3 xl:min-w-[320px] xl:grid-cols-1">
                            <a href="/admin-panel" class="inline-flex items-center justify-center rounded-full border border-orange-400/30 bg-orange-500/10 px-5 py-3 text-sm font-semibold text-orange-200 transition hover:border-orange-400/50 hover:bg-orange-500/20">Akses Editor Konten (CRUD)</a>
                            <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-full border border-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">Lihat website publik</a>
                            <button type="button" data-theme-toggle class="theme-toggle inline-flex items-center justify-center gap-3 rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:border-orange-400/30 hover:bg-orange-500/10">
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
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-neutral-950 transition hover:bg-orange-500 hover:text-white">
                                    Keluar dari admin
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mt-6 rounded-2xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach ($overviewStats as $stat)
                            <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-5 transition hover:border-orange-400/30 hover:bg-orange-500/10">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-500/20 text-orange-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            {!! $stat['icon'] !!}
                                        </svg>
                                    </span>
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">{{ $stat['label'] }}</p>
                                </div>
                                <p class="mt-5 text-3xl font-semibold text-white">{{ $stat['value'] }}</p>
                                <p class="mt-2 text-sm leading-6 text-white/60">{{ $stat['caption'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="mt-6 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
                    <div class="space-y-6">
                        <div class="grid gap-6 lg:grid-cols-2">
                            <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Akun aktif</p>
                                        <h2 class="mt-2 text-xl font-semibold text-white">Profil admin</h2>
                                    </div>
                                    <span class="inline-flex rounded-full border border-orange-400/30 bg-orange-500/10 px-3 py-1.5 text-xs font-medium text-orange-200">{{ strtoupper($user->role) }}</span>
                                </div>

                                <div class="mt-5 space-y-4">
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-xs uppercase tracking-[0.2em] text-white/40">Nama</p>
                                        <p class="mt-2 text-sm font-medium text-white">{{ $user->name }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-xs uppercase tracking-[0.2em] text-white/40">Email</p>
                                        <p class="mt-2 break-all text-sm font-medium text-white">{{ $user->email }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                        <p class="text-xs uppercase tracking-[0.2em] text-white/40">Status akses</p>
                                        <p class="mt-2 text-sm text-white/70">Menggunakan guard web Laravel dengan verifikasi role admin pada endpoint login kustom.</p>
                                    </div>
                                </div>
                            </section>

                            <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Status proyek</p>
                                <h2 class="mt-2 text-xl font-semibold text-white">Pipeline pengerjaan</h2>

                                <div class="mt-5 space-y-4">
                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                        <div class="flex items-center justify-between gap-3 text-sm">
                                            <span class="text-white/65">Pending</span>
                                            <span class="font-semibold text-white">{{ $projectSummary['pending'] }}</span>
                                        </div>
                                        <div class="mt-3 h-2 rounded-full bg-white/5">
                                            <div class="h-2 rounded-full bg-white/35" style="width: {{ max(8, min(100, $projectSummary['pending'] * 20)) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rounded-2xl border border-orange-400/20 bg-orange-500/10 p-4">
                                        <div class="flex items-center justify-between gap-3 text-sm">
                                            <span class="text-orange-100/80">In progress</span>
                                            <span class="font-semibold text-white">{{ $projectSummary['progress'] }}</span>
                                        </div>
                                        <div class="mt-3 h-2 rounded-full bg-black/20">
                                            <div class="h-2 rounded-full bg-orange-400" style="width: {{ max(8, min(100, $projectSummary['progress'] * 20)) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 p-4">
                                        <div class="flex items-center justify-between gap-3 text-sm">
                                            <span class="text-emerald-100/80">Completed</span>
                                            <span class="font-semibold text-white">{{ $projectSummary['completed'] }}</span>
                                        </div>
                                        <div class="mt-3 h-2 rounded-full bg-black/20">
                                            <div class="h-2 rounded-full bg-emerald-400" style="width: {{ max(8, min(100, $projectSummary['completed'] * 20)) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Leads terbaru</p>
                                    <h2 class="mt-2 text-xl font-semibold text-white">Prospek yang masuk dari website</h2>
                                </div>
                                <span class="text-sm text-white/45">{{ $recentLeads->count() }} data terbaru</span>
                            </div>

                            <div class="mt-5 space-y-3">
                                @forelse ($recentLeads as $lead)
                                    <article class="rounded-[1.5rem] border border-white/10 bg-white/5 p-4">
                                        <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                            <div class="min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <p class="text-sm font-semibold text-white">{{ $lead->name }}</p>
                                                    <span class="inline-flex rounded-full border border-white/10 px-2.5 py-1 text-[11px] uppercase tracking-[0.18em] text-white/45">{{ $lead->status }}</span>
                                                </div>
                                                <p class="mt-1 break-all text-sm text-white/60">{{ $lead->email }} · {{ $lead->phone }}</p>
                                                <p class="mt-2 text-sm text-white/75">{{ $lead->service?->name ?? 'Tanpa layanan' }}</p>
                                            </div>
                                            <p class="text-xs text-white/40">{{ $lead->created_at?->diffForHumans() }}</p>
                                        </div>
                                    </article>
                                @empty
                                    <div class="rounded-[1.5rem] border border-dashed border-white/10 bg-white/5 px-4 py-8 text-center text-sm text-white/50">
                                        Belum ada lead yang masuk.
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>

                    <div class="space-y-6">
                        <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Ringkasan konten</p>
                            <h2 class="mt-2 text-xl font-semibold text-white">Kondisi website</h2>

                            <div class="mt-5 space-y-3">
                                @foreach ($contentStats as $stat)
                                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-4 transition hover:border-orange-400/30 hover:bg-orange-500/10">
                                        <div class="flex items-center gap-4">
                                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/10 text-white/70">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    {!! $stat['icon'] !!}
                                                </svg>
                                            </span>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-white">{{ $stat['label'] }}</p>
                                                <p class="mt-1 text-xs leading-5 text-white/50">{{ $stat['description'] }}</p>
                                            </div>
                                            <span class="text-2xl font-semibold text-white">{{ $stat['value'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Keuangan</p>
                            <h2 class="mt-2 text-xl font-semibold text-white">Tagihan perlu perhatian</h2>

                            <div class="mt-5 rounded-[1.5rem] border border-orange-400/20 bg-orange-500/10 p-5">
                                <p class="text-sm text-orange-100/75">Total tagihan belum dibayar</p>
                                <p class="mt-2 text-3xl font-semibold text-white">Rp {{ number_format($financialSummary['unpaidTotal'], 0, ',', '.') }}</p>
                                <p class="mt-2 text-sm text-white/65">{{ $financialSummary['unpaidCount'] }} tagihan masih menunggu pembayaran.</p>
                            </div>
                        </section>

                        <section class="rounded-[2rem] border border-white/10 bg-black/35 p-5 shadow-[0_18px_60px_rgba(0,0,0,0.2)] backdrop-blur sm:p-6">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/45">Pesan terbaru</p>
                                    <h2 class="mt-2 text-xl font-semibold text-white">Inbox kontak</h2>
                                </div>
                                <span class="text-sm text-white/45">{{ $recentContacts->count() }} pesan</span>
                            </div>

                            <div class="mt-5 space-y-3">
                                @forelse ($recentContacts as $contact)
                                    <article class="rounded-[1.5rem] border border-white/10 bg-white/5 p-4">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-white">{{ $contact->name }}</p>
                                                <p class="mt-1 break-all text-xs text-white/45">{{ $contact->email }}</p>
                                            </div>
                                            <p class="shrink-0 text-xs text-white/40">{{ $contact->created_at?->diffForHumans() }}</p>
                                        </div>
                                        <p class="mt-3 text-sm leading-6 text-white/65">{{ \Illuminate\Support\Str::limit($contact->message, 120) }}</p>
                                    </article>
                                @empty
                                    <div class="rounded-[1.5rem] border border-dashed border-white/10 bg-white/5 px-4 py-8 text-center text-sm text-white/50">
                                        Belum ada pesan kontak masuk.
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
