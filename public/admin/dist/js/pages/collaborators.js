$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
     var summernoteValidator =$("#CollaboratorForm").validate({
        rules: {
            'title': { required: true },
            'name': { required: true },
            'collaboratorImage':{  required: {
                         depends: function () { return $('#id').length == 0; }
                     }
                }
        },
        messages: {
           
            'title':{
                required: "title is required!",
             },
            'collaboratorImage':{
                required: "collaborator image is required!",
            },
            'name':{ required: "Enter collaborator name." },
        },
        
        errorPlacement: function(error, element) {
            console.log(element);
            var name = element.attr("name");
            if(name=="title"){
                error.insertAfter(element.parent('.form-group'));
            }else if(name=="collaboratorImage"){
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
             var formData = new FormData($('#CollaboratorForm')[0]); 
             var txt = ($('#id').length)?'Update':'Create';
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/collaborators/save/',
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
    
     
      var BLOGTABLE = $('#collaborators-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/collaborators/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "image","orderable":false , "className":'text-center'},
                    {"data" : "name","orderable":false , "className":'text-center'},
                    {"data" : "title","orderable":false , "className":'text-center'},
                    {"data" : "status","orderable":false , "className":'text-center'},
                    { "data": "action" ,"orderable":false, "className":'text-center'}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "25%", "targets": 3 },
                    { "width": "10%", "targets": 5 },
                    { "width": "20%", "targets": 5},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        BLOGTABLE.columns(i).search(v).draw();
   });
   
   
    $(document).on('click', '.btn-status', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        var status =($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status=='Active'){
          st ='Inactive';typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Inactive Collaborators: </i> <strong>"+title+"</strong>? </p>";
        }else{
          st ='Active';typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Active Collaborators: </i> <strong>"+title+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/collaborator/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         BLOGTABLE.ajax.reload();
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
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to Delete Collaborators?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/collaborator/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         BLOGTABLE.ajax.reload();
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