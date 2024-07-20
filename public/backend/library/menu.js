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

    HT.menuRowHtml = (option) => {
        let $row = $('<div>').addClass('row mb-3 menu-item ' + ((typeof(option) != 'undefined') ? option.canonical : ''));
    
        const columns = [
            { class: 'col-lg-4', name: 'menu[name][]', value: (typeof(option) != 'undefined') ? option.name : '' },
            { class: 'col-lg-6', name: 'menu[canonical][]', value: (typeof(option) != 'undefined') ? option.canonical : '' },
            { class: 'col-lg-1', name: 'menu[order][]', value: 0 },
        ];
    
        columns.forEach(col => {
            let $col = $('<div>').addClass(col.class);
            let $input = $('<input>')
                .attr('type', 'text')
                .addClass('form-control form-control-sm rounded-0' + ((col.name == 'menu[order][]') ? ' int text-right' : ''))
                .attr('name', col.name)
                .attr('value', col.value);
            $col.append($input);
            $row.append($col);
        });
    
        let $removeCol = $('<div>').addClass('col-lg-1 text-center');
        let $a = $('<a>').addClass('delete-menu btn btn-info btn-sm');
        let $i = $('<i>').addClass('fas fa-trash');
        $a.append($i);
        $removeCol.append($a);
        $row.append($removeCol);
    
        return $row;
    };
    

    HT.deleteMenuRow = () => {
        // Lắng nghe sự kiện click trên các phần tử có class 'delete-menu'
        $(document).on('click', '.delete-menu', function() {
            let _this = $(this); // Lấy đối tượng hiện tại được click
    
            // Tìm phần tử cha có class 'menu-item' và xóa nó
            _this.parents('.menu-item').remove();
    
            // Gọi hàm kiểm tra độ dài của các mục menu
            HT.checkMenuItemLength(); // Giả sử bạn muốn gọi hàm này
        });
    };
    

    HT.checkMenuItemLength = () =>{
        if($('.menu-item').length === 0){
            $('.notification').show()
        }
    }

    HT.getMenu = () => {
        $(document).on('click', '.menu-module', function() {
            let _this = $(this);
            let option = {
                model: _this.attr('data-model')
            };
            let target = _this.parents('.card').find('.menu-list');
            let menuRowClass = HT.checkMenuRowExit()

            HT.sendAjaxGetMenu(option, target, menuRowClass )
    
            
        });
    };

    HT.checkMenuRowExit = () =>{
        let menuRowClass = $('.menu-item').map(function(){
            let allClasses = $(this).attr('class').split(' ').slice(3).join('')

            return allClasses
        }).get()

        return menuRowClass
    }

    HT.sendAjaxGetMenu = (option, target, menuRowClass) => {
        $.ajax({
            url: 'ajax/dashboard/getMenu', // URL xử lý yêu cầu AJAX
            type: 'GET', // Phương thức gửi dữ liệu
            data: option, // Dữ liệu được gửi
            dataType: 'json', // Kiểu dữ liệu nhận về
            beforeSend: function() {
                _this.parents('.card').find('.menu-list').html(''); // Sửa lỗi chính tả và đảm bảo đúng lớp phần tử cha
            },
            success: function(res) {
                let html = '';
                for (let i = 0; i < res.data.length; i++) {
                    html += HT.renderModelMenu(res.data[i], menuRowClass); // Gọi hàm để tạo HTML từ dữ liệu
                }
                html += HT.menuLinks(res.links); // Thêm liên kết phân trang
                target.html(html)
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Xử lý lỗi khi yêu cầu thất bại
                console.log('Lỗi: ' + textStatus + ' ' + errorThrown); // Hiển thị lỗi khác
            }
        });
    }
    

    HT.menuLinks = (links) => {
        let nav = $('<nav>')
        if(links.length > 3){
            let paginationUl = $('<ul>').addClass('pagination'); 
            $.each(links, function(index, link) {
                let liClass = 'page-item';
                if (link.active) {
                    liClass += ' active';
                } else if (!link.url) {
                    liClass += ' disabled';
                }
                let li = $('<li>').addClass(liClass);
                if (link.label == 'pagination.previous') {
                    let a = $('<a>').addClass('page-link').attr('aria-hidden', true).html('<');
                    li.append(a);
                } else if (link.label == 'pagination.next') {
                    let a = $('<a>').addClass('page-link').attr('aria-hidden', true).html('>');
                    li.append(a);
                }
                paginationUl.append(li); 
            });
            nav.append(paginationUl); 

        }
        
        return nav;
    }

    HT.getPaginationMenu = () =>{
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault()
            let _this = $(this)
            let option = {
                model: _this.parents('.collapse').attr('id'),
                page:_this.text()
            }
            let target = _this.parents('.menu-list')
            let menuRowClass = HT.checkMenuRowExit()
            HT.sendAjaxGetMenu(option, target, menuRowClass)
        })
    }


    HT.renderModelMenu = (object, renderModelMenu ) => {
    let html = '';
    html += '<div class="m-item">';
    html += '    <div class="icheck-success d-inline">';
    html += '        <input type="checkbox" '+((renderModelMenu.includes(object.canonical)) ? 'checked' : '')+' id="' + object.canonical + '" value="' + object.canonical + '" name="" class="choose-menu" />';
    html += '        <label for="' + object.canonical + '" class="text-muted font-weight-normal no-select">' + object.name + '</label>';
    html += '    </div>';
    html += '</div>';

    return html;
    };

    HT.chooseMenu = () => {
        // Lắng nghe sự kiện click trên các checkbox có class 'choose-menu'
        $(document).on('click', '.choose-menu', function() {
            let _this = $(this); // Lấy đối tượng checkbox hiện tại
            let canonical = _this.val(); // Lấy giá trị của checkbox
            let name = _this.siblings('label').text(); // Lấy tên từ label tương ứng
    
            // Tạo hàng menu mới với dữ liệu từ checkbox
            let $row = HT.menuRowHtml({
                name: name,
                canonical: canonical
            });
    
            // Kiểm tra xem checkbox có được chọn không
            let isChecked = _this.prop('checked');
    
            if (isChecked) {
                // Nếu checkbox được chọn, thêm hàng menu vào .menu-wrapper
                $('.menu-wrapper').append($row).find('.notification').hide();
            } else {
                // Nếu checkbox không được chọn, xóa hàng menu tương ứng
                $('.menu-wrapper').find('.menu-item.' + canonical).remove();
                HT.checkMenuItemLength();
            }
        });
    };


    HT.searchMenu = () => {
      
        $(document).on('keyup', '.search-menu', function(e){
            let _this = $(this)
            let keyword = _this.val()
            let option = {
                model: _this.parents('.collapse').attr('id'),
                keyword:  keyword
            }
            clearTimeout(typingTimer)
            typingTimer = setTimeout(function(){
                let menuRowClass = HT.checkMenuRowExit()
                let target = _this.siblings('.menu-list')
                HT.sendAjaxGetMenu(option, target, menuRowClass)
            }, doneTypingInterval)

            
        })
    }
    

    
    $(document).ready(function() {
        HT.createMenuCatelogue()
        HT.createMenuRow()
        HT.deleteMenuRow()
        HT.getMenu()
        HT.chooseMenu()
        HT.getPaginationMenu()
        
        
    })

})(jQuery);