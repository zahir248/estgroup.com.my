<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>New Contact Form Message</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Force dark text on light backgrounds for light mode */
        .email-body { background-color: #f0f2f5 !important; }
        .email-card { background-color: #ffffff !important; }
        .email-header-bg { background-color: #0d2137 !important; }
        .email-title { color: #1a1a1a !important; }
        .email-subtitle { color: #374151 !important; }
        .email-label { color: #0d2137 !important; }
        .email-value { color: #1a1a1a !important; }
        .email-link { color: #1a5f7a !important; }
        .email-message-text { color: #1a1a1a !important; background-color: #f0f2f5 !important; }
        .email-footer-text { color: #374151 !important; }
        .email-cta-bg { background-color: #f7931e !important; }
        .email-cta-text { color: #ffffff !important; }
    </style>
</head>
<body class="email-body" style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f0f2f5;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" class="email-card" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden;">
                    <!-- Header: solid dark bg so text always visible -->
                    <tr>
                        <td class="email-header-bg" style="background-color: #0d2137; padding: 28px 32px; text-align: center;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="text-align: center;">
                                        <span style="font-size: 18px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;">{{ config('app.name') }}</span>
                                        <div style="height: 4px; width: 48px; background-color: #f5a623; border-radius: 2px; margin: 12px auto 0;"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Title -->
                    <tr>
                        <td style="padding: 28px 32px 8px; background-color: #ffffff;">
                            <h1 class="email-title" style="margin: 0; font-size: 20px; font-weight: 700; color: #1a1a1a; letter-spacing: -0.02em;">New contact form submission</h1>
                            <p class="email-subtitle" style="margin: 8px 0 0; font-size: 14px; color: #374151;">A visitor has sent a message from your website.</p>
                        </td>
                    </tr>
                    <!-- Sender details -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #ffffff;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f0f2f5; border-radius: 10px; border: 1px solid #e5e7eb;">
                                <tr>
                                    <td style="padding: 20px 24px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding-bottom: 14px;">
                                                    <span class="email-label" style="font-size: 11px; font-weight: 600; color: #0d2137; letter-spacing: 0.08em; text-transform: uppercase;">Name</span>
                                                    <p class="email-value" style="margin: 4px 0 0; font-size: 15px; color: #1a1a1a; font-weight: 600;">{{ $senderName }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 14px;">
                                                    <span class="email-label" style="font-size: 11px; font-weight: 600; color: #0d2137; letter-spacing: 0.08em; text-transform: uppercase;">Email</span>
                                                    <p style="margin: 4px 0 0; font-size: 15px;"><a class="email-link" href="mailto:{{ $senderEmail }}" style="color: #1a5f7a; text-decoration: none; font-weight: 500;">{{ $senderEmail }}</a></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="email-label" style="font-size: 11px; font-weight: 600; color: #0d2137; letter-spacing: 0.08em; text-transform: uppercase;">Subject</span>
                                                    <p class="email-value" style="margin: 4px 0 0; font-size: 15px; color: #1a1a1a; font-weight: 600;">{{ $formSubject }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Message -->
                    <tr>
                        <td style="padding: 0 32px 24px; background-color: #ffffff;">
                            <span class="email-label" style="font-size: 11px; font-weight: 600; color: #0d2137; letter-spacing: 0.08em; text-transform: uppercase;">Message</span>
                            <div class="email-message-text" style="margin-top: 8px; padding: 20px 24px; background-color: #f0f2f5; border-left: 4px solid #1a5f7a; border-radius: 0 8px 8px 0; font-size: 15px; line-height: 1.65; color: #1a1a1a; white-space: pre-wrap;">{{ $messageBody }}</div>
                        </td>
                    </tr>
                    <!-- Reply CTA -->
                    <tr>
                        <td style="padding: 0 32px 28px; background-color: #ffffff;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td class="email-cta-bg" style="background-color: #f7931e; border-radius: 8px;">
                                        <a href="mailto:{{ $senderEmail }}?subject=Re: {{ rawurlencode($formSubject) }}" class="email-cta-text" style="display: inline-block; padding: 12px 24px; font-size: 14px; font-weight: 600; color: #ffffff; text-decoration: none;">Reply to sender</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #f0f2f5; border-top: 1px solid #e5e7eb;">
                            <p class="email-footer-text" style="margin: 0; font-size: 12px; color: #374151; text-align: center;">This email was sent from the contact form on {{ config('app.name') }}.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
