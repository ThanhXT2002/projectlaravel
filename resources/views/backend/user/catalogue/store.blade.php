@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        @php
            $url = $config['method'] == 'create' ? route('user.catalogue.store') : route('user.catalogue.update', $userCatalogue->id);
        @endphp
        <form action="{{$url}}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="text-right mb-2">
                    <button class="btn btn-success rounded-0" type="submit" name="send" value="send">Lưu lại</button>
                </div>
                <div class="row">
                    <div class="col-lg-4 pl-4"> 
                        <h5 class=""><strong>Thông tin chung</strong></h5>
                        <p class="font-italic"><strong>Lưu ý:</strong> Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>                 
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">                       
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Tên nhóm <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name"
                                            value="{{ old('name', ($userCatalogue->name) ?? '' ) }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Trạng thái</label>
                                        
                                            <select name="publish" id="" class="form-control form-control form-control-sm rounded-0 shadow border border-info">
                                                <option value="2" {{ old('publish', isset($userCatalogue) ? $userCatalogue->publish : '') == '2' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="1" {{ old('publish', isset($userCatalogue) ? $userCatalogue->publish : '') == '1' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ghi chú</label>
                                            <textarea type="text" 
                                            name="description"
                                            class="form-control form-control-sm rounded-0 shadow border border-info h-box-area"
                                                placeholder="" autocomplete="off">{{ old('description', ($userCatalogue->description) ?? '' ) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                              
                        </div>
                    </div>
                </div>
               
            </div>
        </form>
    </section>
@endsection
