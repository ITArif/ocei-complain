@extends('backend.master')

@section('title', 'All Complain Report')
@section('dashboard-title', 'All Complain Report')
@section('breadcrumb-title', 'All Complain  Information Report')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />    
@endsection

@section('container')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title">
            Date Wise Report Print
          </h3>
        </div>
        <div class="col-md-8 offset-2 mt-2">
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
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{route('complain.report')}}" method="post">
            @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-6" data-select2-id="22">
                            <div class="form-group">
                              <label for="exampleInputFile">From Date</label>
                              <div class="input-group">
                                  <input type="date" name="from_date" id="from_date" class="form-control">
                              </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <label for="exampleInputFile">To Date</label>
                              <div class="input-group">
                                  <input type="date" name="to_date" id="to_date" class="form-control">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                   <!-- <a href="#" class="btn btn-success float-left">Back</a> -->
                   <button type="submit" class="btn btn-primary float-right" style="margin-right: 10px">
                    <span class="fas fa-search"></span>&nbsp;Search
                   </button>
                </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  <!-- ./row -->
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title">
            All Complains Report
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="all-reports" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>SL No</th>
                  <th>Name</th>
                  <th>Complainer's Reason</th>
                  <th>Adnin Taken Action</th>
                  <th>Employee Taken Action</th>
                  <th>Compliner File</th>
                  <th>Admin File</th>
                  <th>Employee File</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                  @foreach($allComplainReports as $allComplainReport)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$allComplainReport->name}} <br>{{$allComplainReport->mobile}}</td>
                    <td>{!!$allComplainReport->reason!!}</td>
                    <td>{!!$allComplainReport->admin_action!!}</td>
                    <td>{!!$allComplainReport->employee_action!!}</td>
                    <td>
                      <a href="/uploads/{{$allComplainReport->complainer_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank"> Download File <i class="fas fa-download"></i>
                       </a>
                    </td>
                    <td>
                      <a href="/uploads/{{$allComplainReport->admin_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank"> Download File <i class="fas fa-download"></i>
                      </a>
                    </td>
                    <td>
                      <a href="/uploads/{{$allComplainReport->employee_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank">Download File <i class="fas fa-download"></i>
                       </a>
                    </td>
                    <td>
                        <button class="btn btn-info btn-xs">Done</button>
                        <a title="Download Report" target="_blank" href="{{ route('admin.generateComplainPdf',$allComplainReport->id) }}" class="badge badge-warning"> <i class="fas fa-file-invoice"></i>Print</a>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
  <!-- ./row -->
</section>
@endsection

@section('custom_script')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
$(function () {
     $("#all-reports").DataTable();
  });
</script>
@endsection