$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
   
    
     $(document).on('click', '.btn-delete', function (e) { 
        var title =$(this).attr('data-email');
        var id =$(this).attr('data-id');
        
        $.confirm({
         icon:'fas fa-trash',
          title: 'Confirmation',
          content: "<p style='color:red;'>Sure you want to delete image?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/galleries/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         $('#image-icon-'+id).remove();
                    }else{
                      toastr.error(resp.message, 'Error');
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
    
    $("#uploadGalleryForm").validate({
        rules: {'galleryImage': { required: true },'galleryTitle':{ required: true}},
        messages: {'galleryImage':{ required: "Choose image to upload"},'galleryTitle':{ required: "Image title is required"}},
        errorPlacement: function(error, element) {error.insertAfter(element)},
        submitHandler: function (form) {
            $('#btn-save').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-save').prop('disabled', true);
            $('#btn-save').attr('disabled', true);
             var formData = new FormData($('#uploadGalleryForm')[0]); 
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/galleries/save/',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btn-save').prop('disabled', true);
                        $('#btn-save').attr('disabled', true);
                    },
                    success: function(result){ //console.log(response);
                                 $('#btn-save').prop('disabled', false);
                                 $('#btn-save').attr('disabled', false);
                                 $('#btn-save').html('UPLOAD');
                                 
                            if($.trim(result.status)=='success'){
                                toastr.success(result.message, 'Success');
                                $("#uploadGalleryForm")[0].reset();
                                $('#galleryElem').prepend('<div class="col-sm-2" id="image-icon-'+result.data.id+'">'
                                                +'<a href="'+result.data.path+'" data-toggle="lightbox" data-title="'+result.data.title+'" data-gallery="gallery">'
                                                  +'<img style="width:100%;height: 185px;border: 1px solid #ccc;box-shadow: 0px 0px 4px #ccc;" src="'+result.data.path+'" class="img-fluid mb-2" alt="'+result.data.title+'"/>'
                                                   +'<a class="remove-image btn-delete" data-id="'+result.data.id+'" href="#" style="display: inline;">&#215;</a>'
                                                +'</a>'
                                              +'</div>');
                                 //SUBSCRBIERTABLE.ajax.reload();
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
    
   $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    // $('.btn[data-filter]').on('click', function() {
    //   $('.btn[data-filter]').removeClass('active');
    //   $(this).addClass('active');
    // });
   
  
});