(function($) {
	"use strict";
	var HT = {}; 

    HT.setupProductVariant = () => {
        if($('.turnOnVariant').length){
            $(document).on('click', '.turnOnVariant', function(){
                let _this = $(this)
                let price = $('input[name=price]').val()
                let code = $('input[name=code]').val()
                if(price == '' || code ==''){
                    alert('Bạn phải nhập vào Giá và Mã sản phẩm để sử dụng chức năng này')
                    return false
                }
                if(_this.siblings('input:checked').length == 0){
                    $('.variant-wrapper').removeClass('hidden')
                }else{
                    $('.variant-wrapper').addClass('hidden')
                }
            })
        }
    }

    HT.addVariant = () => {
        if($('.add-variant').length){
            $(document).on('click', '.add-variant', function(){
                let html = HT.renderVariantItem(attributeCatalogue)
                $('.variant-body').append(html)
                $('.variantTable thead').html('')
                $('.variantTable tbody').html('')
                HT.checkMaxAttributeGroup(attributeCatalogue);
                HT.disabledAttributeCatalogueChoose();
            })
        }
    }

    HT.renderVariantItem = (attributeCatalogue) => {
        let html = '';
            html = html + '<div class="row variant-item mb-2">';
                html = html + '<div class="col-lg-3">';
                html = html + '<div class="attribute-catalogue">';
                    html = html + '<select name="attributeCatalogue[]" id="" class="choose-attribute rounded-0 niceSelect">';
                        html = html + '<option value="">Chọn nhóm thuộc tính</option>';
                        for(let i = 0; i < attributeCatalogue.length; i++){
                            html = html + '<option value="'+attributeCatalogue[i].id+'">'+attributeCatalogue[i].name+'</option>';
                            }
                    html = html + '</select>';
                html = html + '</div>';
            html = html + '</div>';
            html = html + '<div class="col-lg-8">';
                html = html + '<input type="text" name="" disabled value="" class="form-control fake-variant  rounded-0 ">';
            html = html + '</div>';
            html = html + '<div class="col-lg-1">';
                html = html + '<button type="button" class=" remove-attribute btn btn-danger rounded-0"><i class="fas fa-trash"></i></button>';
            html = html + '</div>';
            html = html + '</div>';
        return html;
    }

    HT.chooseVariantGroup = () => {
        $(document).on('change', '.choose-attribute', function(){
            let _this = $(this)
            let attributeCatalogueId = _this.val()
            if(attributeCatalogueId != 0){
                _this.parents('.col-lg-3').siblings('.col-lg-8').html(HT.select2Variant(attributeCatalogueId))
                $('.selectVariant').each(function(key, index){
                    HT.getSelect2($(this))
                })
            }else{
                _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" name="attribute['+attributeCatalogueId+'][]" disabled value="" class="form-control fake-variant  rounded-0 ">')
            }

            HT.disabledAttributeCatalogueChoose();
        })
    }


    HT.createProductVariant = () => {
        $(document).on('change', '.selectVariant', function(){
            let _this = $(this)
            HT.createVariant()
        })
    }

    HT.createVariant = () => {

        let attributes = []
        let variants = []
        let attributeTitle = []

        $('.variant-item').each(function(){
            let _this = $(this)
            let attr = []
            let attrVariant = []
            const attributeCatalogueId = _this.find('.choose-attribute').val()
            const optionText = _this.find('.choose-attribute option:selected').text()
            const attribute = $('.variant-'+attributeCatalogueId).select2('data')

            for(let i = 0; i < attribute.length; i++){
                let item = {}
                let itemVariant = {}
                item[optionText] = attribute[i].text
                itemVariant[attributeCatalogueId] = attribute[i].id
                attr.push(item)
                attrVariant.push(itemVariant)
            }
            attributeTitle.push(optionText)
            attributes.push(attr)
            variants.push(attrVariant)

        })
       
        attributes = attributes.reduce(
            (a, b) => a.flatMap( d => b.map( e => ( {...d, ...e} ) ) )
        )
        variants = variants.reduce(
            (a, b) => a.flatMap( d => b.map( e => ( {...d, ...e} ) ) )
        )

        HT.createTableHeader(attributeTitle)
        let trClass = []
        attributes.forEach((item, index) => {
            let $row = HT.createVariantRow(item, variants[index]);
            let classModified = 'tr-variant-' + Object.values(variants[index]).join(',').replace(/,/g,'-')
            trClass.push(classModified)
            if(!$('table.variantTable tbody tr').hasClass(classModified)){
                $('table.variantTable tbody').append($row);
            }
            
        });

        $('table.variantTable tbody tr').each(function(){
            const $row = $(this)
            const rowClasses = $row.attr('class')
            if(rowClasses){
                const rowClassArray = rowClasses.split(' ')
                let shouldRemove  = false
                rowClassArray.forEach(rowClass => {
                    if(rowClass == 'variant-row'){
                        return;
                    }else if(!trClass.includes(rowClass)){
                        shouldRemove  = true
                    }
                })
                if(shouldRemove ){
                    $row.remove()
                }

            }
        })

        // let html = HT.renderTableHtml(attributes, attributeTitle, variants);
        // $('table.variantTable').html(html)
        
    }

    
    HT.createVariantRow = (attributeItem, variantItem) => {
        let attributeString = Object.values(attributeItem).join(',')
        let attributeId = Object.values(variantItem).join(',')
        let classModified = attributeId.replace(/,/g, '-')
        let $row = $('<tr>').addClass('variant-row tr-variant-' + classModified)
        let $td

        $td = $('<td>').append(
            $('<span>').addClass('img img-cover').append(
                $('<img>').addClass('img-size-50 imageSrc').attr('src','backend/img/logo/logo-prettyeyes.png' )
            )
        ).addClass('text-center')
        $row.append($td)

        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value)
            $row.append($td)
        })
        let mainPrice = $('input[name=price]').val();
        let mainSku = $('input[name=code]').val();
        $row.append($('<td>').addClass('td-quantity').text('-'))
            .append($('<td>').addClass('td-price').text(mainPrice))
            .append($('<td>').addClass('td-sku').text(mainSku + '-' + classModified))

        $td = $('<td>').addClass('hidden td-variant')
        
        let inputHiddenFields = [
            { name: 'variant[quantity][]', class: 'variant_quantity' },
            { name: 'variant[sku][]', class: 'variant_sku', value:mainSku + '-' + classModified },
            { name: 'variant[price][]', class: 'variant_price', value: mainPrice },
            { name: 'variant[barcode][]', class: 'variant_barcode' },
            { name: 'variant[file_name][]', class: 'variant_filename' },
            { name: 'variant[file_url][]', class: 'variant_fileurl' },
            { name: 'variant[album][]', class: 'variant_album' },
            { name: 'productVariant[name][]', value: attributeString },
            { name: 'productVariant[id][]', value: attributeId },
        ]

        $.each(inputHiddenFields, function (_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class);
            if (field.value) {
                $input.val(field.value) // Sử dụng .val() thay vì .value()
            }
            $td.append($input)
        })

        
        $row.append($td)
       
    return $row

        

    }


    HT.createTableHeader = (attributeTitle) => {
        let $thead = $('table.variantTable thead');
        let $row = $('<tr>');
        $row.append($('<th>').addClass('text-center').attr('width', '90px').text('Ảnh'));
        
        for (let i = 0; i < attributeTitle.length; i++) {
            $row.append($('<th>').text(attributeTitle[i]));
        }
        
        $row.append($('<th>').text('Số lượng'));
        $row.append($('<th>').text('Giá tiền'));
        $row.append($('<th>').text('SKU'));
        
        $thead.html($row);
        return $thead;
    }

    // khong conf su dung
    // HT.renderTableHtml = (attributes, attributeTitle, variants) => {
    //     let html = '';
    
    //     html += '<thead class="bg-cyan">';
    //     html += '<tr>';
    //     html += '<th class="text-center" width="45px">STT</th>';
    //     html += '<th class="text-center" width="90px">Hình ảnh</th>';
    //     for (let i = 0; i < attributeTitle.length; i++) {
    //         html += '<td class="text-bold">' + attributeTitle[i] + '</td>';
    //     }
    
    //     html += '<th>Số lượng</th>';
    //     html += '<th>Giá tiền</th>';
    //     html += '<th>SKU</th>';
    //     html += '</tr>';
    //     html += '</thead>';
    //     html += '<tbody>';
    //     for (let j = 0; j < attributes.length; j++) {
    //         html += '<tr class="variant-row">';
    //         html += '<td class="text-center">' + (j + 1) + '</td>'; // Thêm số thứ tự
    //         html += '<td class="text-center">';
    //         html += '<span class="img img-cover"><img class="img-size-50 imageSrc" src="backend/img/logo/logo-prettyeyes.png" alt=""></span>';
    //         html += '</td>';
            
    //         let attributeArray = [];
    //         let attributeIdArray = [];
    //         $.each(attributes[j], function(index, value) {
    //             html += '<td>' + value + '</td>';
    //             attributeArray.push(value);
    //         });
    
    //         $.each(variants[j], function(index, value) {
    //             attributeIdArray.push(value);
    //         });
    //         let attributeString = attributeArray.join(',');
    //         let attributeId = attributeIdArray.join(',');
    
    //         html += '<td class="td-quantity">-</td>';
    //         html += '<td class="td-price">-</td>';
    //         html += '<td class="td-sku">-</td>';
    //         html += '<td class="hidden td-variant">';
    //         html += '<input type="text" name="variant[quantity][]" class="variant_quantity">';
    //         html += '<input type="text" name="variant[sku][]" class="variant_sku">';
    //         html += '<input type="text" name="variant[price][]" class="variant_price">';
    //         html += '<input type="text" name="variant[barcode][]" class="variant_barcode">';
    //         html += '<input type="text" name="variant[file_name][]" class="variant_filename">';
    //         html += '<input type="text" name="variant[file_url][]" class="variant_fileurl">';
    //         html += '<input type="text" name="variant[album][]" class="variant_album">';
    //         html += '<input type="text" name="attribute[name][]" value="' + attributeString + '">';
    //         html += '<input type="text" name="attribute[id][]" value="' + attributeId + '">';
    //         html += '</td>';
    //         html += '</tr>';
    //     }
    //     html += '</tbody>';
    
    //     return html;
    // }

    HT.getSelect2 = (object) => {
        let option = {
            'attributeCatalogueId' : object.attr('data-catid')
        }
        $(object).select2({
            minimumInputLength: 1,
            placeholder: 'Nhập tối thiểu 2 kí tự để tìm kiếm',
            ajax: {
                url: 'ajax/attribute/getAttribute',
                type: 'GET',
                dataType: 'json',
                deley: 50,
                data: function (params){
                    return {
                        search: params.term,
                        option: option,
                    }
                },
                processResults: function(data){
                    return {
                        results: data.items
                    }
                },
                cache: true
              
              }
        });
    }

    

    HT.niceSelect = () => {
        $('.niceSelect').niceSelect();
    }

    HT.destroyNiceSelect = () => {
        if($('.niceSelect').length){
            $('.niceSelect').niceSelect('destroy')
        }
    }
    
    HT.disabledAttributeCatalogueChoose = () => {
        let id = [];
        $('.choose-attribute').each(function(){
            let _this = $(this)
            let selected = _this.find('option:selected').val()
            if(selected != 0){
                id.push(selected)
            }
        })


        $('.choose-attribute').find('option').removeAttr('disabled')
        for(let i = 0; i < id.length; i++){
            $('.choose-attribute').find('option[value='+id[i]+']').prop('disabled', true)
        }
        HT.destroyNiceSelect()
        HT.niceSelect()
        $('.choose-attribute').find('option:selected').removeAttr('disabled')
    }

    HT.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $('.variant-item').length
        if(variantItem >= attributeCatalogue.length){
            $('.add-variant').remove()
        }else{
            $('.variant-foot').html('<button type="button" class="add-variant btn btn-outline-info btn-fla rounded-0"><i class="fas fa-plus mr-3"></i>Thêm phiên bản mới</button>')
        }
    }

    HT.removeAttribute = () => {
        $(document).on('click', '.remove-attribute', function(){
            let _this = $(this)
            _this.parents('.variant-item').remove()
            HT.checkMaxAttributeGroup(attributeCatalogue)
            HT.createVariant()
        })
    }

    HT.select2Variant = (attributeCatalogueId) => {
        let html = '<select class="selectVariant variant-'+attributeCatalogueId+' form-control" name="attribute['+attributeCatalogueId+'][]" multiple data-catid="'+attributeCatalogueId+'"></select>'
        return html
    }

    HT.variantAlbum = () => {
        $(document).on('click', '.click-to-upload-variant', function(e){
            HT.browseVariantServerAlbum()
            e.preventDefault();
        })
    }

    HT.browseVariantServerAlbum = () => {
        var type = 'Images';
        var finder = new CKFinder();
        
        finder.resourceType = type;
        finder.selectActionFunction = function( fileUrl, data, allFiles ) {
            let html = '';
            for(var i = 0; i < allFiles.length; i++){
                var image = allFiles[i].url
                html += '<li class="ui-state-default">'
                   html += ' <div class="thumb">'
                       html += ' <span class="span image img-scaledown">'
                            html += '<img src="'+image+'" alt="'+image+'">'
                            html += '<input type="hidden" name="variantAlbum[]" value="'+image+'">'
                        html += '</span>'
                        html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button>'
                    html += '</div>'
                html += '</li>'
            }
           
            $('.click-to-upload-variant').addClass('hidden')
            $('#sortable2').append(html)
            $('.upload-variant-list').removeClass('hidden')
        }
        finder.popup();
    }

    HT.deleteVariantAlbum = () => {
        $(document).on('click','.variant-delete-image', function(){
            let _this = $(this)
            _this.parents('.ui-state-default').remove()
            if($('.ui-state-default').length == 0){
                $('.click-to-upload-variant').removeClass('hidden')
                $('.upload-variant-list').addClass('hidden')
            }
        })
    }

    HT.switchery = () => {
        $('.js-switch').each(function(){
            // let _this = $(this)
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small'});
        })
    }

    HT.switchChange = () => {
        $(document).on('change', '.js-switch', function(){
            let _this = $(this)
            let isChecked = _this.prop('checked');
            if(isChecked == true){
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').removeAttr('disabled')
            }else{
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').attr('disabled', true)
            }
        })
    }


    HT.updateVariant = ()=>{
        $(document).on('click','.variant-row', function(){
            let _this = $(this)
            let variantData = {}
            _this.find(".td-variant input[type = text][class^='variant_']").each(function(){
                let className = $(this).attr('class')
                variantData[className] = $(this).val()
            })


            let updateVariantBox = HT.updateVariantHtml(variantData)
            if($('.updateVariantTr').length ===0){
                _this.after(updateVariantBox)
                HT.switchery();

            }
           
        })
        
    }

    HT.addCommas = (nStr) => { 
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str ='';
        for (let i = nStr.length; i > 0; i -= 3){
            let a = ( (i-3) < 0 ) ? 0 : (i-3);
            str= nStr.slice(a,i) + '.' + str;
        }
        str= str.slice(0,str.length-1);
        return str;
    }

    HT.variantAlbumList = (album) => {
        let html = ''
        if(album.length  && album[0] !== ''){
            for(let i = 0; i < album.length ; i++){
                html += '<li class="ui-state-default"> '
                html += '<div class="thumb"> '
                    html += '<span class="span image img-scaledown">'
                        html += '<img src="'+album[i]+'">'
                        html += '<input type="hidden" name="variantAlbum[]" value="'+album[i]+'">'
                    html += '</span>'
                    html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button>'
                html += '</div>'
            html += '</li>'
            }
        }
        return html
       
    }

    
    HT.updateVariantHtml = (variantData)=>{
        let variantAlbum = variantData.variant_album.split(',')
        let variantAlbumItem = HT.variantAlbumList(variantAlbum)
        let html = ''
        html +='<tr class="updateVariantTr">'
        html +='<td colspan="8">'
            html +='<div class="updateVariant card border-0 rounded-0">'
                html +='<div class="card-header">'
                   html +=' <h3 class="card-title text-uppercase  text-gray mt-2">Cập nhật thông tin phiên bản</h3>'
                 html +='   <div class="card-tools">'
                       html +=' <button type="button" class="cancleUpdate rounded-0 btn btn-sm btn-danger mr10">Hủy bỏ</button>'
                      html +='  <button type="button" class="saveUpdateVariant rounded-0 btn btn-sm btn-primary">Lưu lại</button>'
                 html +='   </div>'

              html +='  </div>'
              html +='  <div class="card-body">'
                    html +='<div class="click-to-upload-variant '+((variantAlbum.length > 0 && variantAlbum[0] !=='') ? 'hidden':'')+'">'
                       html +=' <div class="icon">'
                           html +=' <a type="button" class="upload-variant-picture">'
                               html +=' <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">'
                                   html +=' <path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z">'
                                    html +='</path>'
                                html +='</svg>'
                            html +='</a>'
                        html +='</div>'
                       html +=' <div class="small-text text-muted">Sử dụng nút chọn hình để thêm mới hình ảnh </div>'
                   html +=' </div>'
                   html +=' <ul class="upload-variant-list '+((variantAlbumItem.length)?'':'hidden')+' sortui ui-sortable clearfix " id="sortable2">'+variantAlbumItem+'</ul>'
                   html +=' <div class="row mt-4 d-flex justify-content-center align-items-center">'
                        html +='<div class="col-lg-2 d-flex justify-content-around ">'
                            html +='<label for="">Tồn kho</label>'
                           html +=' <input type="checkbox" class="js-switch" '+((variantData.variant_quantity !== '') ? 'checked' : '')+' data-target="variantQuantity">'
                      html +='  </div>'
                       html +=' <div class="col-lg-10">'
                            html +='<div class="row">'
                               html +=' <div class="col-lg-3 mb-2">'
                                   html +=' <label for="" class="text-sm">Số lượng</label>'
                                    html +='<input type="text" '+((variantData.variant_quantity == '') ? 'disabled' : '')+' name="variant_quantity" value="'+variantData.variant_quantity+'" class="form-control '+((variantData.variant_quantity == '') ? 'disabled' : '')+' rounded-0  int">'
                               html +=' </div>'
                               html +=' <div class="col-lg-3 mb-2">'
                                    html +='<label for="" class="control-label text-sm">SKU</label>'
                                    html +='<input type="text" name="variant_sku" value="'+variantData.variant_sku+'" class="form-control  rounded-0">'
                              html +='  </div>'
                               html +=' <div class="col-lg-3 mb-2">'
                                  html +='  <label for="" class="control-label text-sm">Giá</label>'
                                  html +='  <input type="text" name="variant_price" value="'+HT.addCommas(variantData.variant_price)+'" class="form-control  rounded-0 int">'
                               html +=' </div>'
                               html +=' <div class="col-lg-3 mb-2">'
                                  html +='  <label for="" class="control-label text-sm">Barcode</label>'
                                  html +='  <input type="text" name="variant_barcode" value="'+variantData.variant_barcode+'" class="form-control  rounded-0">'
                               html +=' </div>'
                           html +=' </div>'
                       html +=' </div>'
                   html +=' </div>'
                   html +=' <div class="row mt-4 d-flex justify-content-center align-items-center">'
                      html +=' <div class="col-lg-2 d-flex justify-content-around">'
                           html +=' <label for="">QL File</label>'
                            html +='<input type="checkbox" '+((variantData.variant_filename !== '') ? 'checked' : '')+' class="js-switch" data-target="disabled">'
                        html +='</div>'
                       html +=' <div class="col-lg-10">'
                          html +=' <div class="row">'
                               html +=' <div class="col-lg-6 mb-2">'
                                 html +='   <label for="" class="control-label text-sm">Tên File</label>'
                                 html +='   <input type="text" '+((variantData.variant_filename == '') ? 'disabled' : '')+' name="variant_file_name" value="'+variantData.variant_filename+'" class="form-control '+((variantData.variant_filename == '') ? 'disabled' : '')+' rounded-0">'
                               html +=' </div>'
                               html +=' <div class="col-lg-6 mb-2">'
                                    html +='<label for="" class="control-label text-sm">Đường dẫn</label>'
                                   html +=' <input type="text" '+((variantData.variant_filename == '') ? 'disabled' : '')+' name="variant_file_url" value="'+variantData.variant_fileurl+'"  class="form-control '+((variantData.variant_filename == '') ? 'disabled' : '')+' rounded-0"'
                                html +='</div>'
                           html +=' </div>'
                       html +=' </div>'
                    html +='</div>'
                html +='</div>'
           html +=' </div>'
       html +=' </td>'
       html +=' </tr>'
       return html
    }
    
    HT.cancleVariantUpdate = () =>{
        $(document).on('click', '.cancleUpdate', function(){
            HT.closeUpdateVariant()
        })
    }

    HT.closeUpdateVariant = () => {
        $('.updateVariantTr').remove()
    }

    HT.saveVariantUpdate = () =>{
        $(document).on('click','.saveUpdateVariant', function(){
            
            let variant = {
                'quantity' : $('input[name=variant_quantity]').val(),
                'sku' : $('input[name=variant_sku]').val(),
                'price' : $('input[name=variant_price]').val(),
                'barcode' : $('input[name=variant_barcode]').val(),
                'filename' : $('input[name=variant_file_name]').val(),
                'fileurl' : $('input[name=variant_file_url]').val(),
                'album' : $("input[name='variantAlbum[]']").map(function(){
                    return $(this).val()
                }).get(),
            }

            $.each(variant, function(index,value){
                $('.updateVariantTr').prev().find('.variant_'+index).val(value)
            })

            HT.previewVariantTr(variant)
            HT.closeUpdateVariant()

        })
    }

    HT.previewVariantTr = (variant) => {
        let option = {
            'quantity': variant.quantity,
            'price': variant.price,
            'sku': variant.sku,
        }
        $.each(option, function(index, value) {
            $('.updateVariantTr').prev().find('.td-' + index).html(value)
        })
        $('.updateVariantTr').prev().find('.imageSrc').attr('src', variant.album[0])
    }


    HT.setupSelectMultiple = (callback) => {
        if ($('.selectVariant').length) {
            let count = $('.selectVariant').length
    
            $('.selectVariant').each(function () {
                let _this = $(this);
                let attributeCatalogueId = _this.attr('data-catid');
                
                if (attribute != '') {
                    $.get('ajax/attribute/loadAttribute', {
                        attribute: attribute,
                        attributeCatalogueId: attributeCatalogueId
                    }, function (json) {
                        if (json.items != 'undefined' && json.items.length) {
                            for (let i = 0; i < json.items.length; i++) {
                                var option = new Option(json.items[i].text, json.items[i].id, true, true)
                                _this.append(option).trigger('change')
                            }
                        }
    
                        if(--count === 0 && callback){
                            callback()
                        }
                    });
                }
                
                HT.getSelect2(_this);
            });
    
        }
    };
    
    HT.productVariant = () => {
        variant = JSON.parse(atob(variant)); // Giả sử 'variant' đã được mã hóa base64 trước khi gọi hàm này.
    $('.variant-row').each(function(index, value) {
        let _this = $(this);

        // Lặp qua mảng inputHiddenFields và gán giá trị vào các trường input
        let inputHiddenFields = [
            { name: 'variant[quantity][]', class: 'variant_quantity', value: variant.quantity[index] },
            { name: 'variant[sku][]', class: 'variant_sku', value: variant.sku[index] },
            { name: 'variant[price][]', class: 'variant_price', value: variant.price[index] },
            { name: 'variant[barcode][]', class: 'variant_barcode', value: variant.barcode[index] },
            { name: 'variant[file_name][]', class: 'variant_filename', value: variant.file_name[index] },
            { name: 'variant[file_url][]', class: 'variant_fileurl', value: variant.file_url[index] },
            { name: 'variant[album][]', class: 'variant_album', value: variant.album[index] },
        ];
        for (let i = 0; i < inputHiddenFields.length; i++) {
            let inputField = _this.find('.' + inputHiddenFields[i].class);
            if (inputField.length) {
                inputField.val(inputHiddenFields[i].value || ''); // Gán giá trị từ mảng variant vào trường input tương ứng
            } else {
                console.log('Input field with class ' + inputHiddenFields[i].class + ' does not exist.');
            }
        }

        // Hiển thị số lượng và giá tiền
        _this.find('.td-quantity').text(HT.addCommas(variant.quantity[index]));
        _this.find('.td-price').text(HT.addCommas(variant.price[index]));

        // Hiển thị SKU
        _this.find('.td-sku').text(variant.sku[index]);

        // Xử lý hình ảnh
        let album = variant.album[index];
        let variantImage = (album) ? album.split(',')[0] : '/backend/img/logo/logo-prettyeyes.png';
        _this.find('.imageSrc').attr('src', variantImage);
    });
    };
    
    
    

    
    



	$(document).ready(function(){
        HT.setupProductVariant()
        HT.addVariant()
        HT.niceSelect()
        HT.chooseVariantGroup()
        HT.removeAttribute()
        HT.createProductVariant()
        HT.variantAlbum()
        HT.deleteVariantAlbum()
        HT.switchChange()
        HT.updateVariant()
        HT.cancleVariantUpdate()
        HT.saveVariantUpdate()
        HT.setupSelectMultiple(
            ()=>{
                HT.productVariant()
            }
        )
	});

})(jQuery);

