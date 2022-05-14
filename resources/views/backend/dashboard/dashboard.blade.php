@extends('backend.master')

@section('title', 'Admin Dashboard')
@section('dashboard-title', 'Admin Dashboard')
@section('breadcrumb-title', 'Admin Dashboard Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-3">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$totalComplains}}</h3>
              <p>Total Complain</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-3">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$totalActionComplains}}</h3>
              <p>Total Action Taken</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-3">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$totalCancelComplains}}</h3>
              <p>Total Forward Complain</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-3">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$totalForwardComplains}}</h3>
              <p>Total Pending Complain</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('custom_script')


@endsection