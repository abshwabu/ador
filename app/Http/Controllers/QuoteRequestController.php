<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Store a newly created quote request from the public website.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $quoteRequest = QuoteRequest::create([
            ...$validated,
            'status' => QuoteRequest::STATUS_NEW,
            'ip_address' => $request->ip(),
        ]);

        $successMessage = 'Thank you for contacting Adorn Trading PLC! Your quote request has been received. Our team will reach out to you shortly.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'quote_id' => $quoteRequest->id,
            ]);
        }

        return redirect()
            ->to(route('home') . '#contact')
            ->with('quote_success', $successMessage);
    }
}
