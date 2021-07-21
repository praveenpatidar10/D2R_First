$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    
     $("#subscriptionForm").validate({
        rules: {
            '_subName': { required: true },
            '_subEmail': { required: true,email:true }
        },
        messages: {
           
            '_subName':{
                required: "Required",
             },
            '_subEmail':{
                required: "Required",
                email:"Invalid"
            },
           
        },
         highlight: function(element) {
            $(element).addClass('has-error');
           // $(element).css('margin-bottom','0px');
        },
        unhighlight: function(element) {
            $(element).removeClass('has-error');
           //  $(element).css('margin-bottom','15px');
        },
        errorPlacement: function(error, element) {
            return true;
        },
        submitHandler: function (form) {
            $('._subsButton').prop('disabled', true);
            $('._subsButton').attr('disabled', true);
            $.post(base_url+"/user-subscribe.htm",$('#subscriptionForm').serialize() ,function( result ) {
                 if($.trim(result.status)=='success'){
                         $('#subscriptionForm')[0].reset();
                         $('._subsButton').prop('disabled', false);
                         $('._subsButton').attr('disabled', false);
                        toastr.success(result.message, 'Success');
                    }else{
                         $('._subsButton').prop('disabled', false);
                         $('._subsButton').attr('disabled', false);
                        toastr.error(result.message, 'Error');
                    }
            },'json');
            
            return false;
        }

    });
    
     $("#contactUsForm").validate({
        rules: {
            '_contactName': { required: true },
            '_contactEmail': { required: true,email:true },
            '_contactDesc':{required: true}
        },
        messages: {
           
            '_contactName':{
                required: "Required",
             },
            '_contactEmail':{
                required: "Required",
                email:"Invalid"
            },
            '_contactDesc':{
                required: "Required",
             },
           
        },
         highlight: function(element) {
            $(element).addClass('has-error');
           // $(element).css('margin-bottom','0px');
        },
        unhighlight: function(element) {
            $(element).removeClass('has-error');
           //  $(element).css('margin-bottom','15px');
        },
        errorPlacement: function(error, element) {
            return true;
        },
        submitHandler: function (form) {
            $('._contactusButton').prop('disabled', true);
            $('._contactusButton').attr('disabled', true);
            $.post(base_url+"/post-enquiry.htm",$('#contactUsForm').serialize() ,function( result ) {
                 if($.trim(result.status)=='success'){
                         $('#contactUsForm')[0].reset();
                         $('._contactusButton').prop('disabled', false);
                         $('._contactusButton').attr('disabled', false);
                        toastr.success(result.message, 'Success');
                    }else{
                         $('._contactusButton').prop('disabled', false);
                         $('._contactusButton').attr('disabled', false);
                        toastr.error(result.message, 'Error');
                    }
            },'json');
            
            return false;
        }

    });
});