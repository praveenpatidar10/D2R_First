$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    
    $('.select2').select2();
    
     $(document).on('change click', '#groupId', function (e) {  
         var val = $(this).val();
        if(val!=""){
         $.get(base_url+"/admin/mail/get-group-mail/"+val,function(resp) {
             
                    if($.trim(resp.status)=='success'){
                         //toastr.success(resp.message, 'Success');
                         $('#receiverList').text(resp.data);
                    }else{
                      toastr.error(resp.message, 'Error');
                    }
                },'json');
         }
     });
     $(document).on('change click', '#tempId', function (e) {  
         var val = $(this).val();
          if(val!=""){
         $.get(base_url+"/admin/template/getDesc/"+val,function(resp) {
             
                    // if($.trim(resp.status)=='success'){
                    //      //toastr.success(resp.message, 'Success');
                      $('#messageBody').html(resp);
                      $('#messageBody').css({'border': '1px solid #ccc','padding': '5px 10px','margin-top': '12px'});
                    // }else{
                    //   toastr.error(resp.message, 'Error');
                    // }
                });
          }
     });
     
       $("#sendmailForm").validate({
        
        rules: {
            'groupId': { required: true },
             'tempId': { required: true },
        },
        messages: {
           
            'groupId':{
                required: "Choose Group to send mail",
             },
              'tempId':{
                required: "Choose Template for mail",
             }
        },
          errorPlacement: function(error, element) {
               if(element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                }
        },
    
        submitHandler: function (form) {
            $('#btn-save').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-save').prop('disabled', true);
            $('#btn-save').attr('disabled', true);
             var formData = new FormData($('#sendmailForm')[0]); 
    
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/sendmail/',
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
                                 $('#btn-save').html('Send');
                                 
                            if($.trim(result.status)=='success'){
                                  $('#sendmailForm')[0].reset();
                                  $('#tempId').val("");
                                  $('#tempId').select2().trigger('change');
                                  $('#groupId').val("");
                                  $('#groupId').select2().trigger('change');
                                  $('#messageBody').empty();
                                  $('#receiverList').text("");
                                toastr.success(result.message, 'Success');
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
  
});