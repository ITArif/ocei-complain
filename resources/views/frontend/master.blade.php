<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from e-service.ocei.gov.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Sep 2021 07:51:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>@yield('title')</title>
    @include('frontend.partials._css_js_head')
</head>



<body>

<div class="container main-wrapper">
    <!-- Start Loader -->
    <!--<div id="loader">
        <div class="square-spin">
            <img src="/assets/img/preloader.gif" alt="">
        </div>
    </div>-->
    <div class="row">
        <div style="margin-left: 10px; margin-right: 10px;">
        <marquee width="100%" direction="left" height="80px">
            <h1 style="color: red;">New Registration And Application Submission Time has been Expired.</h1>
        </marquee>
        </div>
    </div>

    @include('frontend.partials._header')

    @include('frontend.partials._navbar')

    <div class="clearfix row margin-bottom-50">

        @yield('contain')

        
    </div><!--/.sidebar-offcanvas-->

        <script src="{{asset('frontend/echallan/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('frontend/echallan/assets/js/jquery.bootstrap.newsbox.min.js')}}"></script>
        <script src="{{asset('frontend/echallan/assets/js/highcharts.min.js')}}"></script>
        <script src="{{asset('frontend/echallan/assets/js/exporting.min.js')}}"></script>

<script>
            jQuery(function ($) {
                $("#scrollerNews").bootstrapNews({
                    newsPerPage: 10,
                    autoplay: true,
                    onToDo: function () {
                        // console.log(this);
                    }
                });

                setTimeout(function(){
                    var currentYear = new Date().getFullYear();
                    getYearlyReport(currentYear);
                }, 500);

                // Graph
                window.getYearlyReport = function (currentYear) {
                    var report_year;
                    if(currentYear) report_year = currentYear;
                    else report_year = $("#reportYear").val();
                    // get the json
                    $.ajax({
                        type: 'POST',
                        url: 'challanController.php',
                        data: 'monthlyIncome=' + true + '&&reportYear=' + report_year,
                    }).done(function(myData) {
                        var obj = jQuery.parseJSON(myData);
                        // initialize the data array
                        var i, mySeries = [];
                        Object.keys(obj).forEach(function (key){
                            mySeries.push(obj[key].amount);
                        });
                        // console.log(mySeries);

                        var chart = Highcharts.chart('monthlyIncome', {
                            title: {
                                text: 'মাসভিত্তিক প্রাপ্তি'
                            },
                            xAxis: {
                                categories: [ 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর']//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                            },
                            yAxis: {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -15
                                },
                                title: {
                                    text: 'প্রাপ্তি (হাজার টাকায়)'
                                }
                            },
                            series: [{
                                type: 'column',
                                name: 'প্রাপ্তি',
                                colorByPoint: true,
                                data: mySeries,
                                showInLegend: false
                            }]
                        });
                    });
                }

                // code Wise Income
                $.ajax({
                    type: 'POST',
                    url: 'challanController.php',
                    data: 'codeWiseIncome=' + true,
                }).done(function(myData) {
                    var obj = jQuery.parseJSON(myData);
                    // initialize the data array
                    var amountSeries = [];
                    Object.keys(obj.AMOUNT).forEach(function (key){
                        amountSeries.push(parseInt(obj.AMOUNT[key]));
                    });
                    // console.log(myData);

                    var chart = Highcharts.chart('codeWiseIncome', {
                        title: {
                            text: 'কর/সেবাভিত্তিক প্রাপ্তি'
                        },
                        xAxis: {
                            categories: obj.CODE
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -15
                            },
                            title: {
                                text: 'প্রাপ্তি (হাজার টাকায়)'
                            }
                        },
                        series: [{
                            type: 'column',
                            name: 'প্রাপ্তি',
                            colorByPoint: true,
                            data:  amountSeries,
                            showInLegend: false
                        }]
                    });
                });


            });
        </script>
    </div>
    <!-- Footer Section -->
    <!-- @include('frontend.partials._footer')
 -->    <!-- End Footer Section -->

    <!-- ScrollTop Starts-->
    <div class="scroll-top hide">
        <a id="gotoTop">
            <i class="fa fa-angle-up fa-2x"></i>
        </a>
    </div><!-- ScrollTop Starts-->


    </div>

</div><!--/.container-->

<!--/.container-->








<!--Combined JS-->
<script src="assets/echallan/assets/js/combined.min.js"></script>

<script src="assets/echallan/assets/js/xlsx.core.min.js"></script>
<script src="assets/echallan/assets/js/FileSaver.min.js"></script>
<script src="assets/echallan/assets/js/tableexport.min.js"></script>

</body>

<!-- Mirrored from e-service.ocei.gov.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Sep 2021 07:52:16 GMT -->
</html>
