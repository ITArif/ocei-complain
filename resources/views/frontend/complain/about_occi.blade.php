@extends('frontend.master')
@section('title', 'About OCCI')
@section('stylesheet')

@endsection
@section('contain')
    <div class="col-md-12 col-sm-8 col-xs-12">
        <div class="row registration-page-wrapper">
            <div class="col-xs-12">
                <div id="messageSection" class="alert alert-success hide">
                    <button class="close" data-dismiss="alert">×</button>
                    <div id="messageBody">
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div style="border: 2px solid #7030A0;" class="row"><br>
                            <p>The major function of the office of *Chief Electric Inspector (CEI)" is to inspect all high tension (HT) electrical substations, factories, overhead lines, motors and internal wiring etc. and accord approval certificate under the condition of being okayed from electrical safety point of view and found suitable for energization. Granting electricity contractor's licenses to the contractors, supervisors" certificates of competency to the engineers and electrical workman permits to the electricians are also the functions of this department. Besides, periodic re-inspection of HiT electrical substations, factories, overhead lines etc. the function of OCEl cover inspection every after two years, supervision, accident audit, settlement of disputes regarding meter reading etc.</p>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            </div>
            <!--/.col-xs-12.col-sm-9-->
        </div>
        @include('frontend.partials._footer')
    </div>
@endsection

@section('custom_script')


<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script>
        $(function() {
            //CKEDITOR.replace( 'reason' );
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        // $(document).ready(function () { 
       
        //     $('#complain_against').on('change', function() {
        //     alert( this.value );
        //    });
        // });
        

    </script>
@endsection
