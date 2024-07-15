@extends('backend.layout.layoutadmin')
@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['create']['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        @php
            $url =
                $config['method'] == 'create' ? route('permission.store') : route('permission.update', $permission->id);
        @endphp
        <form action="{{ $url }}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-4 pl-4">
                        <h5 class=""><strong>Thông tin chung</strong></h5>
                        <p>Nhập thông tin chung của quyền</p>
                        <p class="font-italic"><strong>Lưu ý:</strong> Những trường đánh dấu <span
                                class="text-danger">(*)</span>
                            là bắt buộc</p>
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tiêu đề<span
                                                class="text-danger">(*)</span></label>
                                        <input type="text" name="name"
                                            value="{{ old('name', $permission->name ?? '') }}"class="form-control form-control-sm rounded-0 shadow border border-info"
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Canonical <span
                                                class="text-danger">(*)</span></label>
                                        <input type="text" name="canonical"
                                            value="{{ old('canonical', $permission->canonical ?? '') }}"
                                            class="form-control form-control-sm rounded-0 shadow border border-info"
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    
                    <div class="mr-2">
                        <a href="{{route('permission.index')}}" class="btn btn-info rounded-0">Trở lại</a>
                    </div>
                    <div class="pr-1 start-end">
                        <a href="{{ route('user.catalogue.permission') }}" class="btn bg-orange d-flex align-items-center rounded-0 " style="width:160px"><i class="fa fa-key mr-4"></i>{{ __('messages.btnPermission') }}</a>
                    </div>
                    @include('backend.layout.component.btnsubmit')  
                </div>

                              
            </div>
        </form>
    </section>
@endsection
