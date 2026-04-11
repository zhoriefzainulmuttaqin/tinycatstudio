<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: {{ $invoice->client->theme_color ?? '#333' }};
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 2px solid {{ $invoice->client->theme_color ?? '#333' }};
            color: {{ $invoice->client->theme_color ?? '#333' }};
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid {{ $invoice->client->theme_color ?? '#eee' }};
            font-weight: bold;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .logo {
            max-width: 200px;
            max-height: 100px;
        }
        .invoice-header {
            font-size: 32px;
            font-weight: bold;
            color: {{ $invoice->client->theme_color ?? '#000' }};
        }
        .signature-box {
            margin-top: 50px;
            width: 250px;
            text-align: center;
            float: right;
        }
        .signature-img {
            max-width: 200px;
            max-height: 100px;
            margin-bottom: 10px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="invoice-box clearfix">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                @if($invoice->client->logo_url)
                                    <?php
                                        $path = storage_path('app/public/' . $invoice->client->logo_url);
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        if (file_exists($path)) {
                                            $data = file_get_contents($path);
                                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        } else {
                                            $base64 = url('storage/' . $invoice->client->logo_url);
                                        }
                                    ?>
                                    <img src="{{ $base64 }}" class="logo" alt="Logo Perusahaan">
                                @else
                                    <h2 style="margin:0;">{{ $invoice->client->company_name ?? $invoice->client->name }}</h2>
                                @endif
                            </td>
                            <td>
                                <span class="invoice-header">TAGIHAN</span><br>
                                No. Tagihan: {{ $invoice->invoice_number }}<br>
                                Tanggal Terbit: {{ $invoice->issue_date->format('d M Y') }}<br>
                                Jatuh Tempo: {{ $invoice->due_date->format('d M Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong>Dari:</strong><br>
                                {{ $invoice->client->company_name ?? $invoice->client->name }}<br>
                                {{ $invoice->client->email }}<br>
                                {{ $invoice->client->phone }}<br>
                                {!! nl2br(e($invoice->client->address)) !!}
                            </td>
                            <td>
                                <strong>Ditagihkan Kepada:</strong><br>
                                {{ $invoice->customer_name }}<br>
                                {{ $invoice->customer_email }}<br>
                                {!! nl2br(e($invoice->customer_address)) !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Deskripsi Item</td>
                <td class="text-center">Harga</td>
                <td class="text-center">Jumlah</td>
                <td class="text-right">Total</td>
            </tr>

            @foreach($invoice->items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $item->description }}</td>
                <td class="text-center">{{ \App\Models\ClientInvoice::formatRupiah($item->unit_price) }}</td>
                <td class="text-center">{{ \App\Models\ClientInvoice::formatNumber($item->quantity) }}</td>
                <td class="text-right">{{ \App\Models\ClientInvoice::formatRupiah($item->quantity * $item->unit_price) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Subtotal:</strong></td>
                <td class="text-right">{{ \App\Models\ClientInvoice::formatRupiah($invoice->subtotal) }}</td>
            </tr>

            @if(isset($invoice->discount_amount) && $invoice->discount_amount > 0)
            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right" style="color: red;"><strong>Diskon:</strong></td>
                <td class="text-right" style="color: red;">-{{ \App\Models\ClientInvoice::formatRupiah($invoice->discount_amount) }}</td>
            </tr>
            @endif

            @if($invoice->tax_amount > 0)
            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Pajak ({{ \App\Models\ClientInvoice::formatNumber($invoice->tax_rate) }}%):</strong></td>
                <td class="text-right">{{ \App\Models\ClientInvoice::formatRupiah($invoice->tax_amount) }}</td>
            </tr>
            @endif

            @if(isset($invoice->additional_fee) && $invoice->additional_fee > 0)
            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Biaya Tambahan:</strong></td>
                <td class="text-right">{{ \App\Models\ClientInvoice::formatRupiah($invoice->additional_fee) }}</td>
            </tr>
            @endif

            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Total Tagihan:</strong></td>
                <td class="text-right"><strong>{{ \App\Models\ClientInvoice::formatRupiah($invoice->total_amount) }}</strong></td>
            </tr>
        </table>

        @if($invoice->notes)
        <div style="margin-top: 50px;">
            <strong>Catatan:</strong>
            <p>{!! nl2br(e($invoice->notes)) !!}</p>
        </div>
        @endif

        @if($invoice->client->signature_url)
        <div class="signature-box">
            <?php
                $sigPath = storage_path('app/public/' . $invoice->client->signature_url);
                $sigType = pathinfo($sigPath, PATHINFO_EXTENSION);
                if (file_exists($sigPath)) {
                    $sigData = file_get_contents($sigPath);
                    $sigBase64 = 'data:image/' . $sigType . ';base64,' . base64_encode($sigData);
                } else {
                    $sigBase64 = url('storage/' . $invoice->client->signature_url);
                }
            ?>
            <img src="{{ $sigBase64 }}" class="signature-img" alt="Tanda Tangan"><br>
            <strong style="border-top: 1px solid #333; padding-top: 5px; display: inline-block; width: 100%;">
                {{ $invoice->client->name }}
            </strong>
        </div>
        @endif
    </div>
</body>
</html>
