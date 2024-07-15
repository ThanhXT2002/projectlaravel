@extends('backend.layout.layoutadmin')
@section('content')
@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<form action="{{ route('generate.destroy', $generate->id) }}" method="post" class="box">
    @include('backend.layout.component.destroy', ['model' => $generate])
</form>
@endsection