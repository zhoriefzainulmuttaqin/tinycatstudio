<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('lead', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'service_id' => ['required', 'integer', Rule::exists('services', 'id')],
            'budget' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Lead::create([
            ...$validated,
            'status' => 'new',
        ]);

        return back()
            ->with('success', 'Terima kasih, permintaan konsultasi Anda sudah kami terima.')
            ->withFragment('consultation');
    }
}
