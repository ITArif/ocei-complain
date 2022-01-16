<aside class="main-sidebar elevation-4 sidebar-light-teal">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">
    <img src="{{asset('images/logo.png')}}" style="width:240px;" alt="">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @if(Session::get('page')=="dashboard")
          <?php $active="active"; ?>
        @else
          <?php $active=""; ?>
        @endif
        <li class="nav-item has-treeview">
          <a href="{{route('dashboard')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        @if(Session::get('page')=="all-complain")
            <?php $active="active"; ?>
        @else
            <?php $active=""; ?>
        @endif
        @if(session('role_id') == 10 || session('role_id') == 1)
        <li class="nav-item has-treeview">
            <a href="{{route('all-complain')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                All Complain
             </p>
            </a>
          </li>
          @endif

        @if(Session::get('page')=="archieved-complain")
            <?php $active="active"; ?>
        @else
            <?php $active=""; ?>
        @endif
        @if(session('role_id') == 10 || session('role_id') == 1)
          <li class="nav-item has-treeview">
            <a href="{{route('all-archieved')}}" class="nav-link {{$active}}">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Archived Complain
             </p>
            </a>
          </li>
          @endif


          @if(Session::get('page')=="forwar-complain")
            <?php $active="active"; ?>
          @else
            <?php $active=""; ?>
          @endif
          @if(session('role_id') == 9)
          <li class="nav-item has-treeview">
            <a href="{{route('forward-complain')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Complain Info
              </p>
            </a>
          </li>
          @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
