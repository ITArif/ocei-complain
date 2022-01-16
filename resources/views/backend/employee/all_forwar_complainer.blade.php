@extends('backend.master')

@section('title', 'All Forward Complainer List')
@section('dashboard-title', 'All Forward Complainer List')
@section('breadcrumb-title', 'All Forward Complainer  Information')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" /> 
@endsection
@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      
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
      <table id="allForwardedComplains" class="table table-bordered table-striped">
        <thead>
          <tr> 
            <th style="width:3%;">Sl No</th> 
            <th style="width:7%;">Name</th>
            <th>Complainer's Reason</th> 
            <th>Adnin Taken Action</th> 
            <th style="width:15%;">Status</th>
            <th style="width:3%;">Action</th>
          </tr> 
        </thead>
        <tbody>
          @foreach($forwardingComplains as $forwardingComplain)
          <tr> 
            <td>{{$loop->iteration}}</td> 
            <td>{{$forwardingComplain->name}}<br>{{$forwardingComplain->email}}<br>{{$forwardingComplain->mobile}}</td>
            <td>{!!$forwardingComplain->reason!!}</td>
            <td>{!!$forwardingComplain->action!!}</td>
            <td>
              @if($forwardingComplain->status == 2)
              <button class="badge badge-info">Done</button>
              @elseif($forwardingComplain->status == 4)
               <button class="badge badge-success">Already Done In Archieved</button>
              @else
              <button class="badge badge-warning">Processing</button>
              @endif
            </td> 
            <td>
              @if($forwardingComplain->status == 1)
              <a href="{{route('employee-view-complain',$forwardingComplain->id)}}" class="btn btn-success btn-xs">Take Action</a>
              @endif
            </td>
          </tr>
          @endforeach 
        </tbody> 
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
@endsection

@section('custom_script')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
  $(function () {
     $("#allForwardedComplains").DataTable();
  });
</script>
@endsection