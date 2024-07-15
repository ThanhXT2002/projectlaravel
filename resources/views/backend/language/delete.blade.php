@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
    <section class="content mt-2">
        @if ($errors->any())
            <div class="alert bg-maroon alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('language.destroy', $language->id)}}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="text-right mb-2">
                    <button class="btn btn-success rounded-0" type="submit" name="send" value="send"><i class="fas fa-trash"></i> Xóa</button>
                </div>
                <div class="row">
                    <div class="col-lg-4 pl-4"> 
                        <h5 class=""><strong>Thông tin chung</strong></h5>
                        <p class="font-italic"><strong>Lưu ý:</strong> Không thể khôi phục dữ liệu sau khi xóa, chắc chắn bạn muốn xóa thông tin này <strong class="text-danger">(*)</strong></p>                 
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">                       
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Tên ngôn ngữ <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $language->name ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Canonical <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="canonical"
                                                value="{{ old('canonical', $language->canonical ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ảnh đại diện </label>
                                            <input type="text" name="image"
                                                value="{{ old('image', $language->image ?? '') }}"
                                                class="form-control form-control-sm rounded-0 shadow border border-info upload-image" placeholder="" autocomplete="off"
                                                data-upload="Images">
                                        </div>
                                    </div>
                                   
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            var province_id = '{{ isset($language->province_id) ? $language->province_id : old('province_id') }}'
            var district_id = '{{ isset($language->district_id) ? $language->district_id : old('district_id') }}'
            var ward_id = '{{ isset($language->ward_id) ? $language->ward_id : old('ward_id') }}'
        </script>
    </section>
@endsection
