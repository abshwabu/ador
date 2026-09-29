<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', $settings->company_name ?? 'Adorn Trading PLC')</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #0b1f33;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      color: #1e293b;
      -webkit-font-smoothing: antialiased;
      line-height: 1.6;
    }
    table {
      border-collapse: separate;
    }
    a {
      color: #ed9c39;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    @media only screen and (max-width: 620px) {
      .email-container {
        width: 100% !important;
        border-radius: 0 !important;
      }
      .content-cell {
        padding: 24px 18px !important;
      }
      .header-cell {
        padding: 24px 18px !important;
      }
      .footer-cell {
        padding: 24px 18px !important;
      }
    }
  </style>
</head>
<body style="margin: 0; padding: 24px 0; background-color: #0b1f33;">
  <center>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 620px; margin: 0 auto; text-align: left;" class="email-container">
      <!-- Top Decorative Accent -->
      <tr>
        <td style="height: 4px; background: linear-gradient(90deg, #f5a337 0%, #ed9c39 50%, #d22f49 100%); border-radius: 12px 12px 0 0;"></td>
      </tr>

      <!-- Header -->
      <tr>
        <td class="header-cell" style="background-color: #042641; padding: 28px 32px; border-bottom: 1px solid rgba(255,255,255,0.08);">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td>
                <span style="font-size: 20px; font-weight: 800; letter-spacing: 1.5px; color: #ffffff; text-transform: uppercase; display: inline-block;">
                  {{ $settings->company_name ?? 'Adorn Trading PLC' }}
                </span>
                <span style="display: block; font-size: 12px; color: #f5a337; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-top: 4px;">
                  {{ $settings->tagline ?? 'Design. Source. Deliver.' }}
                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <!-- Main Body Card -->
      <tr>
        <td class="content-cell" style="background-color: #ffffff; padding: 36px 32px; font-size: 15px; color: #1e293b; line-height: 1.65;">
          @yield('content')
        </td>
      </tr>

      <!-- Footer -->
      <tr>
        <td class="footer-cell" style="background-color: #031b2e; padding: 28px 32px; border-radius: 0 0 12px 12px; color: #94a3b8; font-size: 13px; line-height: 1.6;">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td>
                <strong style="color: #ffffff; font-size: 14px; display: block; margin-bottom: 6px;">
                  {{ $settings->company_name ?? 'Adorn Trading PLC' }}
                </strong>
                <p style="margin: 0 0 12px 0; color: #94a3b8;">
                  {{ $settings->contact_address ?? 'Addis Ababa, Ethiopia' }} · 
                  <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone ?? '+251') }}" style="color: #cbd5e1; text-decoration: none;">{{ $settings->contact_phone ?? '+251 9… / +251 7…' }}</a> · 
                  <a href="mailto:{{ $settings->contact_email ?? 'info@adorntrading.com' }}" style="color: #f5a337; text-decoration: none;">{{ $settings->contact_email ?? 'info@adorntrading.com' }}</a>
                </p>
                <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 12px; font-size: 12px; color: #64748b;">
                  {{ $settings->footer_copyright ?? '© ' . date('Y') . ' Adorn Trading PLC. All rights reserved.' }}
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>
