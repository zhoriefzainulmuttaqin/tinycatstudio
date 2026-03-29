<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
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
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
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
            border-top: 2px solid #eee;
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
            color: #000;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
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
                                    <img src="{{ $base64 }}" class="logo" alt="Company Logo">
                                @else
                                    <h2 style="margin:0;">{{ $invoice->client->company_name ?? $invoice->client->name }}</h2>
                                @endif
                            </td>
                            <td>
                                <span class="invoice-header">INVOICE</span><br>
                                Invoice #: {{ $invoice->invoice_number }}<br>
                                Issued: {{ $invoice->issue_date->format('d M Y') }}<br>
                                Due: {{ $invoice->due_date->format('d M Y') }}
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
                                <strong>From:</strong><br>
                                {{ $invoice->client->company_name ?? $invoice->client->name }}<br>
                                {{ $invoice->client->email }}<br>
                                {{ $invoice->client->phone }}<br>
                                {!! nl2br(e($invoice->client->address)) !!}
                            </td>
                            <td>
                                <strong>Bill To:</strong><br>
                                {{ $invoice->customer_name }}<br>
                                {{ $invoice->customer_email }}<br>
                                {!! nl2br(e($invoice->customer_address)) !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item Description</td>
                <td class="text-center">Price</td>
                <td class="text-center">Qty</td>
                <td class="text-right">Total</td>
            </tr>

            @foreach($invoice->items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $item->description }}</td>
                <td class="text-center">Rp {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                <td class="text-center">{{ number_format($item->quantity, 2, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->quantity * $item->unit_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Subtotal:</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->subtotal, 2, ',', '.') }}</td>
            </tr>

            @if($invoice->tax_amount > 0)
            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Tax ({{ number_format($invoice->tax_rate, 2, ',', '.') }}%):</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->tax_amount, 2, ',', '.') }}</td>
            </tr>
            @endif

            <tr class="total">
                <td colspan="2"></td>
                <td class="text-right"><strong>Total Amount:</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($invoice->total_amount, 2, ',', '.') }}</strong></td>
            </tr>
        </table>
        
        @if($invoice->notes)
        <div style="margin-top: 50px;">
            <strong>Notes:</strong>
            <p>{!! nl2br(e($invoice->notes)) !!}</p>
        </div>
        @endif
    </div>
</body>
</html>