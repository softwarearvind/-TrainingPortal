<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            background: #f8f5ed;
            color: #111827;
        }

        .certificate {
            width: 100%;
            height: 100vh;
            padding: 40px;
            position: relative;
        }

        .outer-border {
            border: 2px solid #c49a5a;
            padding: 6px;
            height: 100%;
        }

        .inner-border {
            border: 1px solid #c49a5a;
            height: 100%;
            padding: 45px 55px;
            position: relative;
            text-align: center;
        }

        /* corner accents */
        .corner {
            position: absolute;
            width: 34px;
            height: 34px;
            border: 3px solid #c49a5a;
        }

        .corner-tl { top: -3px; left: -3px; border-right: none; border-bottom: none; }
        .corner-tr { top: -3px; right: -3px; border-left: none; border-bottom: none; }
        .corner-bl { bottom: -3px; left: -3px; border-right: none; border-top: none; }
        .corner-br { bottom: -3px; right: -3px; border-left: none; border-top: none; }

        .seal {
            display: inline-block;
            width: 56px;
            height: 56px;
            line-height: 56px;
            border-radius: 50%;
            background: #c49a5a;
            color: #ffffff;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .eyebrow {
            letter-spacing: 4px;
            font-size: 11px;
            color: #8a7245;
            text-transform: uppercase;
            font-weight: bold;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            color: #111827;
            margin-top: 8px;
        }

        .divider {
            width: 70px;
            height: 2px;
            background: #c49a5a;
            margin: 16px auto;
        }

        .subtitle {
            font-size: 15px;
            color: #6b7280;
            margin-top: 4px;
        }

        .student {
            font-size: 30px;
            font-weight: bold;
            margin: 14px 0 6px;
            color: #111827;
            border-bottom: 1px solid #d9c79a;
            display: inline-block;
            padding-bottom: 8px;
        }

        .course {
            font-size: 19px;
            font-weight: bold;
            color: #c49a5a;
            margin-top: 6px;
        }

        .details-table {
            width: 80%;
            margin: 30px auto 0;
            border-collapse: collapse;
            font-size: 13px;
        }

        .details-table td {
            padding: 6px 10px;
            text-align: left;
        }

        .details-table .label {
            color: #6b7280;
            width: 40%;
        }

        .details-table .value {
            font-weight: bold;
            color: #111827;
        }

        .footer-row {
            width: 100%;
            margin-top: 40px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            vertical-align: bottom;
            font-size: 11px;
            color: #6b7280;
        }

        .cert-no {
            text-align: left;
        }

        .cert-no strong {
            color: #111827;
            font-size: 13px;
        }

        .qr-cell {
            text-align: right;
        }

        .qr-cell .verify-label {
            display: block;
            margin-top: 4px;
        }

        .qr-cell .verify-url {
            display: block;
            font-size: 9px;
            word-break: break-all;
            max-width: 220px;
            margin-left: auto;
        }
    </style>
</head>

<body>

    <div class="certificate">
        <div class="outer-border">
            <div class="inner-border">
                <div class="corner corner-tl"></div>
                <div class="corner corner-tr"></div>
                <div class="corner corner-bl"></div>
                <div class="corner corner-br"></div>

                <div class="seal">&#9733;</div>
                <div class="eyebrow">Certificate of Achievement</div>

                <div class="title">
                    {{ $certificate->certificate_title }}
                </div>

                <div class="divider"></div>

                <div class="subtitle">This certificate is proudly presented to</div>

                <div class="student">
                    {{ $certificate->student->user->name ?? 'Student' }}
                </div>

                <div class="subtitle">for successfully completing</div>

                <div class="course">
                    {{ $certificate->course->name }}
                </div>

                <table class="details-table">
                    <tr>
                        <td class="label">Batch</td>
                        <td class="value">{{ $certificate->batch->name ?? '-' }}</td>
                        <td class="label">Grade</td>
                        <td class="value">{{ $certificate->grade ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Marks</td>
                        <td class="value">{{ $certificate->marks ?? '-' }} / {{ $certificate->total_marks ?? '-' }}</td>
                        <td class="label">Completion Date</td>
                        <td class="value">{{ $certificate->completion_date?->format('d M Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Issue Date</td>
                        <td class="value">{{ $certificate->issue_date?->format('d M Y') ?? '-' }}</td>
                        <td class="label"></td>
                        <td class="value"></td>
                    </tr>
                </table>

                <table class="footer-table footer-row">
                    <tr>
                        <td class="cert-no">
                            Certificate No:<br>
                            <strong>{{ $certificate->certificate_no }}</strong>
                        </td>
                        <td class="qr-cell">
                            {!! QrCode::size(80)->generate($verificationUrl) !!}
                            <span class="verify-label">Scan to verify</span>
                            <span class="verify-url">{{ $verificationUrl }}</span>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</body>

</html>
