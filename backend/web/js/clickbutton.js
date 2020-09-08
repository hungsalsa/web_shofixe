jQuery(document).ready(function($) {
    

$('#blockbtn1').click(function() {
        $('div.block1').block({
            message: null
        });
    });
    $('#blockbtn2').click(function() {
        $('div.block2').block({
            message: '<h3>Please Wait...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn3').click(function() {
        $('div.block3').block({
            message: '<h3>Please Wait...</h3>',
            overlayCSS: {
                backgroundColor: '#02bec9'
            },
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn4').click(function() {
        $('div.block4').block({
            message: '<p style="margin:0;padding:8px;font-size:24px;">Just a moment...</p>',
            css: {
                color: '#fff',
                border: '1px solid #fb9678',
                backgroundColor: '#fb9678'
            }
        });
    });
    $('#blockbtn5').click(function() {
        $('div.block5').block({
            message: '<h4><img src="../plugins/images/busy.gif" /> Just a moment...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn6').click(function() {
        $('div.block6').block({
            message: $('#domMessage'),
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#unblockbtn1').click(function() {
        $('div.block1').unblock();
    });
    $('#unblockbtn2').click(function() {
        $('div.block2').unblock();
    });
    $('#unblockbtn3').click(function() {
        $('div.block3').unblock();
    });
    $('#unblockbtn4').click(function() {
        $('div.block4').unblock();
    });
    $('#unblockbtn5').click(function() {
        $('div.block5').unblock();
    });
    $('#unblockbtn6').click(function() {
        $('div.block6').unblock();
    });
    });