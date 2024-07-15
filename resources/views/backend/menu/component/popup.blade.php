<div class="modal fade" id="createMenuCatalogue">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600 text-gray-dark">Thêm vị trí hiển thị của menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 mb-3">
                    <form action="" method="post">
                        <label for="" class="control-label text-left">Tên vị trí hiển thị<span
                                class="text-danger">(*)</span></label>
                        <input type="text" name="name" value="{{ old('menu', $menu->name ?? '') }}"
                            class="form-control form-control-sm rounded-0 shadow border border-info" placeholder=""
                            autocomplete="off">
                </div>
                <div class="col-lg-12">
                    <label for="" class="control-label text-left">Từ khóa </label>
                    <input type="text" name="name" value="{{ old('menu', $menu->name ?? '') }}"
                        class="form-control form-control-sm rounded-0 shadow border border-info" placeholder=""
                        autocomplete="off">
                </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm rounded-0 "
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-outline-success rounded-0">Lưu lại</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>