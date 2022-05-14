<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For Favicon Icons -->
    <link rel="icon" href="{{ asset('assets/logo/login_logo.png') }}" type="image/gif" style="object-fit: cover">

    <title>Ocei-visitor</title>
    <style>
        @media print {
            #myPrntbtn {
                display: none;
            }
        }

        @page {
            size: auto;
            /* auto is the current printer page size */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            color: black;
            background-color: white;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .col-4 {
            width: 30%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            /* border: 1px solid gray; */
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px 1px 0px 0px solid #111;
            background-color: #d4d4d4;
        }

        table,
        tr {
            border-left: none;
            border-right: none;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            /* box-shadow: 0px 0px 5px 0.5px gray; */
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
            padding-right: 15px;
        }

        .w-20 {
            width: 20%;
        }

        .w-10 {
            width: 10%;
        }

        .float-right {
            float: right;
        }

    </style>
</head>

<body>
    <input style="margin-left: 30px; margin-top:20px" id="myPrntbtn" type="button" value="Print"
        onclick="window.print();">
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    {{-- <h1 class="text-white">Bazar365</h1> --}}
                    <img src="{{ asset('images/logo.png') }}"
                        style="width: 350px; height: 80px; object-fit: cover;">

                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p style="color: #111">25 New Eskaton Road, Dhaka 1000 </p>
                        <p style="color: #111"> <strong> Call Us </strong> +88088300 </p>
                        <p style="color: #111"> <strong> Email Us </strong> ocei@info.com </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h4
                style="text-align: center; border-style: dotted; height:30px; padding-top:10px; background-color: #d4d4d4;">
               প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর </h4>
            <div class="row" style="margin-top: 20px">

                <div style="width: 35%">
                    <p class="heading"> <u> Complainer Info </u> </p>
                    <p class="sub-heading"> {{ $generateComplainPDF->name }}, {{ $generateComplainPDF->mobile }} </p>
                    <p class="sub-heading"> {!!$generateComplainPDF->reason!!} </p>
                </div>

                <div style="width: 35%;">
                    <p class="heading"> <u> Admin's action </u> </p>
                    <p class="sub-heading"> {!!$generateComplainPDF->admin_action!!}</p>
                </div>

                <div style="width: 30%">
                    <p class="heading"><u>Employee's action<u></p>
                    <p class="sub-heading"> {!!$generateComplainPDF->employee_action!!}</p>
                </div>
            </div>
        </div>

        <div class="body-section" hidden>
            <p style="color: black">&copy; Copyright {{ date('Y') }} - প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর. All rights reserved.
                <a href="javascript:void(0)" class="float-right"
                    style="color: black; text-decoration: none;">www.প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর</a>
            </p>
        </div>
    </div>

</body>

</html>
