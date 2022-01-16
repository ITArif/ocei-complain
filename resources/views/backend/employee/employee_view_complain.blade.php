@extends('backend.master')

@section('title', 'View Complain Info')
@section('dashboard-title', 'View Complain Info')
@section('breadcrumb-title', 'View Complain Info')

@section('stylesheets')
    
@endsection

@section('container')
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">View Complains Info</h3>
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
    <form action="{{route('employee-update-complain',$complains[0]->id)}}" method="post" enctype="multipart/form-data">
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
        <div class="col-sm-3">
          <div class="form-group">
            <label>Complainer's File</label><br>
            <a href="/uploads/{{$complains[0]->complainer_file}}" class="btn btn-success" download rel="noopener noreferrer" target="_blank">
               Download File <i class="fas fa-download"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Admin's File</label><br>
            <a href="/uploads/{{$complains[0]->admin_file}}" class="btn btn-warning" download rel="noopener noreferrer" target="_blank">
               Download File <i class="fas fa-download"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Complainer's Reason</label>
            <textarea class="form-control" name="reason" rows="2" placeholder="Enter ..." readonly>{{strip_tags($complains[0]->reason)}}</textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Admin's Action</label>
            <textarea class="form-control" name="admin_action" rows="4" placeholder="Enter ..." readonly>{{strip_tags($complains[0]->action)}}</textarea>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Your Action :<span id="mark">&nbsp;*</span></label>
            <div class="col-md-12">
              <textarea name="employee_action" id="employee_action" cols="80"
                      data-parsley-minlength="12"
                      data-parsley-minlength-message="Come on! You need to enter at least a 6 character comment..">{{$complains[0]->employee_action}}
            </textarea>
          </div>
        </div>
      </div>
      <!-- <div class="col-sm-6">
        <div class="form-group">
          <label>Status</label>
          <select readonly id="status" name="status" class="form-control select2bs4">                     
              <option value="mensuelle">---Select Status---</option>  
              <option value="{{$complains[0]->status}}" @if (($complains[0]->status) == 1) {{ 'selected' }} @endif>Reviewed</option> 
              <option value="{{$complains[0]->status}}" @if (($complains[0]->status) == 3) {{ 'selected' }} @endif>Cancel</option> 
              <option value="{{$complains[0]->status}}" @if (($complains[0]->status) == 0) {{ 'selected' }} @endif>Pending</option> 
              <option value="{{$complains[0]->status}}" @if (($complains[0]->status) == 2) {{ 'selected' }} @endif>Forward</option> 
          </select>
        </div>
      </div> -->
      <div class="col-sm-12">
        <label>File Upload<span style="color:red;font-size: 14px;" id="mark">&nbsp;(pdf,jpg,png)</span></label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="employee_file" id="employee_file">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>
    </div><br>
    <div class="card-footer">
       <a href="{{route('forward-complain')}}" class="btn btn-success float-left">Back</a>
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
      CKEDITOR.replace('employee_action');
      bsCustomFileInput.init();
      //Initialize Select2 Elements
      $('.select2bs4').select2({
          theme: 'bootstrap4'
      })
  })
</script>
@endsection