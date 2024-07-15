@php
$segment = request()->segment(1);
$currentRoute = Route::currentRouteName();
@endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="backend/img/logo/logo-prettyeyes.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><h5>PRETTY-EYES</h5></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
          <img class="img-circle elevation-2 img-cover-circle" src="{{ auth()->check() && auth()->user()->image ? auth()->user()->image : asset('backend/img/no-img.png') }}" >
        </div>
        <div class="info">
          <a href="#" class="d-block h5 "><strong>{{Auth::user()->name }}</strong></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard.index')}}" class="nav-link {{($segment == 'dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>         
          @foreach(__('sidebar.module') as $key => $val)
          <li class="nav-item {{ (in_array($segment, $val['name'])) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (in_array($segment, $val['name'])) ? 'active' : '' }}">
                  <i class="{{ $val['icon'] }} nav-icon"></i>
                  <p>
                      {{ $val['title'] }}
                      <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              @if(isset($val['subModule']))
                  <ul class="nav nav-treeview">
                      @foreach($val['subModule'] as $module)
                          <li class="nav-item">
                              <a href="{{ route($module['route']) }}" class="nav-link {{ Request::routeIs($module['route']) ? 'active' : '' }}">
                                  <i class="{{ $module['icon'] }} nav-icon ml-3"></i>
                                  <p>{{ $module['title'] }}</p>
                              </a>
                          </li>
                      @endforeach
                  </ul>
              @endif
          </li>
      @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>