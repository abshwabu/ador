<?php

namespace App\Http\Controllers;

use App\Mail\NewQuoteRequestNotification;
use App\Mail\QuoteRequestConfirmationMail;
use App\Models\QuoteRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            'email' => ['required', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:150'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $quoteRequest = QuoteRequest::create([
            ...$validated,
            'status' => QuoteRequest::STATUS_NEW,
            'ip_address' => $request->ip(),
        ]);

        $settings = Setting::instance();

        // Send notifications (gracefully catch errors if mail server is unconfigured)
        try {
            $companyEmail = $settings->contact_email ?: config('mail.from.address');
            if ($companyEmail) {
                Mail::to($companyEmail)->send(new NewQuoteRequestNotification($quoteRequest, $settings));
            }

            if (!empty($quoteRequest->email)) {
                Mail::to($quoteRequest->email)->send(new QuoteRequestConfirmationMail($quoteRequest, $settings));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to send quote request notification email: ' . $e->getMessage(), [
                'quote_request_id' => $quoteRequest->id,
                'exception' => $e,
            ]);
        }

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
