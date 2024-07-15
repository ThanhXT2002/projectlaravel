<!-- jQuery -->
<script src="backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="backend/js/pages/dashboard.js"></script>




@if(isset($config['js']) && is_array($config['js']))
@foreach ($config['js']  as $key => $val) 
{!!'<script src="'.$val.'"></script>'!!}
@endforeach
@endif
<!-- AdminLTE App -->
<script src="backend/js/adminlte.js"></script>

<script src="backend/js/customize.js"></script>

@if(isset($config['script']))
<script>
@foreach($config['script'] as $script)
    {!! $script !!}
@endforeach
</script>
@endif
<script src="backend/library/library.js"></script>
