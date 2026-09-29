@extends('emails.layout')

@section('title', 'New Consultation Request: ' . $quoteRequest->full_name)

@section('content')
<h1 style="margin: 0 0 16px 0; font-size: 22px; font-weight: 700; color: #042641;">
  New Consultation Request
</h1>

<p style="margin: 0 0 24px 0; font-size: 15px; color: #475569;">
  A prospective client has submitted a consultation request on the website. Below are the submission details:
</p>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
  <tr style="background-color: #f8fafc;">
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; width: 35%; border-bottom: 1px solid #e2e8f0;">Client Name</td>
    <td style="padding: 12px 16px; color: #0f172a; font-weight: 700; border-bottom: 1px solid #e2e8f0;">{{ $quoteRequest->full_name }}</td>
  </tr>
  @if($quoteRequest->company)
  <tr>
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">Company / Org</td>
    <td style="padding: 12px 16px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $quoteRequest->company }}</td>
  </tr>
  @endif
  <tr style="background-color: #f8fafc;">
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">Email Address</td>
    <td style="padding: 12px 16px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
      <a href="mailto:{{ $quoteRequest->email }}" style="color: #ed9c39; font-weight: 600;">{{ $quoteRequest->email }}</a>
    </td>
  </tr>
  <tr>
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">Phone / WhatsApp</td>
    <td style="padding: 12px 16px; color: #0f172a; font-weight: 600; border-bottom: 1px solid #e2e8f0;">
      <a href="tel:{{ preg_replace('/[^0-9+]/', '', $quoteRequest->phone) }}" style="color: #042641;">{{ $quoteRequest->phone }}</a>
    </td>
  </tr>
  @if($quoteRequest->project_type)
  <tr style="background-color: #f8fafc;">
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">Project Type</td>
    <td style="padding: 12px 16px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $quoteRequest->project_type }}</td>
  </tr>
  @endif
  @if($quoteRequest->city)
  <tr>
    <td style="padding: 12px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">City / Location</td>
    <td style="padding: 12px 16px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $quoteRequest->city }}</td>
  </tr>
  @endif
  <tr style="background-color: #f8fafc;">
    <td style="padding: 12px 16px; font-weight: 600; color: #475569;">Received Date</td>
    <td style="padding: 12px 16px; color: #64748b; font-size: 14px;">{{ $quoteRequest->created_at?->format('M d, Y · g:i A') ?? now()->format('M d, Y · g:i A') }}</td>
  </tr>
</table>

<div style="margin-bottom: 28px;">
  <span style="font-weight: 700; color: #042641; display: block; margin-bottom: 8px; font-size: 15px;">Project Requirements & Message:</span>
  <div style="background-color: #f8fafc; border-left: 4px solid #f5a337; padding: 16px 20px; border-radius: 0 8px 8px 0; color: #334155; font-size: 14px; line-height: 1.65; white-space: pre-wrap;">{{ $quoteRequest->message }}</div>
</div>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-top: 24px;">
  <tr>
    <td align="center" style="border-radius: 8px; background: #042641;">
      <a href="{{ url('/admin/quote-requests/' . $quoteRequest->id) }}" target="_blank" style="font-size: 15px; font-weight: 600; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; background-color: #042641;">
        Open in Admin Dashboard &rarr;
      </a>
    </td>
  </tr>
</table>

<p style="margin: 24px 0 0 0; font-size: 13px; color: #64748b;">
  Tip: You can reply directly to this notification email or use the Reply action in the Filament admin dashboard.
</p>
@endsection
