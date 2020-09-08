$(document).ready(function() {
    $('#DeleteAll').click(function() {
        var keys = $('#grid').yiiGridView('getSelectedRows');
        var url = $(location).attr('href');
        // console.log(url);
        $.post({
            url: url + '/delete-multiple',
            dataType: 'json',
            data: {
                keylist: keys
            },

        });


    });
});
var ProductIndex =
{
    changePrice: function() {
        var link = $('.changePrice');
        link.each(function() {
            $(this).click(function(e) {
                $(this).hide();
                // alert($(this).data('id'));
                // $('.inputPriceList_'+$(this).data('id')).show();
                $('.inputPriceList_'+$(this).data('id')).show().addClass('clickquantity');
                e.preventDefault();
            })
        });
        var submitButton = $('.savePriceBtn');
        submitButton.each(function() {
            $(this).click(function() {alert($(this));
                var box = $(this).parents('.boxInput');
                var url = box.data('url');
        //         var newValue = box.find('.inputValue').val();
        //         $.ajax({
        //             url: url + '?newValue='+newValue,
        //             type: 'GET',
        //             dataType: 'JSON',
        //             success: function(data) {
        //                 $('.changePrice_'+data.id).html(data.price).show();
        //                 box.hide();
        //             }
        //         });
        //         return false;
            })
        });

        var submitReset = $('.btnReset');
        submitReset.each(function () {
            $(this).click(function() {
                $(this).parent('div.boxInput').hide().prev('a.changePrice').show()
            })
        });
    }    
};
// $(document).ready(function() {
    ProductIndex.changePrice();
    // ProductIndex.changeOrder();
// });

