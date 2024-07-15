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
        <form action="{{route('user.catalogue.destroy', $userCatalogue->id)}}" method="post" class="box">
            @csrf
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
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
                                            <label for="" class="control-label text-left">Tên nhóm <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name" readonly
                                            value="{{ old('name', ($userCatalogue->name) ?? '' ) }}" class="form-control form-control-sm rounded-0 shadow border border-info"
                                                placeholder="" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Trạng thái</label>
                                        
                                            <select name="publish" id="" disabled class="form-control form-control form-control-sm rounded-0 shadow border border-info">
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
                                            name="description" readonly
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
