$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    
     var GROUPTABLE = $('#groups-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/groups/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "group_name", "className":'text-center'},
                   // {"data" : "description","orderable":false , "className":'text-center'},
                    {"data" : "status","orderable":false , "className":'text-center'},
                    { "data": "action" ,"orderable":false, "className":'text-center'}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "15%", "targets": 3 },
                   // { "width": "10%", "targets": 4},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        GROUPTABLE.columns(i).search(v).draw();
   });
   
   
     $("#addGroupForm").validate({
        
        rules: {
            'groupName': { required: true },
        },
        messages: {
           
            'groupName':{
                required: "Group name is required!",
             }
        },
        //  highlight: function(element) {
        //     $(element).parent().parent('.form-group').addClass('has-error');
        //     $(element).parent().parent('.form-group').css('margin-bottom','0px');
        // },
        // unhighlight: function(element) {
        //     $(element).parent().parent('.form-group').removeClass('has-error');
        //      $(element).parent().parent('.form-group').css('margin-bottom','15px');
        // },
    
        submitHandler: function (form) {
            $('#btn-save').html('<i class="fa fa-spinner fa-spin"></i> Loading');
            $('#btn-save').prop('disabled', true);
            $('#btn-save').attr('disabled', true);
             var formData = new FormData($('#addGroupForm')[0]); 
    
            $.ajax({
                    type: 'POST',
                    url: base_url+'/admin/groups/save/',
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
                                 $('#btn-save').html('Create');
                                 
                            if($.trim(result.status)=='success'){
                                 $('#addGroupForm')[0].reset();
                                   GROUPTABLE.ajax.reload();
                                toastr.success(result.message, 'Success');
                            }else{
                                toastr.error(result.message, 'Error');
                            }
                    }
                });
            
            return false;
        }

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
   
    $(document).on('click', '.btn-status', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        var status =($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status=='Active'){
          st ='Inactive';typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Inactive Event: </i> <strong>"+title+"</strong>? </p>";
        }else{
          st ='Active';typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Live Event: </i> <strong>"+title+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/group/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         GROUPTABLE.ajax.reload();
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
          content: "<p>"+title+"</p><p style='color:red;'>Sure you want to Delete Group?</p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/group/delete/"+id,function(resp) {
                    if($.trim(resp.status)=='success'){
                         toastr.success(resp.message, 'Success');
                         GROUPTABLE.ajax.reload();
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
    
    $(document).on('click', '.btn-edit', function (e) {  
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
    $.confirm({
            icon:'fas fa-edit',
            type: 'green',
            title: 'Edit group :'+name,
            content: '<div class="form-group">'
                         +'<label>Group Name</label>'
                         +'<input type="text" id="cat-name" class="form-control" value="'+name+'" placeholder="Enter group name">'
                       +'</div>',
            buttons: {
                sayMyName: {
                    text: 'UPDATE',
                    btnClass: 'btn-success',
                    action: function(){
                        var input = this.$content.find('input#cat-name');
                        var errorText = this.$content.find('.text-danger');
                        if(!input.val().trim()){
                            $.alert({
                                content: "Please don't keep the name field empty.",
                                type: 'red'
                            });
                            return false;
                        }else{
                            //$.alert('Hello ' + input.val() + ', i hope you have a great day!');
                            
                            $.post(base_url+"/admin/groups/save/",{id:id,groupName:input.val()},function(resp) {
                                if($.trim(resp.status)=='success'){
                                       toastr.success(resp.message, 'Success');
                                       GROUPTABLE.ajax.reload();
                                }else{
                                  toastr.error(resp.message, 'Error');
                                }
                            },'json');
                        }
                    }
                },
                later: function(){
                    // do nothing.
                }
            }
        });
    });
   
  
});