$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
   $("#MailSettingForm").validate({
        rules: {
            'mail_driver': { required: true },
            'mail_host': { required: true },
            'mail_port': { required: true },
            'mail_username': { required: true },
            'mail_password': { required: true },
            'mail_encryption': { required: true },
            'mail_from_address': { required: true },
            'mail_from_name': { required: true },
        },
        
        errorPlacement: function(error, element) {
           error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('#btn-mail-setup').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-mail-setup').prop('disabled', true);
            $('#btn-mail-setup').attr('disabled', true);
             var formData = new FormData($('#MailSettingForm')[0]); 
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/settings/save-mail-setting/',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btn-mail-setup').prop('disabled', true);
                        $('#btn-mail-setup').attr('disabled', true);
                    },
                    success: function(result){ //console.log(response);
                                 $('#btn-mail-setup').prop('disabled', false);
                                 $('#btn-mail-setup').attr('disabled', false);
                                 $('#btn-mail-setup').html('UPDATE');
                                 
                            if($.trim(result.status)=='success'){
                                toastr.success(result.message, 'Success');
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
    
    $("#update-button-homeVideoContent").on('click', function(e) {
         e.preventDefault();
              var form = $( "#VideoContentForm" ).serialize();
              $.post(base_url+'/admin/settings/update/site-setting/',form,function(res){
                  if($.trim(res.status)=="success"){
                            clearcatch();
                            toastr.success(res.message);
                        }else{
                           toastr.error(res.message);
                        }
              },'json')
   });
    
   $("#upload-button-logo").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-logo").click();
   });
   
   $(".file-upload-logo").on('change', function(){ 
        var formData = new FormData($('#form-upload-logo')[0]); 
        formData.append('column','website_logo');
        console.log(formData);
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','logo')
   })
   
   
   $("#upload-button-satsang_logo").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-satsang_logo").click();
   });
   
   $(".file-upload-satsang_logo").on('change', function(){ 
        var formData = new FormData($('#form-upload-satsang_logo')[0]); 
        formData.append('column','satsang_logo');
        //console.log(formData);
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','satsang_logo')
   })
   
   
   
   $("#upload-button-homeVideo").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-homeVideo").click();
   });
   
   $(".file-upload-homeVideo").on('change', function(){ 
        var formData = new FormData($('#form-upload-homeVideo')[0]); 
        formData.append('column','website_homeVideo');
        console.log(formData);
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','homeVideo');
    })
    
    $("#upload-button-aboutus").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-aboutus").click();
   });
   
   $(".file-upload-aboutus").on('change', function(){ 
        var formData = new FormData($('#form-upload-aboutus')[0]); 
        formData.append('column','website_aboutus');
       // console.log(formData);
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','aboutus');
    })
    
   
    
    $("#upload-button-contactLeftImage").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-contactLeftImage").click();
    });
   
   $(".file-upload-contactLeftImage").on('change', function(){ 
        var formData = new FormData($('#form-upload-contactLeftImage')[0]); 
        formData.append('column','contact_left_image');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','contactLeftImage');
    })
    
    
   $("#upload-button-newletterIcon").on('click', function(e) {
         e.preventDefault();
      $(".file-upload-newletterIcon").click();
    });
   
   $(".file-upload-newletterIcon").on('change', function(){ 
        var formData = new FormData($('#form-upload-newletterIcon')[0]); 
        formData.append('column','newletter_icon');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','newletterIcon');
    })
    
    
    $("#upload-button-subscribeIcon").on('click', function(e) {
        e.preventDefault();
      $(".file-upload-subscribeIcon").click();
    });
   
   $(".file-upload-subscribeIcon").on('change', function(){ 
        var formData = new FormData($('#form-upload-subscribeIcon')[0]); 
        formData.append('column','subscribe_icon');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','subscribeIcon');
    })
    
    $("#upload-button-headerAbout").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerAbout").click();
    });
    $(".file-upload-headerAbout").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerAbout')[0]); 
        formData.append('column','page_header_about');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerAbout');
    })
    
    $("#upload-button-headerEvent").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerEvent").click();
    });
    $(".file-upload-headerEvent").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerEvent')[0]); 
        formData.append('column','page_header_event');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerEvent');
    })
    
    $("#upload-button-headerMinistries").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerMinistries").click();
    });
   
   $(".file-upload-headerMinistries").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerMinistries')[0]); 
        formData.append('column','page_header_ministries');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerMinistries');
    })
    
    
    $("#upload-button-headerBlog").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerBlog").click();
    });
   $(".file-upload-headerBlog").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerBlog')[0]); 
        formData.append('column','page_header_blog');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerBlog');
    })
    
    $("#upload-button-headerGallery").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerGallery").click();
    });
   
   $(".file-upload-headerGallery").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerGallery')[0]); 
        formData.append('column','page_header_gallery');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerGallery');
    })
    
    $("#upload-button-headerContactus").on('click', function(e) {
         e.preventDefault();
         $(".file-upload-headerContactus").click();
    });
   
   $(".file-upload-headerContactus").on('change', function(){ 
        var formData = new FormData($('#form-upload-headerContactus')[0]); 
        formData.append('column','page_header_contactus');
        ajaxFormPost(formData,'/admin/settings/update/site-setting/','headerContactus');
    })
    
    
   
   function ajaxFormPost(formData, actionURL,elem){
        $('#progressBar-'+elem).show();
        $('#progressBar-striped-'+elem).css('width', '0');
        $.ajax({
            url: base_url+actionURL,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:"json",
            // this part is progress bar
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('#progressBar-striped-'+elem).text(percentComplete + '%');
                        $('#progressBar-striped-'+elem).css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                 //console.log(data);
                 $('#progressBar-'+elem).hide();
                if($.trim(data.status)=="success"){
                    $('#progressBar-striped-'+elem).css('width', '0');
                    clearcatch();
                    if(elem=='homeVideo'){
                        $('#uploaded-elem-'+elem).get(0).pause();
                        $('#uploaded-'+elem).attr('src', data.path);
                        $('#uploaded-elem-'+elem).get(0).load();
                        $('#uploaded-elem-'+elem).get(0).play();
                    }else{
                         $('#uploaded-'+elem).attr('src', data.path);
                    }
                    toastr.success(data.message);
                }else{
                   toastr.error(data.message);
                }
                
            }
        });
    }
    
   function clearcatch(){
       $.get(base_url+'/clear-cache',function(res){})
   }
  
});