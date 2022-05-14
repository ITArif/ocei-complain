@extends('frontend.master')
@section('title', 'Track Your Complain')
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
                            <p style="text-align: center;font-weight: bold;color: green;">Your Complain</p>
                            <div class="card-body">
                                @if($trackComplains == NULL)
                                 <h3 class="card-title" style="background-color: red;text-align: center;">Opps! No Data Found</h3>
                                @else
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th style="width: 5%">Tracking Number</th>
                                      <th>Admin Action</th>
                                      <th>Forwarded Action</th>
                                      <th style="width: 10%">Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td style="width: 10px">{{$trackComplains->tracking_number}}</td>
                                      <td style="width: 40px">
                                        {!!$trackComplains->admin_action!!} <br>
                                        @if($trackComplains->admin_file != '')
                                           <a href="/uploads/{{$trackComplains->admin_file}}" class="btn btn-warning" download rel="noopener noreferrer" target="_blank">
                                            Download File <i class="fas fa-download"></i>
                                          </a>
                                        @else
                                        No Any Files
                                        @endif
                                      </td>
                                      <td style="width: 40px">
                                        {!!$trackComplains->employee_action!!} <br>
                                        @if($trackComplains->employee_file !='')
                                           <a href="/uploads/{{$trackComplains->employee_file}}" class="btn btn-warning" download rel="noopener noreferrer" target="_blank">
                                            Download File <i class="fas fa-download"></i>
                                        </a>
                                        @else
                                        No Any Files
                                        @endif
                                       </td>
                                      <td style="width: 10px">
                                        @if($trackComplains->status == 1)
                                        <span style="background-color: green;" class="badge bg-warning">Processing</span>
                                        @elseif($trackComplains->status == 3)
                                        <span style="background-color: green;" class="badge badge-danger">Reject</span>
                                        @elseif($trackComplains->status == 2)
                                        <span style="background-color: green;" class="badge badge-success">Done</span>
                                        @elseif($trackComplains->status == 0)
                                        <span style="background-color: green;" class="badge badge-info">Pending</span>
                                        @else
                                        <span style="background-color: green;" class="badge badge-primary">Admin & Employee Done The Complain</span>
                                        @endif
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                @endif
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
