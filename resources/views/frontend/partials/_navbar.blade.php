<div class="row">
    <div class="col-xs-12 padding-lr0">
        <!-- Fixed navbar -->
        <nav id="header" class="navbar custom-navbar"> <!--  navbar-fixed-top -->
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <button type="button"
                            class="navbar-toggle collapsed "
                            data-toggle="collapse"
                            data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="brand" class="navbar-brand visible-xs" href="#">
                        <img style="margin-right: 10px" class="pull-left"
                             src="{{asset('frontend/assets/img/logo.png')}}" alt="গণপ্রজাতন্ত্রী বাংলাদেশ">
                        <div class="pull-left">
                            <h4 class="logo-title">OCEI</h4>
                        </div>
                    </a>
                </div>

                <div id="navbar" class="collapse navbar-collapse">
                    <a class="logo-fixed-top clearfix pull-left" href="#">
                        <img style="margin-right: 10px" class="pull-left"
                             src="{{asset('frontend/echallan/assets/img/logo.png')}}" alt="গণপ্রজাতন্ত্রী বাংলাদেশ">
                        <div class="pull-left hidden-sm">
                            <h4 class="logo-title">OCEI</h4>
                        </div>
                    </a>

                    <ul class="nav navbar-nav pull-left">
                        <li class="active">
                            <!-- <a href="#"><i class="fa fa-home"></i>Track Your Complain</a> -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                              <i class="fa fa-home"></i> Track My Complain
                            </button>
                        </li>
                        <!-- <li class="">
                            <a href="javascript:void(0);">Appeal</a>
                        </li> -->
                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
    </div>
</div>

<!-- Modal -->
<!-- Assign Comment modal -->
<div class="modal fade forward_complain_modal" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <!-- <h4 class="modal-title">Track Complain</h4> -->
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
         </button>
      </div>
      <div class="modal-body">
          {{--akhane mne rakhte hobe action deye krte lagbe na cause age amra id deye modal box krsi--}}
          <form action="{{route('track.complain')}}" id="forward_complain_form" data-parsley-validate=""  method="post">
            @csrf
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Mobile Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Tracking Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Tracking Number">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Track Complain</button>
            </div>  
          </form>
      </div>
    </div>
  </div>
</div> <!-- / Comment modal -->