@extends('backend.master')

@section('title', 'View Complain')
@section('dashboard-title', 'View Complain')
@section('breadcrumb-title', 'View Complain')

@section('stylesheets')
    
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">View Complains</h3>
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
    <form action="{{route('update-complain',$complains[0]->id)}}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="row">
        <div class="col-sm-6">
          <!-- text input -->
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{$complains[0]->name}}" readonly>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{$complains[0]->email}}" readonly>
          </div>
        </div>
        <div class="col-sm-6">
          <!-- text input -->
          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="mobile" value="{{$complains[0]->mobile}}" readonly>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Complainer's File</label><br>
            <a href="/uploads/{{$complains[0]->complainer_file}}" class="btn btn-success" download rel="noopener noreferrer" target="_blank">
               Download File <i class="fas fa-download"></i>
            </a>
          </div>
        </div>
         <div class="col-sm-12">
          <div class="form-group">
            <label>Reason</label>
            <textarea class="form-control" name="reason" rows="4" placeholder="Enter ..." readonly>{{strip_tags($complains[0]->reason)}}</textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Your Action :<span id="mark">&nbsp;*</span></label>
            <div class="col-md-12">
              <textarea name="admin_action" id="action" cols="80" data-parsley-minlength="12" ta-parsley-minlength-message="Come on! You need to enter at least a 6 character comment..">{{$complains[0]->action}}
              </textarea>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Status</label>
            <select id="status" name="status" class="form-control select2bs4">                     
                <option value="mensuelle">---Select Status---</option>  
                <option value="1" @if (($complains[0]->status) == 1) {{ 'selected' }} @endif>Processing</option> 
                <option value="3" @if (($complains[0]->status) == 3) {{ 'selected' }} @endif>Reject</option> 
                <option value="2" @if (($complains[0]->status) == 2) {{ 'selected' }} @endif>Done</option> 
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <label>File Upload<span style="color:red;font-size: 14px;" id="mark">&nbsp;(pdf,jpg,png)</span></label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="admin_file" id="admin_file">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
              <span class="input-group-text" id="">Upload</span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Show Cause</label>
            <select id="showcause_employee_id" name="showcause_employee_id" class="form-control select2bs4">                     
              <option value="">....Show Cause....</option>
              @foreach($employees as $employee)
               <option value="{{$employee->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Forwared</label>
            <select id="employee_id" name="employee_id" class="form-control select2bs4">                     
              <option value="">....Forward Name....</option>  
               @foreach($employees as $employee)
               <option value="{{$employee->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="card-footer">
       <a href="{{route('all-complain')}}" class="btn btn-success float-left">Back</a>
       <button id="buttonSearch" type="submit" class="btn btn-primary float-right" style="margin-right: 10px">
        <span class="fas fa-search"></span>&nbsp;Submit
       </button> 
    </div>
    <!-- /.card-body -->
  </form>
  </div>

  <!-- /.card -->

</section>
@endsection

@section('custom_script')
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
  $(function() {
      CKEDITOR.replace( 'action' );
      bsCustomFileInput.init();
      //Initialize Select2 Elements
      $('.select2bs4').select2({
          theme: 'bootstrap4'
      })
  })

</script>
@endsection