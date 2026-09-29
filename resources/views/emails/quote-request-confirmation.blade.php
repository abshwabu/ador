@extends('emails.layout')

@section('title', 'Consultation Request Received — ' . ($settings->company_name ?? 'Adorn Trading PLC'))

@section('content')
<h1 style="margin: 0 0 16px 0; font-size: 22px; font-weight: 700; color: #042641;">
  Thank You for Your Consultation Request
</h1>

<p style="margin: 0 0 16px 0; font-size: 15px; color: #334155;">
  Dear <strong>{{ $quoteRequest->full_name }}</strong>,
</p>

<p style="margin: 0 0 20px 0; font-size: 15px; color: #475569; line-height: 1.65;">
  Thank you for reaching out to <strong>{{ $settings->company_name ?? 'Adorn Trading PLC' }}</strong>. We have successfully received your request for interior finishing, architectural furnishing, and project procurement.
</p>

<div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 20px 24px; margin-bottom: 24px;">
  <span style="font-weight: 700; color: #042641; display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">Summary of Your Request</span>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    @if($quoteRequest->project_type)
    <tr>
      <td style="padding: 6px 0; color: #64748b; font-size: 14px; width: 40%;">Project Type:</td>
      <td style="padding: 6px 0; color: #0f172a; font-weight: 600; font-size: 14px;">{{ $quoteRequest->project_type }}</td>
    </tr>
    @endif
    @if($quoteRequest->city)
    <tr>
      <td style="padding: 6px 0; color: #64748b; font-size: 14px;">Location:</td>
      <td style="padding: 6px 0; color: #0f172a; font-weight: 600; font-size: 14px;">{{ $quoteRequest->city }}</td>
    </tr>
    @endif
    <tr>
      <td style="padding: 6px 0; color: #64748b; font-size: 14px;">Phone / WhatsApp:</td>
      <td style="padding: 6px 0; color: #0f172a; font-weight: 600; font-size: 14px;">{{ $quoteRequest->phone }}</td>
    </tr>
    <tr>
      <td style="padding: 6px 0; color: #64748b; font-size: 14px; vertical-align: top;">Submitted Message:</td>
      <td style="padding: 6px 0; color: #334155; font-size: 14px; line-height: 1.5;">{{ $quoteRequest->message }}</td>
    </tr>
  </table>
</div>

<h2 style="margin: 0 0 12px 0; font-size: 16px; font-weight: 700; color: #042641;">
  What Happens Next?
</h2>

<p style="margin: 0 0 16px 0; font-size: 14px; color: #475569; line-height: 1.6;">
  Our project specialists in Addis Ababa are reviewing your requirements. A member of our team will contact you shortly via phone or email to discuss layout drawings, material specifications, or quotation details.
</p>

<div style="background: rgba(245, 163, 55, 0.08); border-left: 4px solid #f5a337; padding: 14px 18px; border-radius: 0 8px 8px 0; margin-bottom: 24px; font-size: 14px; color: #334155;">
  <strong>Have urgent inquiries or drawings to share?</strong><br>
  Feel free to reply directly to this email or contact us via WhatsApp at <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone ?? '+251') }}" style="color: #ed9c39; font-weight: 600;">{{ $settings->contact_phone ?? '+251 9… / +251 7…' }}</a>.
</div>

<p style="margin: 0; font-size: 14px; color: #64748b;">
  Warm regards,<br>
  <strong style="color: #042641;">The {{ $settings->company_name ?? 'Adorn Trading PLC' }} Team</strong><br>
  <span style="font-size: 13px; color: #f5a337;">Design. Source. Deliver.</span>
</p>
@endsection
