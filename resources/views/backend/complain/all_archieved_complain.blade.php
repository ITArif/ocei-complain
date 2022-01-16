@extends('backend.master')

@section('title', 'All Archieved Complain List')
@section('dashboard-title', 'All Archieved Complain List')
@section('breadcrumb-title', 'All Archieved Complain Information')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" /> 
@endsection
@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">All Archieved Complains</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="allArchived" class="table table-bordered table-striped">
        <thead>
          <tr> 
            <th>Sl No</th> 
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
          @foreach($allArchievedComplains as $allArchievedComplains)
          <tr> 
            <td>{{$loop->iteration}}</td> 
            <td>{{$allArchievedComplains->name}} <br>{{$allArchievedComplains->mobile}}</td>
            <td>{!!$allArchievedComplains->reason!!}</td>
            <td>{!!$allArchievedComplains->admin_action!!}</td>
            <td>{!!$allArchievedComplains->employee_action!!}</td>
            <td>
              <a href="/uploads/{{$allArchievedComplains->complainer_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank">
                 Download File <i class="fas fa-download"></i>
              </a>
            </td>
            <td>
              <a href="/uploads/{{$allArchievedComplains->admin_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank">
                 Download File <i class="fas fa-download"></i>
              </a>
            </td>
            <td>
              <a href="/uploads/{{$allArchievedComplains->employee_file}}" class="btn btn-success btn-xs" download rel="noopener noreferrer" target="_blank">
                 Download File <i class="fas fa-download"></i>
              </a>
            </td>
            <td>
               @if($allArchievedComplains->status==2)
                <button class="btn btn-info btn-xs">Forward by admin</button>
               @elseif($allArchievedComplains->status==1)
                <button class="btn btn-success btn-xs">Reviewed</button>
                @elseif($allArchievedComplains->status==3)
                <button class="btn btn-danger btn-xs">Cancel</button>
                @elseif($allArchievedComplains->status==0)
                <button class="btn btn-dark btn-xs">Cancel</button>
                @elseif($allArchievedComplains->status==4)
                <button class="btn btn-info btn-xs">Done</button>
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
     $("#allArchived").DataTable();
  });
</script>
@endsection