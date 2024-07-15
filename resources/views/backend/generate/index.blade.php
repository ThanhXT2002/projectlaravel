@extends('backend.layout.layoutadmin')
@section('content')
@include('backend.layout.component.breadcrumb', ['title' => $config['seo']['index']['title']])
<section class="content mt-2">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $config['seo']['index']['table'] }}</h3>
        </div>
        @include('backend.generate.component.filter')
        @include('backend.generate.component.table')
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection

