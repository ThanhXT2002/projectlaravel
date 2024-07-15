<!DOCTYPE html>
<html>

<head>
    @include('backend.layout.component.head')
   
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed" style="height: auto;">
    <div id="wrapper">
            @include('backend.layout.component.nav')
            @include('backend.layout.component.sidebar')
            
            
            <div class="content-wrapper">
                @yield('content')
            </div>
            
            @include('backend.layout.component.footer')
          
    </div>
    @include('backend.layout.component.scripts')
   
</body>

</html>
