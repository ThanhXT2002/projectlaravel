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
                    // _form.find('.form-error')
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


    HT.createMenuRow = () =>{
        $(document).on('click', '.add-menu', function(e) {
            e.preventDefault() 
            let _this = $(this) 
            $('.menu-wrapper').append(HT.menuRowHtml()).find('.notification').hide()
        })
    }

    HT.menuRowHtml = ()=>{
        let html
        let $row  = $('<div>').addClass('row mb-3 menu-item')
        const colums = [
            {class: 'col-lg-4', name: 'menu[name][]'},
            {class: 'col-lg-6', name: 'menu[canonical][]'},
            {class: 'col-lg-1', name: 'menu[order][]', value: 0},
            

        ]

        colums.forEach(col=>{
            let $col = $('<div>').addClass(col.class)
            let $input = $('<input>').attr('type', 'text')
                        .addClass('form-control form-control-sm rounded-0' +((col.name == 'menu[order][]') ? 'int text-right' : ''))
                        .attr('name', col.name)
                        .attr('value', col.value)
            $col.append($input)
            $row.append($col)
        })

        let $removeCol = $('<div>').addClass('col-lg-1 text-center')
        let $a = $('<a>').addClass('delete-menu btn btn-info btn-sm')
        let $i = $('<i>').addClass('fas fa-trash')
        $a.append($i)
        $removeCol.append($a)
        $row.append($removeCol)

        return $row
    }

    HT.deleteMenuRow = ()  =>{
            $(document).on('click', '.delete-menu', function(){
                let _this = $(this)
                _this.parents('.menu-item').remove()
                HT.checkMenuItemLangth()
            })
    }

    HT.checkMenuItemLangth = () =>{
        if($('.menu-item').length === 0){
            $('.notification').show()
        }
    }

    HT.getMenu = () =>{
        $(document).on('click', '.menu-module', function(){
            let _this = $(this)
            let option = {
                model: _this.attr('data-model')
            }

            $.ajax({
                url: 'ajax/dashboard/getMenu', // URL xử lý yêu cầu AJAX
                type: 'GET', // Phương thức gửi dữ liệu
                data: option, // Dữ liệu được gửi
                dataType: 'json', // Kiểu dữ liệu nhận về
                beforSend: function(){
                    _this.parents('card').find('.menu-list').html('')
                },
                success: function(res) {
                   let html = ''
                   for(let i = 0; i < res.data.length; i++){
                    html += HT.renderModelMenu(res.data[i])
                   }
                   _this.parents('card').find('.menu-list').html(html)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Xử lý lỗi khi yêu cầu thất bại
                    
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown) // Hiển thị lỗi khác
                  
                }
            })
        })
    }

    HT.renderModelMenu = (object) => {

        let html = ''
        html += '<div class="m-item">'
            html += '<div class="icheck-success d-inline">'
                html += '<input type="checkbox" id="'+object.canonical+'" value="'+object.canonical+'" name="" class="menuInputCheckbox" />'
                html += '<label for="'+object.canonical+'" class="text-muted font-weight-normal no-select">'+object.name+'</label>'
            html += '</div>'
        html += '</div>'

        return html
}

    
    $(document).ready(function() {
        HT.createMenuCatelogue()
        HT.createMenuRow()
        HT.getMenu()
        
        
    })

})(jQuery);