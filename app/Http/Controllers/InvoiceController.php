<?php

namespace App\Http\Controllers;

use App\Models\ClientInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    private function authorizeAccess($invoice)
    {
        $isAdmin = auth('web')->check();
        $isClient = auth('client')->check();

        if (!$isAdmin && !$isClient) {
            abort(403, 'Unauthorized access. Please login.');
        }

        if (!$isAdmin && $isClient && auth('client')->id() !== $invoice->client_id) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function preview($id)
    {
        $invoice = ClientInvoice::with(['client', 'items'])->findOrFail($id);
        $this->authorizeAccess($invoice);

        return view('invoices.template', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = ClientInvoice::with(['client', 'items'])->findOrFail($id);
        $this->authorizeAccess($invoice);

        $pdf = Pdf::loadView('invoices.template', compact('invoice'));
        
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function publicView($invoice_number)
    {
        $invoice = ClientInvoice::with(['client', 'items'])->where('invoice_number', $invoice_number)->firstOrFail();
        return view('invoices.public', compact('invoice'));
    }

    public function publicDownload($invoice_number)
    {
        $invoice = ClientInvoice::with(['client', 'items'])->where('invoice_number', $invoice_number)->firstOrFail();
        $pdf = Pdf::loadView('invoices.template', compact('invoice'));
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }
}
