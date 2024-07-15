@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['index']['title']])
    <!-- Main content -->
    <section class="content mt-2">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $config['seo']['index']['table'] }}</h3>
                @include('backend.layout.component.toolbox')
            </div>
            @include('backend.user.catalogue.component.filter')
            @include('backend.user.catalogue.component.table')
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
