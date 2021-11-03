$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
     var summernoteValidator =$("#ResourceForm").validate({
        // ignore: ':hidden:not(.summernote),.note-editable.card-block',
        rules: {
            'title': { required: true },
            'srcUrl': { required: true ,url:true},
            'videoId': { required: true },
            'embed_code': { required: true },
         //   'description': { required: true },
        },
        messages: {
           
            'title':{
                required: "title is required!",
             },
             'srcUrl':{
                required: "Video url is required!",
             },
             'videoId':{
                required: "videoId is required!",
             },
             'embed_code':{
                required: "Embed Code is required!",
             },
           // 'description':{ required: "Enter description." },
        },
        //  highlight: function(element) {
        //     $(element).parent().parent('.form-group').addClass('has-error');
        //     $(element).parent().parent('.form-group').css('margin-bottom','0px');
        // },
        // unhighlight: function(element) {
        //     $(element).parent().parent('.form-group').removeClass('has-error');
        //      $(element).parent().parent('.form-group').css('margin-bottom','15px');
        // },
        errorPlacement: function(error, element) {
            console.log(element);
            var name = element.attr("name");
            if(name=="description"){
                error.insertAfter(element.parent('.form-group'));
            }else if (element.hasClass("summernote")) {
                error.insertAfter(element.siblings(".note-editor"));
            }else{
              error.insertAfter(element);  
            }
         //error.insertAfter(element.parent().parent('.form-group'));
        },
        submitHandler: function (form) {
            $('#btnUpdateUser').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btnUpdateUser').prop('disabled', true);
            $('#btnUpdateUser').attr('disabled', true);
             var formData = new FormData($('#ResourceForm')[0]); 
             var txt = ($('#id').length)?'Update':'Create';
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/resources/save/',
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
                                 $('#btn-save').html(txt);
                                 
                            if($.trim(result.status)=='success'){
                                setTimeout(function(){ window.location.href=base_url+"/admin/resources/view/"+result.data }, 3000);
                                toastr.success(result.message, 'Success');
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
    
    //  var summernoteElement = $('.summernote');
    //  summernoteElement.summernote({
    //     height: 200,
    //     callbacks: {
    //         onChange: function (contents, $editable) {
    //             // Note that at this point, the value of the `textarea` is not the same as the one
    //             // you entered into the summernote editor, so you have to set it yourself to make
    //             // the validation consistent and in sync with the value.
    //             summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);

    //             // You should re-validate your element after change, because the plugin will have
    //             // no way to know that the value of your `textarea` has been changed if the change
    //             // was done programmatically.
    //             summernoteValidator.element(summernoteElement);
    //         }
    //     }
    // });
     
      var TABLE = $('#resources-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/resources/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "title", "className":'text-center'},
                    {"data" : "srcUrl","orderable":false , "className":'text-center'},
                    {"data" : "status","orderable":false , "className":'text-center'},
                    { "data": "action" ,"orderable":false, "className":'text-center'}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "10%", "targets": 3 },
                    { "width": "20%", "targets": 4},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        TABLE.columns(i).search(v).draw();
   });
   $('body').on('click','.view-desc',function(e){
      var id = $(this).attr('id'); 
       var title = $(this).attr('data-title'); 
       $.dialog({
                icon: 'icon ion-ios-list-outline',
                title:title,
                content: "url:"+base_url+"/admin/resources/getDesc/"+id,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
   
    $(document).on('click', '.btn-status', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        var status =($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status=='Active'){
          st ='Inactive';typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Inactive Resource: </i> <strong>"+title+"</strong>? </p>";
        }else{
          st ='Active';typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Active Resource: </i> <strong>"+title+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/resources/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         TABLE.ajax.reload();
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
    
    $(document).on('click', '.btn-delete', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        
        $.confirm({
            icon:'fas fa-trash',
          title: 'Confirmation',
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to Delete Resource?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/resources/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         TABLE.ajax.reload();
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
   
   
   $("#FormCreateIndex").validate({
        rules: {
            'index_title': { required: true },
            'labelTime': { required: true},
            'indexTime': { required: true },
        },
        messages: {
           
            'index_title':{
                required: "title is required!",
             },
             'labelTime':{
                required: "Video index time is required",
             },
             'indexTime':{
                required: "Video index time is required",
             },
             
        },
       
        errorPlacement: function(error, element) {
           
              error.insertAfter(element);  
        },
        submitHandler: function (form) {
            $('#btnSaveIndex').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btnSaveIndex').prop('disabled', true);
            $('#btnSaveIndex').attr('disabled', true);
             var formData = new FormData($('#FormCreateIndex')[0]); 
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/resources/video-indexing/save/',
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
                                 $('#btnSaveIndex').prop('disabled', false);
                                 $('#btnSaveIndex').attr('disabled', false);
                                 $('#btnSaveIndex').html("Save");
                            if($.trim(result.status)=='success'){
                                toastr.success(result.message, 'Success');
                                $('#FormCreateIndex')[0].reset();
                                $('#indexBody').append(result.data);
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
    
     $(document).on('click', '.btn-delete-index', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        
        $.confirm({
            icon:'fas fa-trash',
          title: 'Confirmation',
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to Delete Resource Index?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/resources/video-index/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         $('#index-tr-'+id).remove();
                         toastr.success(resp.message, 'Success');
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
   
  
});