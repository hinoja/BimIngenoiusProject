<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2A2E45;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FF6B35;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }
        .unsubscribe {
            color: #999;
            font-size: 12px;
            text-align: center;
            margin-top: 20px;
        }
        .unsubscribe a {
            color: #666;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="content">
            {!! $content !!}
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</p>
            <div class="unsubscribe">
                <p>@lang('If you no longer wish to receive these emails, you can') <a href="{{ $unsubscribeUrl }}">@lang('unsubscribe')</a>.</p>
            </div>
        </div>
    </div>

    <!-- Tracking pixel -->
    <img src="{{ $trackingPixel }}" alt="" width="1" height="1" style="display:none;">
</body>
</html>

