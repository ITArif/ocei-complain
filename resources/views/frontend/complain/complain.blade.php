@extends('frontend.master')
@section('title', 'Complain Form')
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
                    <span>Complain Form</span>
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
                        <div style="border: 2px solid #7030A0;" class="row"><br>
                            <form method="post" action="{{ route('store.complain') }}" class="form clearfix" enctype="multipart/form-data">
                                @csrf
                                <!-- left column -->
                                <div class="col-md-12">
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name<span id="mark">&nbsp;*</span></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your name">
                                          @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                          @endif
                                        </div>
                                      </div> 
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" id="cboOptions" class="col-sm-2 col-form-label">Complain Against <span id="mark">&nbsp;*</span></label>
                                        <div class="col-sm-10">
                                          <select class="form-control select2bs4" name="complain_against"
                                            id="complain_against" onchange="showDiv('div',this)">
                                            <option value="">----Select Complain Against----</option>
                                                <option value="contractor">Contractor</option>
                                                <option value="supervisor">Supervisor</option>
                                                <option value="electrician ">Electrician </option>
                                                <option value="ocei office">Ocei Office</option>
                                          </select>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email </label>
                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="sample@email.com">
                                          @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                         @endif
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group row" id="div2" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Branch</label>
                                        <div class="col-sm-10">
                                          <select class="form-control select2bs4" name="branch_name"
                                            id="">
                                            <option value="">----Select Branch----</option>
                                                <option value="Administration">Administration</option>
                                                <option value="Accounts">Accounts</option>
                                                <option value="Inspection">Inspection </option>
                                                <option value="Electricity Licensing Board">Electricity Licensing Board</option>
                                          </select>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6" style="position:relative;">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile Number <span id="mark">&nbsp;*</span></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="01xxxxxxxxx">
                                          @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                          @endif
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6" style="position:relative;">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">NID</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="nid" id="nid" value="{{ old('nid') }}" placeholder="01xxxxxxxxx">
                                          @if ($errors->has('nid'))
                                            <span class="text-danger">{{ $errors->first('nid') }}</span>
                                          @endif
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6" style="position:relative;">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Upload File<span style="color:red;font-size: 11px;" id="mark">&nbsp;(pdf,jpg,png)</span></label>
                                        <div class="col-sm-10">
                                          <input type="file" class="custom-file-input" name="complainer_file" id="complainer_file">
                                        </div>
                                    </div>
                                 </div>
                        
                                 <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Your Complain :<span id="mark">&nbsp;*</span></label>
                                        <div class="col-sm-12">
                                          <textarea name="reason" id="reason" rows="12" cols="80"
                                                  data-parsley-minlength="12"
                                                  data-parsley-minlength-message="Come on! You need to enter at least a 6 character comment..">

                                        </textarea>
                                        </div>
                                    </div>
                                 </div>
                                </div>
                                <!--/.col (left) -->
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form><br>
                            <div class="form-group" hidden>
                                <div style="margin-bottom:2px!important;" class="col-md-12">
                                    <span>Are you already registered? Please</span>
                                    <a class="light-green" href="{{ route('complainer.login') }}">
                                        login
                                    </a>
                                </div>
                            </div>
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
