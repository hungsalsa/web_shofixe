var DichvuChitiet =
{
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
                $('#dv_suffixes').attr('disabled', 'disabled');
                $('#dv_quantity').attr('disabled', 'disabled');
            // $('#subcat-id :selected').val('');
                // dv_suffixes.val('');
                // $('#cat-id').text('');
                $('#subcat-id').val(null);
                $('#subcat-id').text('');
                $('#dv_suffixes').val('');
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
            }
            // alert('dâđâ');
        });
    },
    // CheckDichvu : function () {
    //     var dichvu = $('#cat-id');
    //     dichvu.on("change","#search_code",function(){
    //        alert(this.value);
    //    });
    // }
};

$(document).ready(function() {

    DichvuChitiet.CheckPhutung();
    DichvuChitiet.CheckSoluong();
    // DichvuChitiet.CheckDichvu();
    DichvuChitiet.addDichvu();

    $(document).on('click', '.remove', function(event) {
        event.preventDefault();
        if(confirm("Bạn có chắc muốn xóa dịch vụ?")){
            $(this).closest('tr').remove();
        }
        else{
            return false;
        }
    });
    

    // Sự kiện thay đổi chi tiết
    /*$('#cat-id').on('select2:select', function (e) {
        var cuahang = $('#khdichvu-cuahang_id').val();
        var dichvu = $(this).val();
        // console.log(dichvu);
        // console.log(cuahang);
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
                if (data.check == false) {
                    $('#cat-id').val(null).trigger('change');
                    $('#subcat-id').val(null).trigger('change');
                    alert('Phụ tùng này chưa có vị trí, hãy thêm vị trí trước !');
                }
                // $('#cat-id').val(null).trigger('change');
                // dv_suffixes.val('');
                // $('#subcat-id').text('');
                // $('#dv_quantity').val('');
                    //         // $('.changePrice_'+data.id).html(data.price).show();
                    // box.hide();
                    // var boxprice = box.prev('button.changePrices');
                    // boxprice.show();
                    // boxprice.text(data.postValue);
                    // console.log(data);
                            // console.log(boxprice);
                        }
            });
            return false;
        }
  });*/

});
