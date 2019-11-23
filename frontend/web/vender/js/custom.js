//Tab Tin mới | Xem nhiều | Videos
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
//Tin nổi bật
$(document).ready(function(){       
    var clickEvent = false; 
    $('#myCarousel').carousel({ 
        interval:   4000    
    }).on('click', '.list-group li', function() {   
        clickEvent = true;  
        $('.list-group li').removeClass('active');  
        
        $(this).addClass('active'); 
        
    }).on('slid.bs.carousel', function(e) { 
        if(!clickEvent) {   
            var count = $('.list-group').children().length -1;  
            var current = $('.list-group li.active');   
            current.removeClass('active').next().addClass('active');    
            var id = parseInt(current.data('slide-to'));    
            if(count == id) {
               $('.list-group li').first().addClass('active'); 
           }   
       }   
       clickEvent = false; 
   });

    var boxheight = $('#myCarousel .carousel-inner').innerHeight();    
    var itemlength = $('#myCarousel .item').length;    
    var triggerheight = Math.round(boxheight/itemlength+1); 
    // $('#myCarousel .list-group-item').outerHeight(triggerheight);



    $(window).scroll(function(){ 
    if ($(this).scrollTop() > 100) { //thực hiện lệnh điều kiện Khi lăn chuột xuống dưới hơn 100px
      $('#back-to-top').fadeIn(); //Xuất hiện nút
    } else { 
      $('#back-to-top').fadeOut(); //Ngược lại thì ẩn nút
    } 
  }); 
  $('#back-to-top').click(function(){ 
    $("html, body").animate({ scrollTop: 0 }, 600); //Animation giúp hoạt ảnh scroll ngược lên đầu trang sẽ mượt hơn
    return false; 
  }); 

  $("img.lazy_image").show().lazyload({
        effect : "fadeIn",
        threshold: 1400,
        event : "mouseover"
    });

})
/*$(function() {
    $("img.lazy_image").show().lazyload({
        effect : "fadeIn",
        threshold: 500,
        event : "mouseover"
    });
});*/