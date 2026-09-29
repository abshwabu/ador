@extends('emails.layout')

@section('title', $replySubject)

@section('content')
<p style="margin: 0 0 16px 0; font-size: 15px; color: #334155;">
  Dear <strong>{{ $quoteRequest->full_name }}</strong>,
</p>

<div style="font-size: 15px; color: #1e293b; line-height: 1.7; margin-bottom: 28px;">
  {!! nl2br(e($replyMessage)) !!}
</div>

<div style="border-top: 1px solid #e2e8f0; padding-top: 20px; margin-top: 28px;">
  <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
    Reference: Your Consultation Request (#{{ $quoteRequest->id }})
  </span>
  <div style="background-color: #f8fafc; border-left: 3px solid #cbd5e1; padding: 12px 16px; border-radius: 0 6px 6px 0; font-size: 13px; color: #475569; line-height: 1.55;">
    @if($quoteRequest->project_type)
      <strong>Project:</strong> {{ $quoteRequest->project_type }} @if($quoteRequest->city) &middot; {{ $quoteRequest->city }} @endif<br>
    @endif
    <strong>Message:</strong> {{ $quoteRequest->message }}
  </div>
</div>

<div style="margin-top: 28px; font-size: 14px; color: #475569; line-height: 1.6;">
  Sincerely,<br>
  <strong style="color: #042641; font-size: 15px;">{{ $senderName ?? 'Adorn Trading PLC Team' }}</strong><br>
  <span style="color: #64748b;">{{ $settings->company_name ?? 'Adorn Trading PLC' }}</span><br>
  <span style="font-size: 13px; color: #f5a337; font-weight: 600;">Design. Source. Deliver.</span>
</div>
@endsection
