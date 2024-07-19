(function($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    // Định nghĩa hàm tạo menu danh mục trong đối tượng HT
    HT.createMenuCatelogue = () => {
        // Lắng nghe sự kiện submit trên các form có class 'create-menu-catalogue'
        $(document).on('submit', '.create-menu-catalogue', function(e) {
            e.preventDefault() // Ngăn chặn hành vi mặc định của form submit
            let _form = $(this) // Lấy đối tượng form hiện tại

            // Tạo đối tượng option để chứa dữ liệu từ form
            let option = {
                'name': _form.find('input[name=name]').val(), // Lấy giá trị của input name
                'keyword': _form.find('input[name=keyword]').val(), // Lấy giá trị của input keyword
                'token': _token // Giả sử _token đã được định nghĩa ở nơi khác
            }

            // Gửi yêu cầu AJAX
            $.ajax({
                url: 'ajax/menu/createCatalogue', // URL xử lý yêu cầu AJAX
                type: 'POST', // Phương thức gửi dữ liệu
                data: option, // Dữ liệu được gửi
                dataType: 'json', // Kiểu dữ liệu nhận về
                success: function(res) {
                    if (res.code == 0) { // Kiểm tra mã phản hồi
                        // Hiển thị thông báo thành công
                        $('.form-error').removeClass('alert-danger').addClass('alert-success').html(res.message).show()
                        const menuCatalogueSelect = $('select[name=menu_catalogue_id]')
                        menuCatalogueSelect.append('<option value="' + res.data.id + '">' + res.data.name + '</option>')
                    } else {
                        // Hiển thị thông báo lỗi
                        $('.form-error').removeClass('alert-success').addClass('alert-danger').html(res.message).show()
                    }
                },
                beforeSend: function() {
                    // Xóa thông báo lỗi trước khi gửi yêu cầu mới
                    _form.find('.error').html('')
                    _form.find('.form-error')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Xử lý lỗi khi yêu cầu thất bại
                    if (jqXHR.status === 422) { // Kiểm tra mã trạng thái lỗi
                        let errors = jqXHR.responseJSON.errors // Lấy các lỗi từ phản hồi JSON
                        for (let field in errors) {
                            let errorMessage = errors[field] // Lấy thông báo lỗi cho từng trường
                            $('.' + field).html('') // Xóa thông báo lỗi trước đó
                            errorMessage.forEach(function(message) {
                                $('.' + field).html(message) // Hiển thị thông báo lỗi mới
                            })
                        }
                    } else {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown) // Hiển thị lỗi khác
                    }
                }
            })
        })
    }

    // Khi tài liệu đã sẵn sàng, gọi hàm createMenuCatelogue
    $(document).ready(function() {
        HT.createMenuCatelogue()
    })

})(jQuery);