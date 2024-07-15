<div class="row">
    <div class="col-lg-4 pl-4 mb-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card-title font-weight-bold text-muted mt-1">Liên kết Menu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 font-weight-bold" data-toggle="collapse" href="#collapseOne">
                                    Liên kết tự tạo
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-gray-dark">Tạo Menu</h5>
                                <p class="mb-1">Cài đặt Menu mà bạn muốn hiển thị</p>
                                <p class="text-danger mb-1 font-weight-bold">Lưu ý:</p>
                                <ol class="text-danger font-italic text-justify">
                                    <li>Khi khởi tạo menu bạn phải chắc chắn rằng đường dẫn của menu có hoạt động. Đường
                                        dẫn trên website được khởi tạo tại các module: Bài viết, Sản phẩm, Dự án..v.v..
                                    </li>
                                    <li>Tiêu đề và đường dẫn của menu không được để trống.</li>
                                    <li>Hệ thống chỉ hỗ trợ tối đa 5 cấp menu</li>
                                </ol>
                                <a href="" class="btn btn-sm btn-outline-primary rounded-0 w-100">Thêm đường dẫn</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 font-weight-bold" data-toggle="collapse" href="#collapseTwo">
                                    Nhóm bài viết
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid.
                                3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt
                                laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee
                                nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft
                                beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 font-weight-bold " data-toggle="collapse" href="#collapseThree">
                                    Bài viết
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid.
                                3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt
                                laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                coffee
                                nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                craft
                                beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                accusamus
                                labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card-title font-weight-bold text-muted mt-1">Cấu hình Menu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4"><Label>Tên Menu</Label></div>
                <div class="col-lg-6"><label for="">Đường dẫn</label></div>
                <div class="col-lg-1 text-center"><label for="">Vị trí</label></div>
                <div class="col-lg-1  text-center"><label for="">Xóa</label></div>
              </div>
              <hr class="border border-1 border-info">
              <div class="menu-wrapper">
                <div class="notification text-center mt-2">
                    <h5>Danh sách kiên kết này chưa có bất kỳ đường dẫn nào.</h5>
                    <p>Hãy nhấn vào <span class="text-info">"Thêm đường dẫn"</span> để bắt đầu thêm.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <input type="text" name="menu[name][]" value="" class="form-control form-control-sm rounded-0">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="menu[canonocal][]" value="" class="form-control form-control-sm rounded-0">
                    </div>
                    <div class="col-lg-1">
                        <input type="text" name="menu[order][]" value="" class="form-control form-control-sm rounded-0">
                    </div>
                    <div class="col-lg-1 text-center">
                        <div class="btn btn-info btn-sm"><i class="fas fa-trash"></i></div>
                    </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
