<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .receipt-box {
            max-width: 700px;
            margin: auto;
            border: 1px solid #eee;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .info,
        .footer {
            margin-top: 20px;
        }

        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }

        .bordered td {
            border: 1px solid #ddd;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="receipt-box">
        <div style="text-align: center;">
            <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" style="width: 250px; height: auto;">
        </div>
        <div class="title">Payment Receipt</div>
        <table>
            <tr>
                <td>
                    <strong>Invoice #:</strong> {{ $payment->studentInvoice->invoice_id ?? 'N/A' }}<br>
                    <strong>Payment Reference:</strong> {{ $payment->payment_reference ?? 'N/A' }}<br>
                    <strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}<br>
                </td>
                <td class="right">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}<br>
                    <strong>Currency:</strong> {{ strtoupper($payment->currency) }}<br>
                    <strong>Cashier:</strong> {{ $payment->created_by ?? 'System' }}
                </td>
            </tr>
        </table>

        <table class="bordered" style="margin-top: 30px;">
            <tr class="bold">
                <td>Description</td>
                <td class="right">Amount</td>
            </tr>
            <tr>
                <td>Payment for Invoice #{{ $payment->studentInvoice->invoice_id ?? 'N/A' }}</td>
                <td class="right">{{ number_format($payment->amount_paid, 2) }}</td>
            </tr>
        </table>

        @if (!empty($payment->notes))
            <div class="info">
                <strong>Notes:</strong><br>
                {{ $payment->studentInvoice->studentSection->student->first_name . ' ' . $payment->studentInvoice->studentSection->student->last_name }}  {{ $payment->notes }} for  {{ $payment->studentInvoice->studentSection->section->name }}
                
            </div>
        @endif

        <div class="footer">
            <p>Thank you for your payment.</p>

            <p style="font-size: 12px; color: #777; margin-top: 30px; text-align: center;">
                <em>
                    Disclaimer: This receipt is issued as proof of payment received and does not serve as a final
                    statement of account. Please retain this receipt for your records.
                    All payments are subject to verification and reconciliation. If you believe this receipt contains
                    any discrepancies, contact the finance office within 7 days.
                </em>
            </p>

            <p style="font-size: 12px; color: #0068e0; margin-top: 30px; text-align: center;">
                <em>www.eiotechnology.com</em>
            </p>
        </div>
    </div>
</body>

</html>
