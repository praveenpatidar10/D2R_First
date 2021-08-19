$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
   
    
    
      var SUBSCRBIERTABLE = $('#subscribers-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/subscribers/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "name", "className":'text-center'},
                    {"data" : "email", "className":'text-center'},
                    {"data" : "group", "className":'text-center'},
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
                    
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        SUBSCRBIERTABLE.columns(i).search(v).draw();
   });
   
   
    $(document).on('click', '.btn-status', function (e) { 
        var title =$(this).attr('data-email');
        var id =$(this).attr('data-id');
        var status =($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status=='Active'){
          st ='Inactive';typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Inactive subscribers: </i> <strong>"+title+"</strong>? </p>";
        }else{
          st ='Active';typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Live subscribers: </i> <strong>"+title+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/subscriber/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         SUBSCRBIERTABLE.ajax.reload();
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
        var title =$(this).attr('data-email');
        var id =$(this).attr('data-id');
        
        $.confirm({
            icon:'fas fa-trash',
          title: 'Confirmation',
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to delete subscribers?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/subscriber/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         SUBSCRBIERTABLE.ajax.reload();
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
    
    $("#ImportSubscriberForm").validate({
        rules: {'import_file': { required: true }},
        messages: {'import_file':{ required: "Choose csv file to import data"}},
        errorPlacement: function(error, element) {error.insertAfter(element)},
        submitHandler: function (form) {
            $('#btn-save').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-save').prop('disabled', true);
            $('#btn-save').attr('disabled', true);
             var formData = new FormData($('#ImportSubscriberForm')[0]); 
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/subscribers/import/',
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
                                 $('#btn-save').html('Loading..');
                                 
                            if($.trim(result.status)=='success'){
                                toastr.success(result.message, 'Success');
                                 SUBSCRBIERTABLE.ajax.reload();
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

    });
   
  
});