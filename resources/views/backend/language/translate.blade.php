@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        <form action="{{ route('language.storeTranslate') }}" method="post" class="box">
            @csrf
            <input type="hidden" name="option[id]" value="{{ $option['id'] }}">
            <input type="hidden" name="option[languageId]" value="{{ $option['languageId'] }}">
            <input type="hidden" name="option[model]" value="{{ $option['model'] }}">
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-6 connectedSortable ui-sortable mb-3">
                        @include('backend.layout.component.content', ['model' => ($object) ?? null, 'disabled' => 1])
                        @include('backend.layout.component.seo',  ['model' => ($object) ?? null, 'disabled' => 1])
                    </div>
                    <div class="col-lg-6 connectedSortable ui-sortable">
                        @include('backend.layout.component.translate', ['model' => ($objectTransate) ?? null])
                        @include('backend.layout.component.seoTranslate',  ['model' => ($objectTransate) ?? null])

                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="mr-2">
                        <a href="{{route('post.catalogue.index')}}" class="btn bg-purple rounded-0">Đi đến danh sách loại bài viết</a>
                    </div>
                    <div class="mr-2">
                        <a href="{{route('post.index')}}" class="btn btn-info rounded-0">Trở lại danh sách bài viết</a>
                    </div>
                    @include('backend.layout.component.btnsubmit')  
                </div>
            </div>
        </form>
    </section>
@endsection
