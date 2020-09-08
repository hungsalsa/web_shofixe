var Thongke =
{
    Timkiem : function () {
        var subcat_id = $('#subcat-id');
        var timkiemKH = $('#timkiemKH');
        timkiemKH.on('click', function(event) {
            event.preventDefault();
            var khachhang = $('#cat-id').val();
                subcat_id.removeAttr("disabled");

                $.ajax({
                    url: 'layxekhach',
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                       id_kh : khachhang,
                   },
                   success: function(data) {
                    subcat_id.removeAttr("disabled");
                    $("select#subcat-id").select2({
                      // tags: "true",
                      data: data.dataxekhachang,
                      allowClear: true
                  });
                    
                    // subcat_id.select2('data')[data.dataxekhachang];
                    // subcat_id.select2({
                    //     data: data.dataxekhachang,
                    // });
                        console.log(data);
                        // if (data.check == false) {
                        //     $('#cat-id').val(null).trigger('change');
                        //     $('#subcat-id').text(null).trigger('change');
                        //     alert(data.erros);
                        // }else{

                        //     dv_suffixes.val("");
                        //     dv_suffixes.removeAttr("disabled");
                        //     dv_quantity.val("");
                        //     dv_quantity.removeAttr("disabled");
                        // }
                    }
                });
            /* Act on the event */
        });
        // $('#cat-id').on('select2:select', function (e) {
            // var cuahang = $('#khdichvu-cuahang_id').val();
            

                // return false;
        // });
    }
};

$(document).ready(function() {
    Thongke.Timkiem();
});
