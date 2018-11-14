var host = window.location.href; //backend
host = host.split("backend");



// tinymce.init({
//   selector: 'textarea',
//   height: 500,
//   theme: 'modern',
//   plugins: 'code print preview fullpage searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help responsivefilemanager',
//   toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
//   toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview fullscreen code",
// // menubar: "tools",
//   filemanager_title:"Responsive Filemanager",
//     filemanager_crossdomain: true,
//     external_filemanager_path: host[0]+"filemanager/",
//     external_plugins: { 
//     	"filemanager" : host[0]+"filemanager/plugin.min.js"
//     },


//   image_advtab: true,
//   templates: [
//     { title: 'Test template 1', content: 'Test 1' },
//     { title: 'Test template 2', content: 'Test 2' }
//   ],
//   content_css: [
//     '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
//     '//www.tinymce.com/css/codepen.min.css'
//   ]
//  });


tinymce.init({
  selector: "textarea.content",
    theme: "modern",
    height: 120,
    // width: 220,
    plugins: [
         "code advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager fullscreen"
   ],
   toolbar1: "code undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "responsivefilemanager | image | media | link unlink anchor | print preview fullscreen",
    menubar: false,
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host:false,

    filemanager_title:"Quản lý file",
    // filemanager_crossdomain: true,
    external_filemanager_path: host[0]+"filemanager/",
    external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
    filemanager_access_key:"86d93af342a8b8ac53b8d1cc42949f34",


// file_browser_callback : 'myFileBrowser',

  
   image_advtab: true,
   image_title: true,
   image_description: true,
  image_dimensions: true,
  image_class_list: [
      { title: "Responsive", value: "lazy img-responsive img-post" }
  ],
  image_list: function (success) {
      $.ajax({
          url: "/Image/List",
          type: "GET",
          dataType: "json",
          success: function (data) {
              success(data);
          }
      });
  },

 });



 $(document).ready(function(){

  // alert('adsa');
	// demo.initChartist();

	// $.notify({
	// 	icon: 'pe-7s-gift',
	// 	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

	// },{
	// 	type: 'info',
	// 	timer: 4000
	// });

	$('#product-start_sale').datepicker({ dateFormat: 'dd-mm-yy',firstDay: 1, numberOfMonths: 2,changeMonth: true,
    changeYear: true, });
	$('#product-end_sale').datepicker({ dateFormat: 'dd-mm-yy' });

  // $("#imageFile").click(function (event) {
  //   $("#myModal").modal();
  // })

  $('#myModal').on('hidden.bs.modal', function () {
    imgsrc = $("#imageFile").val();
    $("#previewImage").attr('src', imgsrc);
})



function ChangeToSlug()
{
    var title, slug;
 
    //Lấy text từ thẻ input title 
    title = document.getElementById("title_slug").value;
 
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('slug_url').value = slug;
}
  
  $("#title_slug").blur(function(event) {
    ChangeToSlug();
  });

  
});