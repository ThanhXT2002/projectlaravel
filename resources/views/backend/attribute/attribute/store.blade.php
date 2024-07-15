@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        @php
             $url = ($config['method'] == 'create') ? route('attribute.store') : route('attribute.update', $attribute->id);
        @endphp
        <form action="{{ $url }}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-9 connectedSortable ui-sortable mb-3">
                        @include('backend.layout.component.content', ['model' => ($attribute) ?? null])
                        @include('backend.layout.component.album', ['model' => ($attribute) ?? null])
                        @include('backend.layout.component.seo', ['model' => ($attribute) ?? null])
                    </div>
                    <div class="col-lg-3 connectedSortable ui-sortable">
                        @include('backend.attribute.attribute.component.aside')

                    </div>
                </div>
                @include('backend.layout.component.btnsubmit')
            </div>
        </form>
    </section>
@endsection
