var Product =
{
    ClickButton: function(){
        // Click để thay đổi
        var link = $('.Quickchange');
        link.each(function() {
            $(this).click(function(e) {
                $(this).hide();
                    width_ = "10%";
                if ($(this).data('field') =='order') {
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
    
    changeorder: function() {
        
        // LUU VAO CSDL SU DUNG AJAX
        var saveorder = $('.saveorder');
        saveorder.each(function() {
            $(this).click(function() {
                var boxName = $(this).parent('.proUpdate');
                var url = $(this).data('url');
                var value_post = $('#order'+$(this).data('id')).val();
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
                           field : 'order',
                           value_post : value_post,
                       },
                       success: function(data) {
                            // $(this).parent('.proUpdate').hide();
                            boxName.hide();
                            var order = boxName.prev('span.Quickchange');
                            order.show();
                            order.text(data.postValue);
                            order.parent('td').attr("width","auto");
                            // console.log(data);
                            // console.log(boxprice);

                        }
                    });
                }

                
                return false;
            })
        })

    },
    
};

$(document).ready(function() {
    Product.ClickButton();
    Product.changeorder();
    // Product.saveGuarantees();
    // Product.changePrice();
    // Product.changePriceSale();
    // Product.changeLocation();
    // Product.changeStatus();
    // Product.changeMotorbike();
});
