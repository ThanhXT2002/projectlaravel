<div class="row">
    <div class="col-lg-4 pl-4">
        <h5 class="text-uppercase text-gray-dark"><strong>Vị trí Menu</strong></h5>
        <p class="mb-0">Website có các vị trí hiển thị cho từng menu</p>
        <p>Hãy lựa chọn các vị trí mà bạn muốn hiển thị cho phù
            hợp. </p>
    </div>
    <div class="col-lg-8">
        <div class="card bg-white shadow-lg rounded-0">
            <div class="card-header">
                <h3 class="card-title font-weight-bold text-muted mt-1">Chọn vị trí hiển thị và kiểu hiển thị Menu <span
                        class="text-danger">(*)</span></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-danger rounded-0" data-toggle="modal"
                        data-target="#createMenuCatalogue">Tạo vị trí hiển thị</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <select name="menu_catalogue_id" class="form-control form-control-sm rounded-0 shadow border border-info select2">
                            <option value="0">[Chọn vị trí hiển thị]</option>
                            @foreach ($menuCatalogues as $key => $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <select name="type" class="form-control form-control-sm rounded-0 shadow border border-info select2">
                            <option value="none">[Chọn kiểu Menu]</option>
                            @foreach (__('module.type') as $key => $val) <!-- Giả sử bạn muốn lấy dữ liệu từ $menuTypes cho kiểu Menu -->
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>