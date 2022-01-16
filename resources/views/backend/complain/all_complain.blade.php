@extends('backend.master')

@section('title', 'All Complain List')
@section('dashboard-title', 'All Complain List')
@section('breadcrumb-title', 'All Complain  Information')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />    
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <!-- <h3 class="card-title">All Complains</h3> -->
      <button class="btn btn-info btn-sm float-sm-left" id="archieved_all" style="margin:5px;"><i class="fa fa-check"></i> Archieved</button>
      <!-- <button class="btn btn-info btn-sm float-sm-left" id="active_all" style="margin:5px;"><i class="fa fa-check"></i> Pending <span class="badge badge-dark right">{{$count}}</span></button> -->
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
      <table id="allComplain" class="table table-bordered table-striped">
        <!-- <tr> 
         <th style="text-align: center;" colspan="5">Complainer Information</th> 
         <th style="text-align: center;" colspan="4">Take Action</th> 
        </tr> --> 
        <thead>
          <tr> 
            <th style="width:3%;">#</th>
            <th style="width:3%;">Sl No</th> 
            <th style="width:5%!important;">Name</th>
            <th>Subject</th>
            <th>Admin <br>Action</th>
            <th>Forwarded <br>Action</th>
            <th style="width:3%!important;">Status</th>
            <th style="width:3%!important;">Action</th>
          </tr> 
        </thead> 
        <tbody>
        @foreach($complains as $complain)
          <tr> 
            <td><input type="checkbox" name="complainId[]" value="{{$complain->id}}"></td>
            <td>{{$loop->iteration}}</td> 
            <td>{{$complain->name}} <br>{{$complain->mobile}}</td>
            <td>{!!$complain->reason!!}</td>
            <td>
              @if(!empty($complain->action))
              <span class="badge badge-info">{{strip_tags($complain->action)}}</span>
              @else
               <span class="badge badge-danger">No Action Taken</span>
              @endif
            </td>
            <td>
              @if(!empty($complain->employee_action))
              <span class="badge badge-info">{{strip_tags($complain->employee_action)}}</span>
              @else
               <span class="badge badge-danger">No Action Taken</span>
              @endif
            </td>
            <td>
               @if($complain->status==2)
                <button class="btn btn-success btn-xs">Done</button>
               @elseif($complain->status==1)
                <button class="btn btn-warning btn-xs">Processing</button>
               @elseif($complain->status==3)
                <button class="btn btn-danger btn-xs">Reject</button>
               @elseif($complain->status==0)
                <button class="btn btn-dark btn-xs">Pending</button>
               @endif
            </td> 
            <td>
              @if($complain->status == 0)
              <a href="{{route('view-complain',$complain->id)}}" class="btn btn-success btn-xs">Take Action</a>&nbsp;&nbsp;
              <button id="{{$complain->id}}" data-toggle="modal" data-target=".forward_complain_modal" style="cursor: pointer" class="btn btn-info btn-xs forward_complain_box">Forward</button>
              &nbsp;&nbsp;
              @endif
              <!-- <button id="#" data-toggle="modal" data-target=".forward_complain_modal" style="cursor: pointer" class="btn btn-info btn-xs forward_complain_box">Take Action</button> -->
            </td>
          </tr>
        @endforeach
        </tbody>  
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  <!-- Assign Comment modal -->
  <div class="modal fade forward_complain_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                 <h4 class="modal-title">Request For Forward Complain</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                 </button>
              </div>
              <div class="modal-body">
                  {{--akhane mne rakhte hobe action deye krte lagbe na cause age amra id deye modal box krsi--}}
                  <form id="forward_complain_form" data-parsley-validate=""  method="post">
                      @csrf
                      <select id="employee_id" name="employee_id" class="form-control">                     
                        <option value="">....Forward Name....</option>
                        @foreach($employees as $employee)  
                         <option value="{{$employee->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option> 
                        @endforeach
                      </select>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="button" id="forward_complain" class="btn btn-success"><i class="fa fa-save"></i> Forward Complain</button>
              </div>
          </div>
      </div>
  </div> <!-- / Comment modal -->

  <!-- /.card -->

</section>
@endsection

@section('custom_script')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
  $(function () {
     $("#allComplain").DataTable();
    $(".forward_complain_box").click(function () {
      var id=$(this).attr('id');
      //console.log(id);
      $('#forward_complain_form').attr('action','{{ url('forward-complain/') }}'+'/'+id);
    });

    $("#forward_complain").click(function () {
      //alert('dfd');
      Swal.fire({
          title: 'Are you sure?',
          text: "Are you want to forward the complain!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, forward it!'
      }).then(function(result){
          if (result.value) {
              $('#forward_complain_form').submit();//Order form er name ta
          }
      });
    });
});

  // Archieved all
  $('#archieved_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='complainId[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('archieved/complain') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to archieve this complain?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Archieve'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"complainId": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Archieved This Complain.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Archieved',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Complain First!',
              'error'
          )
      }
  });

</script>
@endsection