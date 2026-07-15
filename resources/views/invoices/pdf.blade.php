<!DOCTYPE html>
<html>
<head>

    <title>GST Invoice PDF</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color:#000;
        }

        .invoice-container{
            width:100%;
        }

        .header{
            width:100%;
            margin-bottom:20px;
        }

        .header-table{
            width:100%;
        }

        .header-table td{
            vertical-align:top;
        }

        .company-logo{
            width:120px;
            margin-bottom:10px;
        }

        .company-name{
            font-size:22px;
            font-weight:bold;
        }

        .invoice-title{
            font-size:24px;
            font-weight:bold;
            text-align:right;
        }

        .section-title{
            font-size:16px;
            font-weight:bold;
            margin-top:20px;
            margin-bottom:10px;
        }

        .info-table{
            width:100%;
            margin-bottom:15px;
        }

        .info-table td{
            padding:4px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#f2f2f2;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:8px;
            text-align:left;
        }

        .text-right{
            text-align:right;
        }

        .totals-table{
            width:40%;
            margin-top:20px;
            margin-left:auto;
        }

        .footer{
            margin-top:40px;
            text-align:center;
            font-size:12px;
        }

    </style>

</head>
<body>

<div class="invoice-container">

    <!-- HEADER -->

    <table class="header-table">

        <tr>

            <td width="60%">

                @if($company && $company->company_logo)

                    <img
    src="{{ asset('uploads/company/'.$company->company_logo) }}"
    class="company-logo">

                @endif

                <div class="company-name">

                    {{ $company->company_name ?? '' }}

                </div>

                <p>

                    <strong>GSTIN:</strong>

                    {{ $company->gst_number ?? '' }}

                </p>

                <p>

                    <strong>Phone:</strong>

                    {{ $company->phone ?? '' }}

                </p>

                <p>

                    <strong>State:</strong>

                    {{ $company->state ?? '' }}

                </p>

                <p>

                    <strong>Address:</strong>

                    {{ $company->address ?? '' }}

                </p>

            </td>

            <td width="40%">

                <div class="invoice-title">

                    TAX INVOICE

                </div>

                <table class="info-table">

                    <tr>

                        <td>

                            <strong>Invoice No</strong>

                        </td>

                        <td>

                            {{ $invoice->invoice_no }}

                        </td>

                    </tr>

                    <tr>

                        <td>

                            <strong>Date</strong>

                        </td>

                        <td>

                            {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

    <!-- CUSTOMER DETAILS -->

    <div class="section-title">

        Bill To

    </div>

    <table class="info-table">

        <tr>

            <td width="20%">

                <strong>Name</strong>

            </td>

            <td width="80%">

                {{ $invoice->customer->name }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>Email</strong>

            </td>

            <td>

                {{ $invoice->customer->email }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>Phone</strong>

            </td>

            <td>

                {{ $invoice->customer->phone }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>GSTIN</strong>

            </td>

            <td>

                {{ $invoice->customer->gst_number }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>State</strong>

            </td>

            <td>

                {{ $invoice->customer->state }}

            </td>

        </tr>

        <tr>

            <td>

                <strong>Address</strong>

            </td>

            <td>

                {{ $invoice->customer->address }}

            </td>

        </tr>

    </table>

    <!-- PRODUCTS -->

    <div class="section-title">

        Invoice Items

    </div>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Product</th>

                <th>Price</th>

                <th>Qty</th>

                <th>GST %</th>

                <th>CGST</th>

                <th>SGST</th>

                <th>IGST</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($invoice->items as $key => $item)

            <tr>

                <td>

                    {{ $key + 1 }}

                </td>

                <td>

                    {{ $item->product->name }}

                </td>

                <td>

                    ₹{{ number_format($item->price, 2) }}

                </td>

                <td>

                    {{ $item->quantity }}

                </td>

                <td>

                    {{ $item->gst_percent }}%

                </td>

                <td>

                    {{ $item->cgst_percent }}%
                    <br>

                    ₹{{ number_format($item->cgst_amount, 2) }}

                </td>

                <td>

                    {{ $item->sgst_percent }}%
                    <br>

                    ₹{{ number_format($item->sgst_amount, 2) }}

                </td>

                <td>

                    {{ $item->igst_percent }}%
                    <br>

                    ₹{{ number_format($item->igst_amount, 2) }}

                </td>

                <td>

                    ₹{{ number_format($item->total, 2) }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <!-- TOTALS -->

    <table class="totals-table">

        <tr>

            <th>

                Subtotal

            </th>

            <td class="text-right">

                ₹{{ number_format($invoice->subtotal, 2) }}

            </td>

        </tr>

        <tr>

            <th>

                Total GST

            </th>

            <td class="text-right">

                ₹{{ number_format($invoice->gst_total, 2) }}

            </td>

        </tr>

        <tr>

            <th>

                Grand Total

            </th>

            <td class="text-right">

                <strong>

                    ₹{{ number_format($invoice->grand_total, 2) }}

                </strong>

            </td>

        </tr>

    </table>

    <!-- FOOTER -->

    <div class="footer">

        Thank you for your business.

    </div>

</div>

</body>
</html>