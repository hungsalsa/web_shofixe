var Product =
{
    ClickButton: function(){
        // Click để thay đổi
        var link = $('.Quickchange');
        link.each(function() {
            $(this).click(function(e) {
                $(this).hide();
                    width_ = "10%";
                if ($(this).data('field') =='proName' || $(this).data('field') =='bike_id') {
                    width_ = "30%";
                }
                // alert($(this).data('field'));
                $(this).parent('td').css("width", width_);
                $(this).next('.updateProduct'+$(this).data('id')).show();
                e.preventDefault();
            })
        });
        // Click vào hủy ko thay đổi
        var Cancel = $('.Cancel');
        Cancel.each(function() {
            $(this).click(function(e) {
                var divcha = $(this).parent('div.proUpdate');
                divcha.hide();

                $(this).parent('.proUpdate').parent('td').css("width", "auto");
                $(this).parent('.proUpdate').prev('.Quickchange').show();
                // divcha.prev('button.changePrices').show();
                e.preventDefault();
            })
        });

    },
    
    changeSort: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var savesort = $('.savesort');
        savesort.each(function() {
            $(this).click(function() {

                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var sort_val = $('#sort'+$(this).data('id')).val();
                // console.log(sort_val);
                // console.log(price);

                if (sort_val=='') {
                    sort_val = 999;
                }
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                       id : $(this).data('id'),
                       field : 'sort',
                       value_post : sort_val,
                   },
                   success: function(data) {
                    box.hide();
                    var boxprice = box.prev('button.Quickchange');
                    boxprice.show();
                    boxprice.text(data.postValue);
                        console.log(data);
                        // console.log(boxprice);
                    }
                });

                
                return false;
            })
        })

    },
    /*changePriceSale: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var savePriceSale = $('.savePrice_sale');
        savePriceSale.each(function() {
            $(this).click(function() {
                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var value_post = $('#price_sale'+$(this).data('id')).val();

                if (value_post=='') {
                    alert('Bạn phải nhập giá thứ 2 sản phẩm')
                }else{
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'JSON',
                        data : {
                           id : $(this).data('id'),
                           field : 'price_sale',
                           value_post : value_post,
                       },
                       success: function(data) {
                            box.hide();
                            var boxprice = box.prev('button.Quickchange');
                            boxprice.show();
                            boxprice.text(data.postValue);
                        }
                    });
                }

                
                return false;
            })
        })

    },*/
    changeProName: function() {
        
        // LUU VAO CSDL SU DUNG AJAX
        var saveproName = $('.saveproName');
        saveproName.each(function() {
            $(this).click(function() {
                var boxName = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var value_post = $('#proName'+$(this).data('id')).val();
                // console.log($(this).data('id'));

                if (value_post=='') {
                    alert('Bạn phải nhập tên sản phẩm')
                }else{
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data : {
                           id : $(this).data('id'),
                           field : 'proName',
                           value_post : value_post,
                       },
                       success: function(data) {
                            // $(this).parent('.proUpdate').hide();
                            boxName.hide();
                            var proname = boxName.prev('span.Quickchange');
                            proname.show();
                            proname.text(data.postValue);
                            proname.parent('td').attr("width","auto");
                            // console.log(data);
                            // console.log(boxprice);

                        }
                    });
                }

                
                return false;
            })
        })

    },
    /*changeLocation: function() {
        // LUU VAO CSDL SU DUNG AJAX
        var savelocation = $('.savelocation');
        savelocation.each(function() {
            $(this).click(function() {

                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var value_post = $('#location'+$(this).data('id')).val();
                            // console.log(value_post);

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                       id : $(this).data('id'),
                       field : 'location',
                       value_post : value_post,
                   },
                   success: function(data) {
                    //         // $('.changePrice_'+data.id).html(data.price).show();
                    // $(this).parent('.proUpdate').hide();
                    box.hide();
                    var buttonlocation = box.prev('.Quickchange');
                    buttonlocation.show();
                    buttonlocation.text(data.postValue);
                    box.parent('td').attr("width","auto");
                            // console.log(data);
                            // console.log(boxprice);
                        }
                    });
        return false;
    })
        })

    },
    changeStatus: function() {

        // LUU VAO CSDL SU DUNG AJAX
        var savestatus = $('.savestatus');
        savestatus.each(function() {
            $(this).click(function() {

                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var value_post = $('#status'+$(this).data('id')).val();

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                     id : $(this).data('id'),
                     field : 'status',
                     value_post : value_post,
                 },
                 success: function(data) {
                    //         // $('.changePrice_'+data.id).html(data.price).show();
                    // $(this).parent('.proUpdate').hide();
                    box.hide();
                    var buttonstatus = box.prev('span.Quickchange ');
                    buttonstatus.show();
                    buttonstatus.text(data.postValue);
                    box.parent('td').attr("width","auto");
                            // console.log(data);
                            // console.log(boxprice);
                        }
                    });
                return false;
            })
        })

    },
    changeMotorbike: function() {

        // LUU VAO CSDL SU DUNG AJAX
        var savebike_id = $('.savebike_id');
        savebike_id.each(function() {
            $(this).click(function() {

                var box = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var field = $(this).data('field');
                var value_post = $('#bike_id'+$(this).data('id')).val();
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'JSON',
                    data : {
                     id : $(this).data('id'),
                     field : field,
                     value_post : value_post,
                 },
                 success: function(data) {
                            box.hide();
                            var bikeID = box.prev('span.Quickchange ');
                            bikeID.show();
                            bikeID.text(data.postValue);
                            // box.parent('td').attr("width","auto");
                            box.parent('td').css("width", "auto");
                            // console.log(data);
                        }
                    });
                return false;
            })
        })

    },*/
};

$(document).ready(function() {
    Product.ClickButton();
    // Product.saveGuarantees();
    Product.changeSort();
    // Product.changePriceSale();
    // Product.changeProName();
    // Product.changeLocation();
    // Product.changeStatus();
    // Product.changeMotorbike();
});
