@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        @php
            $url =
                $config['method'] == 'create'
                    ? route('post.catalogue.store')
                    : route('post.catalogue.update', $postCatalogue->id);
        @endphp
        <form action="{{ $url }}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-9 connectedSortable ui-sortable mb-3">
                        @include('backend.layout.component.content', ['model' => $postCatalogue ?? null])
                        @include('backend.layout.component.album', ['model' => $postCatalogue ?? null])
                        @include('backend.layout.component.seo', ['model' => $postCatalogue ?? null])
                    </div>
                    <div class="col-lg-3 connectedSortable ui-sortable">
                        @include('backend.post.catalogue.component.aside')

                    </div>
                </div>
                @include('backend.layout.component.btnsubmit')
            </div>
        </form>
    </section>
@endsection
