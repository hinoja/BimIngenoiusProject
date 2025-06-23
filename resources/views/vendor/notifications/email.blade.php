<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
            color: #2d3748;
            line-height: 1.6;
        }

        a {
            color: #FF6B35;
            text-decoration: none;
        }

        .main-content {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header, .footer {
            background: #2A2E45;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .header img {
            max-width: 100px;
            border-radius: 6px;
        }

        .header h1 {
            margin: 15px 0 5px;
            font-size: 24px;
            font-weight: 700;
        }

        .hero {
            background: #FF6B35;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .hero h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .body-content {
            padding: 25px 20px;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .block {
            background: #f1f5f9;
            padding: 15px;
            border-left: 3px solid #FF6B35;
            border-radius: 6px;
            margin: 15px 0;
        }

        .feature {
            background: #4facfe;
            color: #fff;
            text-align: center;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .button {
            background: #FF6B35;
            display: inline-block;
            color: #fff !important;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .signature {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #edf2f7;
            border-radius: 6px;
        }

        .footer-info {
            font-size: 12px;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 6px;
        }

        @media only screen and (max-width: 600px) {
            .main-content, .body-content {
                width: 100% !important;
                padding: 15px !important;
            }

            .header h1 {
                font-size: 20px;
            }

            .hero h2 {
                font-size: 16px;
            }

            h2 {
                font-size: 18px;
            }

            .button {
                width: 100%;
                text-align: center;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px;">
                <table class="main-content" cellpadding="0" cellspacing="0">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <a href="{{ url('/') }}">
                                @if (file_exists(public_path('logo.jpg')))
                                    <img src="{{ asset('logo.jpg') }}" alt="{{ config('app.name') }} Logo" />
                                @endif
                            </a>
                            <h1>{{ config('app.name') }}</h1>
                            <p style="text-align: center;"><strong>Innovation • Excellence • Durabilité</strong></p>
                        </td>
                    </tr>

                    <!-- Hero -->
                    <tr>
                        <td class="hero">
                            <h2>🚀 <strong>Construisons l’avenir, un projet à la fois !</strong></h2>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body-content">
                            <div style="text-align: center;">
                            <div style="background:#667eea; padding:10px; border-radius:50%; display:inline-block;">
                                <span style="font-size: 20px;">👋</span>
                            </div>
                            <h2>
                                @php
                                    $greeting = $greeting ?? '';
                                    $level = $level ?? '';
                                    $introLines = $introLines ?? [];
                                    $actionText = $actionText ?? null;
                                    $actionUrl = $actionUrl ?? '#';
                                    $outroLines = $outroLines ?? [];
                                @endphp
                                @if (!empty($greeting))
                                    {{ $greeting }}
                                @else
                                    @if ($level === 'error')
                                        ⚠️ @lang('Attention !')
                                    @else
                                        🎉 @lang('Bonjour !')
                                    @endif
                                @endif
                            </h2>
                        </div>

                        @foreach ($introLines as $line)
                            <div class="block">✨ {{ $line }}</div>
                        @endforeach

                        @if (!empty($actionText ?? null))
                            <div style="text-align: center; margin: 24px 0;">
                                <a href="{{ $actionUrl ?? '#' }}" class="button" target="_blank" style="
                                    display: inline-block;
                                    width: 100%;
                                    max-width: 320px;
                                    box-sizing: border-box;
                                    background: #FF6B35;
                                    color: #fff !important;
                                    padding: 14px 0;
                                    border-radius: 25px;
                                    font-weight: 600;
                                    text-transform: uppercase;
                                    font-size: 16px;
                                    text-align: center;
                                    margin: 0 auto;
                                    transition: background 0.2s;
                                ">
                                    🚀 {{ $actionText ?? '' }}
                                </a>
                            </div>
                        @endif

                        @foreach ($outroLines as $line)
                            <div class="block" style="background:#fff7f5;">{{ $line }}</div>
                        @endforeach

                            <div class="signature">
                                <p>@lang('Cordialement,') <strong>{{ config('app.name') }}</strong></p>
                                 <span style="font-size: 12px; color: #718096;">🏆 Your Partner in Building Excellence</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>© {{ date('Y') }} <strong style="color: #FF6B35;">{{ config('app.name') }}</strong>. @lang('Tous droits réservés.')</p>
                            <div class="footer-info">
                                <p>🌟 <strong>BIM INGENIOUS BTP</strong> - Pioneering Construction Innovation</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
