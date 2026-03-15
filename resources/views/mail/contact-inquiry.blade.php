<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Inquiry</title>
    <style>
        body { margin: 0; padding: 0; background: #f4f4f5; font-family: 'Segoe UI', Arial, sans-serif; color: #1b1b18; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .header { background: #DC2626; padding: 32px 40px; }
        .header h1 { margin: 0; color: #ffffff; font-size: 20px; font-weight: 700; letter-spacing: -.3px; }
        .header p { margin: 4px 0 0; color: rgba(255,255,255,.75); font-size: 13px; }
        .body { padding: 36px 40px; }
        .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #9ca3af; margin-bottom: 4px; }
        .value { font-size: 15px; color: #1b1b18; margin-bottom: 24px; }
        .value a { color: #DC2626; text-decoration: none; }
        .message-box { background: #f9fafb; border-left: 3px solid #DC2626; border-radius: 6px; padding: 16px 20px; font-size: 15px; line-height: 1.7; color: #374151; white-space: pre-wrap; word-break: break-word; }
        .divider { border: none; border-top: 1px solid #f0f0f0; margin: 28px 0; }
        .footer { background: #f9fafb; padding: 20px 40px; border-top: 1px solid #f0f0f0; }
        .footer p { margin: 0; font-size: 12px; color: #9ca3af; }
        .reply-btn { display: inline-block; margin-top: 24px; background: #DC2626; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600; padding: 12px 28px; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>New Portfolio Inquiry</h1>
            <p>Someone reached out through your portfolio contact form.</p>
        </div>
        <div class="body">
            <div class="label">From</div>
            <div class="value">{{ $senderName }}</div>

            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a></div>

            <div class="label">Subject</div>
            <div class="value">{{ $subject }}</div>

            <div class="label">Message</div>
            <div class="message-box">{{ $body }}</div>

            <a href="mailto:{{ $senderEmail }}?subject=Re: {{ rawurlencode($subject) }}" class="reply-btn">
                Reply to {{ $senderName }}
            </a>
        </div>
        <div class="footer">
            <p>Sent via your portfolio at <strong>exequiellustan.dev</strong> &mdash; {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
