<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun Client</title>
</head>
<body style="margin: 0; padding: 24px; background-color: #f1f5f9; font-family: Arial, sans-serif; color: #0f172a;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
        <div style="padding: 32px; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #ffffff;">
            <p style="margin: 0 0 8px; font-size: 14px; letter-spacing: 0.08em; text-transform: uppercase; opacity: 0.8;">TinyCat Invoicing</p>
            <h1 style="margin: 0; font-size: 28px; line-height: 1.2;">Akun client Anda siap digunakan</h1>
        </div>

        <div style="padding: 32px;">
            <p style="margin-top: 0; font-size: 16px; line-height: 1.7;">Halo <strong>{{ $client->name }}</strong>,</p>
            <p style="font-size: 16px; line-height: 1.7; margin-bottom: 24px;">
                Kami sudah membuat akun client Anda di TinyCat Invoicing. Silakan login menggunakan akses di bawah ini, lalu masukkan kode OTP untuk mengaktifkan akun.
            </p>

            <div style="margin-bottom: 24px; padding: 20px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <p style="margin: 0 0 12px; font-size: 14px; color: #475569;">Akses login</p>
                <p style="margin: 0 0 8px; font-size: 15px;"><strong>Email:</strong> {{ $client->email }}</p>
                @if ($password)
                    <p style="margin: 0 0 8px; font-size: 15px;"><strong>Password:</strong> {{ $password }}</p>
                @endif
                <p style="margin: 0; font-size: 15px;">
                    <strong>Link login:</strong>
                    <a href="{{ $loginUrl }}" style="color: #4f46e5; text-decoration: none;">{{ $loginUrl }}</a>
                </p>
            </div>

            <div style="margin-bottom: 24px; padding: 24px; background-color: #eef2ff; border: 1px solid #c7d2fe; border-radius: 12px; text-align: center;">
                <p style="margin: 0 0 12px; font-size: 14px; color: #4338ca;">Kode OTP aktivasi</p>
                <p style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: 0.35em; color: #312e81;">{{ $otp }}</p>
                <p style="margin: 16px 0 0; font-size: 14px; color: #4338ca;">OTP berlaku selama {{ $otpExpiresInMinutes }} menit.</p>
            </div>

            <div style="margin-bottom: 24px; padding-left: 20px; border-left: 3px solid #4f46e5;">
                <p style="margin: 0 0 8px; font-size: 15px;"><strong>Cara aktivasi:</strong></p>
                <ol style="margin: 0; padding-left: 18px; font-size: 15px; line-height: 1.8; color: #334155;">
                    <li>Buka link login di atas.</li>
                    <li>Masuk menggunakan email dan password Anda.</li>
                    <li>Masukkan kode OTP untuk menyelesaikan aktivasi akun.</li>
                </ol>
            </div>

            <p style="margin: 0; font-size: 14px; line-height: 1.7; color: #64748b;">
                Jika Anda tidak merasa meminta akses ini, abaikan email ini atau hubungi tim kami.
            </p>
        </div>
    </div>
</body>
</html>
