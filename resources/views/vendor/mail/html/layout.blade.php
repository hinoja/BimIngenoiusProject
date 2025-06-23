<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ config('app.name') }}</title>
    <style>
        /* Base */
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            background-color: #F8F9FA;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Layout */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            background-color: #F8F9FA;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
        }

        /* Header */
        .header {
            background-color: #2A2E45;
            padding: 30px 0;
            text-align: center;
            border-bottom: 3px solid #FF6B35;
        }

        .header img {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 15px 0 0 0;
            font-weight: 600;
        }

        /* Body */
        .body {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .content-cell {
            padding: 30px;
        }

        /* Typography */
        h1, h2, h3, h4 {
            color: #2A2E45;
            margin: 0 0 20px 0;
        }

        p {
            margin: 0 0 16px 0;
            color: #4a5568;
            line-height: 1.6;
        }

        /* Buttons */
        .button {
            background-color: #FF6B35;
            border-radius: 4px;
            color: #ffffff !important;
            display: inline-block;
            font-weight: 600;
            padding: 12px 24px;
            text-decoration: none;
            text-transform: uppercase;
        }

        /* Footer */
        .footer {
            background-color: #2A2E45;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .footer p {
            color: #ffffff;
            font-size: 14px;
            margin: 0;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .content {
                width: 100% !important;
            }

            .body {
                margin: 10px !important;
            }

            .content-cell {
                padding: 20px !important;
            }
        }
    </style>
    {{ $head ?? '' }}
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy ?? '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
