@extends('frontend.master')
@section('title', 'Complain Otp Form')
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
                <h3 class="page-heading">
                    <span>Otp Verification</span>
                </h3>
                <div class="col-md-12 offset-2 mt-2">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong class="text-center">{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger alert-block text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div style="border: 2px solid #7030A0;"><br>
                            <form method="post" action="{{route('otpVerificationComplain')}}" class="form clearfix">
                                @csrf
                                <!-- left column -->
                                <div class="col-md-12">
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Otp<span id="mark">&nbsp;*</span></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="otp" id="otp" value="{{ old('otp') }}" placeholder="Enter your otp" required>
                                          @if ($errors->has('otp'))
                                            <span class="text-danger">{{ $errors->first('otp') }}</span>
                                          @endif
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                 </div>
                                </div>
                                 <!--/.col (left) -->
                                
                            </form><br/>
                        </div>
                    </div>
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
