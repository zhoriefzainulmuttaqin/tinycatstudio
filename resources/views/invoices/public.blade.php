<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        iframe { border: none; width: 100%; height: 100vh; }
        body { margin: 0; padding: 0; background-color: #f9fafb; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh;}
        .top-bar { width: 100%; max-width: 900px; display: flex; align-items: center; justify-content: space-between; background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.5rem; margin-top: 2rem; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);}
        .iframe-container { width: 100%; max-width: 900px; height: 800px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .footer-banner { width: 100%; text-align: center; padding: 1rem; color: #6b7280; font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="top-bar">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Invoice {{ $invoice->invoice_number }}</h1>
            <p class="text-sm text-gray-500">From: {{ $invoice->client->company_name ?? $invoice->client->name }}</p>
        </div>
        <div class="flex items-center gap-4">
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                @if($invoice->status == 'paid') bg-green-100 text-green-800 
                @elseif($invoice->status == 'overdue') bg-red-100 text-red-800 
                @elseif($invoice->status == 'deposit') bg-yellow-100 text-yellow-800 
                @else bg-gray-100 text-gray-800 @endif">
                {{ strtoupper($invoice->status) }}
            </span>
            <a href="{{ route('invoices.public.download', $invoice->invoice_number) }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download PDF
            </a>
        </div>
    </div>
    
    <div class="iframe-container">
        <!-- We use object or iframe. object is often better for PDF rendering in some browsers -->
        <object data="{{ route('invoices.public.stream', $invoice->invoice_number) }}" type="application/pdf" width="100%" height="100%">
            <p>It appears your web browser doesn't support viewing PDFs online. <br>
               <a href="{{ route('invoices.public.download', $invoice->invoice_number) }}" class="text-indigo-600 underline">Click here to download the PDF</a>.
            </p>
        </object>
    </div>

    <div class="footer-banner">
        Powered by <a href="https://tinycatstudio.tech" target="_blank" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">TinyCatStudio</a>
    </div>
</body>
</html>