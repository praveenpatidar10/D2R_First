$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
     $("#EventForm").validate({
        
        rules: {
            'title': { required: true },
            'eventLink': { required: true,url:true },
            'eventDateTime': { required: true },
            'description': { required: true },
            'eventImage':{  required: {
                         depends: function () { return $('#id').length == 0; }
                     }
                }
        },
        messages: {
           
            'title':{
                required: "Name is required!",
             },
             'eventLink':{
                required: "Event link is required!",
                url: "Invalid url provided.",
             },
             'eventDateTime':{
                required: "Choose event date-time",
             },
            'eventImage':{
                required: "Event image is required!",
            },
            'description':{ required: "Enter event description." },
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
            //console.log(element);
            var name = element.attr("name");
            if(name=="description"){
                error.insertAfter(element.parent('.form-group'));
            }else if(name=="eventImage"){
                error.insertAfter(element.parent().parent('.input-group'));
            }else{
              error.insertAfter(element);  
            }
         //error.insertAfter(element.parent().parent('.form-group'));
        },
        submitHandler: function (form) {
            $('#btn-save').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-save').prop('disabled', true);
            $('#btn-save').attr('disabled', true);
             var formData = new FormData($('#EventForm')[0]); 
             var txt = ($('#id').length)?'Update':'Create';
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/events/save/',
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
                                toastr.success(result.message, 'Success');
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
    
     $('.textarea').summernote();
     $('#eventDateTime').datetimepicker({minDate:0,formatDate:'d/m/Y',formatTime:'h:i A',format:'d/m/Y h:i A'});
      var EVENTTABLE = $('#events-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/events/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "title", "className":'text-center'},
                    {"data" : "link", "className":'text-center'},
                    {"data" : "eventDate", "className":'text-center'},
                    {"data" : "description","orderable":false , "className":'text-center'},
                    {"data" : "status","orderable":false , "className":'text-center'},
                    { "data": "action" ,"orderable":false, "className":'text-center'}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "15%", "targets": 3 },
                    { "width": "10%", "targets": 4},
                    { "width": "10%", "targets": 5},
                    { "width": "20%", "targets": 6},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        EVENTTABLE.columns(i).search(v).draw();
   });
   $('body').on('click','.view-desc',function(e){
      var id = $(this).attr('id'); 
       var title = $(this).attr('data-title'); 
       $.dialog({
                icon: 'icon ion-ios-list-outline',
                title:title,
                content: "url:"+base_url+"/admin/event/getDesc/"+id,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
   
    // $(document).on('click', '.btn-status', function (e) { 
    //     var title =$(this).attr('data-title');
    //     var id =$(this).attr('data-id');
    //     var status =($(this).attr('data-status'));
    //     var msg ="";var st=status;var typ="";
    //     if(status=='Active'){
    //       st ='Inactive';typ="red";
    //       msg = "<p style='color:red;'>Sure you want to <i> Inactive Event: </i> <strong>"+title+"</strong>? </p>";
    //     }else{
    //       st ='Active';typ="green";
    //       msg = "<p style='color:green;'>Sure you want to <i>Live Event: </i> <strong>"+title+"</strong>? </p>";
    //     }

    //     $.confirm({
    //       title: 'Confirmation',
    //       content: msg,
    //       type: typ,
    //       typeAnimated: true,
    //       buttons: {
    //           confirm: function () {
    //             $.get(base_url+"/admin/blog/status/update/"+id+"/"+st,function(resp) {
    //                 if($.trim(resp.status)=='success'){
    //                      toastr.success(resp.message, 'Success');
    //                      EVENTTABLE.ajax.reload();
    //                 }else{
    //                   toastr.error(resp.message, 'Error');
    //                 }
    //             },'json');
    //           },
    //           cancel: function () {
    //               // $.alert('Canceled!');
    //           }
    //       }
    //   });
 
    // });
    
     $(document).on('click', '.btn-delete', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        
        $.confirm({
            icon:'fas fa-trash',
          title: 'Confirmation',
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to Delete Blog?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/event/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         EVENTTABLE.ajax.reload();
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