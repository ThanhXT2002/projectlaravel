@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <section class="content mt-4">
       @include('backend.layout.component.formError')
        @php
            $url = $config['method'] == 'create' ? route('menu.store') : route('menu.update', $menu->id);
        @endphp
        <form action="{{ $url }}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight my-2">
                @include('backend.menu.component.catalogue')
                <hr>
                @include('backend.menu.component.list')
            </div>
            @include('backend.layout.component.btnsubmit')
        </form>
        @include('backend.menu.component.popup')
    </section>
@endsection
