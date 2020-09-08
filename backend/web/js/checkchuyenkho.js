var Chuyenkho =
{
    checkSPTon: function() {
        var link = $('select.phutungchuyen');
        link.each(function() {
            $(this).on('select2:select', function (e) {
                var idPro = $(this).val();
                console.log(idPro);
                var select = $(this);
                // Xử lý ajax check số lượng tồn và vị trí
                $.ajax({
                    url: 'kiemtrachuyen',
                    type: 'post',
                    dataType: 'JSON',
                    data : {id : idPro},
                    success: function(data) {
                        if (data.check == false) {
                            select.val(null).trigger('change');
                            // select.text(null);
                            // $(this).val(null).trigger('change');
                            // $(this).val(null).trigger('change');
                            // $(this).select2('data', {id: null, a_key: 'Lorem Ipsum'});
                            
                            alert(data.message);
                        }
                            // console.log(data);
                            // console.log(select.val());
                                    // console.log(boxprice);
                    }
                });
                return false;
                e.preventDefault();
            })
        });
    }
};

$(document).ready(function() {
    Chuyenkho.checkSPTon();
   

//     // Sự kiện thay đổi chi tiết
//     $('#cat-id').on('select2:select', function (e) {
//         var cuahang = $('#khdichvu-cuahang_id').val();
//         var dichvu = $(this).val();
//         // console.log(dichvu);
//         // console.log(cuahang);
//         if (cuahang == '') {
//             $('#cat-id').val(null).trigger('change');
//             $('#subcat-id').val(null).trigger('change');
//             alert('Hãy nhập cửa hàng của bạn ');

//         }else{
//             $.ajax({
//                 url: 'checkvitri',
//                 type: 'post',
//                 dataType: 'JSON',
//                 data : {
//                  id : dichvu,
//                  cuahang_id : cuahang,
//              },
//              success: function(data) {
//                 if (data.check == false) {
//                     $('#cat-id').val(null).trigger('change');
//                     $('#subcat-id').val(null).trigger('change');
//                     alert('Phụ tùng này chưa có vị trí, hãy thêm vị trí trước !');
//                 }
//                 // $('#cat-id').val(null).trigger('change');
//                 // dv_suffixes.val('');
//                 // $('#subcat-id').text('');
//                 // $('#dv_quantity').val('');
//                     //         // $('.changePrice_'+data.id).html(data.price).show();
//                     // box.hide();
//                     // var boxprice = box.prev('button.changePrices');
//                     // boxprice.show();
//                     // boxprice.text(data.postValue);
//                     // console.log(data);
//                             // console.log(boxprice);
//                         }
//             });
//             return false;
//         }
//   });

});
