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
        <form action="{{route('menu.destroy', $menu->id)}}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="text-right mb-2">
                    <button class="btn btn-success rounded-0" type="submit" name="send" value="send"><i class="fas fa-trash"></i> Xóa</button>
                </div>
                <div class="row">
                    <div class="col-lg-4 pl-4"> 
                        <h5 class=""><strong>Thông tin chung</strong></h5>
                        <p class="font-italic"><strong>Lưu ý:</strong> Không thể khôi phục thành viên sau khi xóa, chắc chắn bạn muốn xóa thông tin này <strong class="text-danger">(*)</strong></p>                 
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">                       
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Email <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="email"
                                                value="{{ old('email', $menu->email ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Họ Tên <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $menu->name ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $menuCatalogue = ['[Chọn nhóm thành viên]', 'Quản trị viên', 'Cộng tác viên'];

                                @endphp
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row  ">
                                            <label for="" class="control-label text-left">Nhóm Thành viên <span
                                                    class="text-danger">(*)</span></label>
                                            <select name="menu_catalogue_id" class="form-control form-control-sm rounded-0  border border-info select2 shadow" style="box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;">
                                                @foreach ($menuCatalogue as $key => $item)
                                                    <option
                                                        {{ $key == old('menu_catalogue_id', isset($menu->menu_catalogue_id) ? $menu->menu_catalogue_id : '') ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ngày sinh </label>
                                            <input type="date" name="birthday"
                                                value="{{ old('birthday', isset($menu->birthday) ? date('Y-m-d', strtotime($menu->birthday)) : '') }}"
                                                class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ảnh đại diện </label>
                                            <input type="text" name="image"
                                                value="{{ old('image', $menu->image ?? '') }}"
                                                class="form-control form-control-sm rounded-0 shadow border border-info upload-image" placeholder="" autocomplete="off"
                                                data-upload="Images">
                                        </div>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 pl-4 mb-2"> 
                        <div class="h5 font-weight-bold">Thông tin liên hệ</div>
                        
                    </div>
                    <div class="col-lg-8">                       
                        <div class="card-body bg-white shadow-lg ">
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Thành Phố</label>
                                        <select name="province_id" class="form-control form-control-sm rounded-0 shadow border border-info select2 province location"
                                            data-target="districts">
                                            <option value="0">[Chọn Thành Phố]</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $province)
                                                    <option @if (old('province_id') == $province->code) selected @endif
                                                        value="{{ $province->code }}">{{ $province->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Quận/Huyện </label>
                                        <select name="district_id"
                                            class="form-control form-control-sm rounded-0 shadow border border-info districts select2 districts location" data-target="wards">
                                            <option value="0">[Chọn Quận/Huyện]</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Phường/Xã </label>
                                        <select name="ward_id" class="form-control form-control-sm rounded-0 shadow border border-info select2 wards">
                                            <option value="0">[Chọn Phường/Xã]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Địa chỉ </label>
                                        <input type="text" name="address"
                                            value="{{ old('addresss', $menu->address ?? '') }}"
                                            class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Số điện thoại</label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone', $menu->phone ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ghi chú</label>
                                        <input type="text" name="description"
                                            value="{{ old('description', $menu->description ?? '') }}"
                                            class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-success rounded-0" type="submit" name="send" value="send"><i class="fas fa-trash"></i> Xóa</button>
                </div>
            </div>
        </form>

        <script>
            var province_id = '{{ isset($menu->province_id) ? $menu->province_id : old('province_id') }}'
            var district_id = '{{ isset($menu->district_id) ? $menu->district_id : old('district_id') }}'
            var ward_id = '{{ isset($menu->ward_id) ? $menu->ward_id : old('ward_id') }}'
        </script>
    </section>
@endsection
