<base href="{{env('APP_URL')}}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content = "{{csrf_token()}}">
<title>    
  Admin PrettyEyes
</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  

  <link rel="stylesheet" href="backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="backend/plugins/daterangepicker/daterangepicker.css">
<!-- Theme style -->
<link rel="stylesheet" href="backend/css/adminlte.min.css">
<link rel="stylesheet" href="backend/css/customize.css">

@if(isset($config['css']) && is_array($config['css']))
@foreach ($config['css']  as $key => $val) 
{!!'<link rel="stylesheet" href="'.$val.'"></link>'!!}
@endforeach

@endif
  <script>
    var BASE_URL = "{{config('app.url')}}"
    var SUFFIX = "{{ config('apps.general.suffix')}}"

</script>






