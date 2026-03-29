<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - TinyCat Invoicing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 p-4 text-slate-900 sm:p-6">
    <div class="mx-auto flex min-h-[calc(100vh-2rem)] max-w-5xl items-center justify-center">
        <div class="grid w-full overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl lg:grid-cols-[1.05fr_0.95fr]">
            <div class="hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-slate-900 p-10 text-white lg:block">
                <p class="text-sm uppercase tracking-[0.3em] text-indigo-100">TinyCat Invoicing</p>
                <h1 class="mt-6 text-4xl font-semibold leading-tight">Aktifkan akun client Anda dengan kode OTP.</h1>
                <p class="mt-4 max-w-md text-sm leading-7 text-indigo-100/90">
                    Setelah login, masukkan kode OTP yang kami kirim ke email Anda untuk menyelesaikan aktivasi akun.
                </p>
                <div class="mt-10 rounded-2xl border border-white/15 bg-white/10 p-6 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.25em] text-indigo-100">Email tujuan</p>
                    <p class="mt-2 text-xl font-medium break-all">{{ $client->email }}</p>
                    <p class="mt-4 text-sm leading-7 text-indigo-100/90">
                        Jika email belum masuk, cek folder spam atau gunakan tombol kirim ulang OTP.
                    </p>
                </div>
            </div>

            <div class="p-6 sm:p-10">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-8">
                        <p class="text-sm font-medium text-indigo-600">Verifikasi akun</p>
                        <h2 class="mt-2 text-3xl font-semibold text-slate-900">Masukkan kode OTP</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Kami telah mengirim 6 digit kode aktivasi ke <span class="font-medium text-slate-700">{{ $client->email }}</span>.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('client.verify-otp.verify') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="otp" class="block text-sm font-medium text-slate-700">Kode OTP</label>
                            <input
                                type="text"
                                name="otp"
                                id="otp"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                value="{{ old('otp') }}"
                                required
                                maxlength="6"
                                class="mt-2 block w-full rounded-2xl border border-slate-300 px-4 py-3 font-mono text-lg tracking-[0.45em] shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 sm:text-center sm:text-2xl"
                                placeholder="000000"
                                autofocus
                            >
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
                        >
                            Verifikasi & aktifkan akun
                        </button>
                    </form>

                    <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-600">
                        <div class="flex flex-wrap items-center gap-1">
                            <span>Belum menerima OTP?</span>
                            <form action="{{ route('client.verify-otp.resend') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">
                                    Kirim ulang OTP
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-6 text-center text-sm text-slate-500">
                        <form action="{{ route('filament.client.auth.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="font-medium text-slate-500 transition hover:text-slate-700">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
