var host = window.location.href; //backend
host = host.split("backend");
tinymce.init({
  selector: "textarea.content",
    theme: "modern",
    width: '',
    height: 100,
    theme_advanced_buttons3_add : "tablecontrols",
    plugins: [
        "table",
         "code advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager fullscreen"
   ],
   toolbar1: "code undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | media | link unlink anchor | print preview fullscreen",
    menubar: false,
    toolbar_items_size: 'small',
    relative_urls: false,
    remove_script_host:false,

    filemanager_title:"Responsive Filemanager",
    // filemanager_crossdomain: true,
    external_filemanager_path: host[0]+"filemanager/",
    external_plugins: { "filemanager" : host[0]+"filemanager/plugin.min.js"},
    filemanager_access_key:"59504ba894ee6616c76df4baa31dcf2f" ,
  
   image_advtab: true,
   image_title: true,
   image_description: true,
  image_dimensions: true,
  // image_class_list: [
  //     { title: "Responsive", value: "lazy img-responsive img-post" }
  // ]
  // image_list: function (success) {
  //     $.ajax({
  //         url: "/Image/List",
  //         type: "GET",
  //         dataType: "json",
  //         success: function (data) {
  //             success(data);
  //         }
  //     });
  // },

 });

// $(document).ready(function() {
//   $("#imageFile").click(function (event) {
//     $("#myModal").modal('show');
//   })

//   $("#imageMenu").click(function (event) {
//     $("#myModal").modal('show');
//   })

//   $('#myModal').on('hidden.bs.modal', function () {
//     imgsrc = $("#imageFile").val();
//     $("#previewImage").attr('src', imgsrc);
//   })
// });