var DichvuChitiet =
{

    changeDichvu: function() {

        var link = $('.changeChitietdv');
        link.each(function() {
            $(this).click(function(e) {
                var id = $(this).data('id');
                // var dv_suffixes = $('#dv_suffixes'+id);
                // dv_suffixes.attr('disabled', 'disabled');
                // var dv_quantity = $('#dv_quantity'+id);
                // dv_quantity.attr('disabled', 'disabled');

                // $(this).hide();
                // alert(id);
                $(this).closest('tr').hide();
                $('.Update_dichvu_'+id).show();
                e.preventDefault();

                var cuahang = $('#khdichvu-cuahang_id').val();
                var price = $('#subcat-id'+id);
                var dv_suffixes = $('#dv_suffixes'+id);
                var dv_quantity = $('#dv_quantity'+id);
                /*CHỈNH SỬA DỊCH VỤ CHECK TỒN KHO VÀ VỊ TRÍ*/
                $('#cat-id'+id).on('select2:select', function (e) {
                    var dichvu = $(this);
                    // console.log(cuahang);
                    // console.log(dichvu);

                        $.ajax({
                            url: 'checkvitri',
                            type: 'post',
                            dataType: 'JSON',
                            data : {
                             id : dichvu.val(),
                             cuahang_id : cuahang,
                         },
                         success: function(data) {
                                    // console.log(data);
                                    if (data.check == false) {
                                        dichvu.val(null).trigger('change');
                                        price.val(null).trigger('change');
                                        // price.text(null).trigger('change');
                                        dv_quantity.val("");
                                        dv_suffixes.val("");
                                        alert(data.erros);
                                            
                                    }else{
                                        dv_suffixes.val("");
                                        dv_suffixes.removeAttr("disabled");
                                        dv_quantity.val("");
                                        dv_quantity.removeAttr("disabled");
                                    }
                                }
                            });
                        return false;
                });
                /*CHỈNH SỬA DỊCH VỤ END*/

                /*CHECK SỐ LƯỢNG XUẤT VÀ SLG TỒN */
                var soluong=$('#dv_quantity'+id);
                soluong.on('blur', function(e) {
                    var cuahang = $('#khdichvu-cuahang_id').val();
                    var dichvu = $('#cat-id'+id);
                    if (dichvu != '') {
                        $.ajax({
                            url: 'checksoluong',
                            type: 'post',
                            dataType: 'JSON',
                            data : {
                                id : dichvu.val(),
                                cuahang_id : cuahang,
                                quantity : $(this).val(),
                            },
                            success: function(data) {
                                if (data.check == false) {
                                    soluong.val(data.slton);
                                    $(this).text(data.slton);

                                    alert(data.erros);
                                }
                            // console.log(data);
                            }
                        });
                    }else{
                        $(this).val('');
                        alert('Bạn hãy nhập dịch vụ trước khi thêm số lượng !');
                    }
                    // alert('dâđâ');
                });
                /*CHECK SỐ LƯỢNG XUẤT VÀ SLG TỒN */
            })
        });
        var link = $('.cancelChange');
        link.each(function() {
            $(this).click(function(e) {
                // $(this).hide();
                // alert($(this).attr('data-id'));
                $(this).closest('tr').hide();
                $('.dichvu_'+$(this).data('id')).show();
                e.preventDefault();
            })
        });
        // LUU VAO CSDL SU DUNG AJAX
        var saveChitietdv = $('.saveChitietdv');
        saveChitietdv.each(function() {
            $(this).click(function() {
                // $(this).closest('tr').hide();
                var box = $(this).parents('td').parents('tr.updateDichvu');
                var url = box.data('url');
                // var id_dv = box.data('dichvu');
                var id_Pro_dv = $('#cat-id'+$(this).data('id')).val();
                var price = $('#subcat-id'+$(this).data('id')).val();
                var dv_quantity = $('#dv_quantity'+$(this).data('id')).val();
                // alert($(this).data('id'));
                var dv_suffixes = $('#dv_suffixes'+$(this).data('id')).val();
                // console.log(id_Pro_dv);
                // console.log(dv_suffixes);
                if (price=='' || id_Pro_dv =='' || dv_quantity =='') {
                    alert('Bạn phải nhập đầy đủ dịch vụ, giá, số lượng')
                }else{
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'JSON',
                        data : {
                         id : $(this).data('id'),
                         id_Pro_dv : id_Pro_dv,
                         price : price,
                         quantity : dv_quantity,
                         suffixes : dv_suffixes
                     },
                     success: function(data) {
                            // console.log(data);
                            // $(this).closest('tr').hide();
                            // $('.changePrice_'+data.id).html(data.price).show();
                            box.hide();
                            // box.prev('tr.dichvu_'+$(this).data('id')).show();
                            // window.location.reload();
                            // $('.dichvu_'+$(this).data('id')).show();
                            // alert(data.id);
                            var dichvu = box.prev('tr.dichvu_'+data.id);
                            dichvu.children('td:nth-child(2)').text(data.id_Pro_dv);
                            dichvu.children('td:nth-child(3)').text(data.suffixes);
                            dichvu.children('td:nth-child(4)').text(data.price);
                            dichvu.children('td:nth-child(5)').text(data.quantity);
                            dichvu.show();
                            // $('td.stt_'+data.id).append(data.html);
                            // box.prev('tr.dichvu_'+data('id')).children('td.stt_'+$(this).data('id')).append(data.html);
                            // $('.stt_'+$(this).data('id')).append(data.html);
                            // $(this).parents('td').parents('tr.Update_dichvu_'+$(this).data('id')).show();
                        }
                    });
                }

                
                return false;
            })
        })

        // Xóa chi tiết dịch vụ
        var deleteChitiet = $('.deleteChitiet');
        deleteChitiet.each(function() {
            $(this).click(function() {
                var xacnhan = confirm("Bạn có chắc muốn xóa !");
                if (xacnhan == true) {
                    var url = $(this).data('url');
                    var trparent = $(this).parents('td').parents('tr.dichvu_'+$(this).data('id'));
                // alert(trparent);
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                     id : $(this).data('id'),
                 },
                 success: function(data) {
                            // console.log(data);
                            trparent.closest('tr').remove();
                        }
                    });
                return false;
            }

        })
        });

        
    },
    addDichvu : function () {
        var i=0;
        var adddv=$('.add');
        adddv.button().click(function(event) {
            event.preventDefault();
            i++;
            var html ='';
            var cat = $('#cat-id :selected');
            var subcat = $('#subcat-id :selected');
            var dv_quantity = $('#dv_quantity');
            var dv_suffixes = $('#dv_suffixes');
            var check=true; var erros = '';
            // alert(cat.text());
            html+= '<tr>';
            html+= '<td>'+i+'</td>';
            if (cat.val() == '') {
                erros += "Bạn chưa nhập dịch vụ \n";
            }else{
                html+= '<td class="text-left">'+'<input type="hidden" name="themchitiet['+'name'+'][]" class="form-control item_name" value="'+cat.val()+'">'+cat.text()+'</td>';
            }
            html+= '<td>'+'<input type="hidden" name="themchitiet['+'suffixes'+'][]" class="form-control item_name" value="'+dv_suffixes.val()+'">'+dv_suffixes.val()+'</td>';
            if (subcat.val() == '' || subcat.text() == '') {
                erros += "Bạn chưa nhập giá \n";
            }else{
                html+= '<td>'+'<input type="hidden" name="themchitiet['+'price'+'][]" class="form-control item_name" value="'+subcat.text()+'">'+subcat.text()+'</td>';
            }
            if (dv_quantity.val() == '') {
                erros += "Bạn chưa nhập số lượng \n";
            }else{
                html+= '<td>'+'<input type="hidden" name="themchitiet['+'quantity'+'][]" class="form-control item_name" value="'+dv_quantity.val()+'">'+dv_quantity.val()+'</td>';
            }
            if (cat.val() == '' || subcat.val() == '' || dv_quantity.val() == '') {
                check = false;
            }
            html += '<td><button type="button" class="pull-right btn btn-danger btn-sm remove" name="remove">Remove</button></td></tr>';
            html+='</tr>';
            // html += '<tr>';
            // html += '<td><input type="text" name="item_name[]" id="input" class="form-control item_name" value="" required="required" pattern="" title=""></td>';
            // html += '<td><input type="text" name="item_price[]" id="input" class="form-control item_price" value="" required="required" pattern="" title=""></td>';
            // html += '<td><input type="text" name="item_quantity[]" id="input" class="form-control item_quantity" value="" required="required" pattern="" title=""></td>';
            if (check == true) {
                $('tbody#danhsachdichvu').append(html);
                $('#cat-id').val(null).trigger('change');
            // $('#subcat-id :selected').val('');
            dv_suffixes.val('');
            // $('#cat-id').text('');
            $('#subcat-id').text('');
            $('#dv_quantity').val('');
        }else{
            alert(erros);
        };
    });
    },
    CheckPhutung : function () {
        var dv_suffixes = $('#dv_suffixes');
            dv_suffixes.attr('disabled', 'disabled');
        var dv_quantity = $('#dv_quantity');
            dv_quantity.attr('disabled', 'disabled');
            
        $('#cat-id').on('select2:select', function (e) {
            var cuahang = $('#khdichvu-cuahang_id').val();
            var dichvu = $(this).val();
            
            if (cuahang == '') {
                $('#cat-id').val(null).trigger('change');
                $('#subcat-id').val(null).trigger('change');
                alert('Hãy nhập cửa hàng của bạn ');

            }else{
                $.ajax({
                    url: 'checkvitri',
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                       id : dichvu,
                       cuahang_id : cuahang,
                   },
                   success: function(data) {
                    // console.log(data);
                    if (data.check == false) {
                        $('#cat-id').val(null).trigger('change');
                        $('#subcat-id').text(null).trigger('change');
                        alert(data.erros);
                    }else{

                        dv_suffixes.val("");
                        dv_suffixes.removeAttr("disabled");
                        dv_quantity.val("");
                        dv_quantity.removeAttr("disabled");
                    }
                }
            });
                return false;
            }
    });
    },
    CheckSoluong : function () {
        var soluong=$('#dv_quantity');
        soluong.on('blur', function(e) {
            var cuahang = $('#khdichvu-cuahang_id').val();
            var dichvu = $('#cat-id').val();
            if (dichvu != '') {
                $.ajax({
                    url: 'checksoluong',
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                        id : dichvu,
                        cuahang_id : cuahang,
                        quantity : $(this).val(),
                    },
                    success: function(data) {
                        if (data.check == false) {
                            soluong.val(data.slton);
                            $(this).text(data.slton);
                            alert(data.erros);
                        }
                    // console.log(data);
                    // $(this).closest('tr').hide();
                    }
                });
            }else{
                $(this).val('');
                alert('Bạn hãy nhập dịch vụ trước khi thêm số lượng !');
            }
            // alert('dâđâ');
        });
    },
    removeDichvu : function () {
        var remove = $('button.remove');
        remove.each(function() {
            $(this).click(function(e) {
                alert('dấda');
                // alert($(this).attr('data-id'));
                // $(this).closest('tr').hide();
                // $('.Update_dichvu_'+$(this).data('id')).show();
                e.preventDefault();
            })
        });

        
        // remove.each(function() {
        //     $(this).click(function(event) {
        //         alert('dấda');
        //         event.preventDefault();
        //         // if(confirm("Bạn có chắc muốn xóa dịch vụ?")){
        //         //     $(this).closest('tr').remove();
        //         // }
        //         // else{
        //         //     return false;
        //         // }
        //     });
        // })
    }
};

$(document).ready(function() {
    DichvuChitiet.changeDichvu();
    DichvuChitiet.CheckPhutung();
    DichvuChitiet.CheckSoluong();
    DichvuChitiet.addDichvu();
    DichvuChitiet.removeDichvu();
});
