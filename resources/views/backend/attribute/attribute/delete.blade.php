@extends('backend.layout.layoutadmin')
@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        <form action="{{ route('attribute.destroy', $attribute->id) }}" method="post" class="box">
            @include('backend.layout.component.destroy', ['model' => $attribute])
         </form>
    </section>
@endsection