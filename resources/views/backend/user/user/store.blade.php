@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
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
        @php
            $url = $config['method'] == 'create' ? route('user.store') : route('user.update', $user->id);
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
                        <p>Nhập thông tin chung của người sử dụng</p>
                        <p class="font-italic"><strong>Lưu ý:</strong> Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>                 
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body bg-white shadow-lg">                       
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Email <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="email"
                                                value="{{ old('email', $user->email ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Họ Tên <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name"
                                                value="{{ old('name', $user->name ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $userCatalogue = ['[Chọn nhóm thành viên]', 'Quản trị viên', 'Cộng tác viên'];

                                @endphp
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-row  ">
                                            <label for="" class="control-label text-left">Nhóm Thành viên <span class="text-danger">(*)</span></label>
                                                <select name="user_catalogue_id" class="form-control form-control-sm rounded-0 border border-info select2 shadow" style="box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;">
                                                    @foreach ($userCatalogues as $catalogue)
                                                        <option value="{{ $catalogue->id }}" {{ isset($user) && $user->user_catalogue_id == $catalogue->id ? 'selected' : '' }}>
                                                            {{ $catalogue->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ngày sinh </label>
                                            <input type="date" name="birthday"
                                                value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d', strtotime($user->birthday)) : '') }}"
                                                class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                @if ($config['method'] == 'create')
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-row">
                                                <label for="" class="control-label text-left">Mật khẩu <span
                                                        class="text-danger">(*)</span></label>
                                                <input type="password" name="password" value="" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                    placeholder="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-row">
                                                <label for="" class="control-label text-left">Nhập lại mật khẩu
                                                    <span class="text-danger">(*)</span></label>
                                                <input type="password" name="re_password" value=""
                                                    class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Ảnh đại diện </label>
                                            <input type="text" name="image"
                                                value="{{ old('image', $user->image ?? '') }}"
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
                        <div class="panel-description">Nhập thông tin liên hệ của người sử dụng</div>   
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
                                            value="{{ old('addresss', $user->address ?? '') }}"
                                            class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Số điện thoại</label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone', $user->phone ?? '') }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ghi chú</label>
                                        <input type="text" name="description"
                                            value="{{ old('description', $user->description ?? '') }}"
                                            class="form-control form-control-sm rounded-0 shadow border border-info" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-success rounded-0" type="submit" name="send" value="send">Lưu lại</button>
                </div>
            </div>
        </form>

        <script>
            var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}'
            var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}'
            var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}'
        </script>
    </section>
@endsection
