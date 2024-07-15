@extends('backend.layout.layoutadmin')
@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['create']['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        @php
            $url = $config['method'] == 'create' ? route('generate.store') : route('generate.update', $generate->id);
        @endphp
        <form action="{{ $url }}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-4 pl-4">
                        <h5 class=""><strong>Thông tin chung</strong></h5>
                        <p>Nhập thông tin chung của module</p>
                        <p class="font-italic"><strong>Lưu ý:</strong> Những trường đánh dấu <span
                                class="text-danger">(*)</span>
                            là bắt buộc</p>
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">
                            <div class="row mb-3">
                                <div class="col-lg-6">

                                    <label for="" class="control-label text-left">Tên module<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" 
                                        name="name"
                                        value="{{ old('name', $generate->name ?? '') }}"
                                        class="form-control form-control-sm rounded-0 shadow border border-info"
                                        placeholder="" autocomplete="off">

                                </div>
                                <div class="col-lg-6">

                                    <label for="" class="control-label text-left">Loại module<span
                                            class="text-danger">(*)</span></label>
                                    <select name="module_type" id="" class="form-control  form-control-sm select2">
                                        <option value="0">Chọn Loại Module</option>
                                        <option value="catalogue">Module danh mục</option>
                                        <option value="detail">Module chi tiết</option>
                                        <option value="difference">Module khác</option>
                                    </select>

                                </div>
                               
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">

                                    <label for="" class="control-label text-left">Schema<span
                                            class="text-danger">(*)</span></label>
                                    <textarea name="schema" value="{{ old('schema', $generate->schema ?? '') }}" 
                                        class="form-control rounded-0 shadow border border-info schema"></textarea>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
