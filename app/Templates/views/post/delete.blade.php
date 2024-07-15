@extends('backend.layout.layoutadmin')
@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        <form action="{{ route('{module}.destroy', ${module}->id) }}" method="post" class="box">
            @include('backend.layout.component.destroy', ['model' => ${module}])
         </form>
    </section>
@endsection