$(function () {

  'use strict'
   var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
     var summernoteValidator =$("#EventForm").validate({
         ignore: ':hidden:not(.summernote),.note-editable.card-block',
        rules: {
            'title': { required: true },
            'eventLink': { required: true,url:true },
            'eventDateTime': { required: true },
            'description': { required: true },
            'eventImage':{  required: {
                         depends: function () { return $('#id').length == 0; }
                     }
                
            },
            'eventThumbnail':{ 
                required: {
                         depends: function () { return $('#id').length == 0; }
                     }
                
            },
                    'YouTubeUrl':{ 
                        required: {
                         depends: function () { return $('#YouTubeUrl').length == 0; }
                       },
                       url: {
                         depends: function () { return $('#YouTubeUrl').length == 0; }
                       }
                }
        },
        messages: {
           
            'title':{
                required: "Title is required!",
             },
             'eventLink':{
                required: "Event link is required!",
                url: "Invalid url provided.",
             },
             
             'eventDateTime':{
                required: "Choose event date-time",
             },
             'eventThumbnail':{
                required: "Event Thumbnail is required!",
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
            }else if(name=="eventThumbnail"){
                error.insertAfter(element.parent().parent('.input-group'));
            }else if (element.hasClass("summernote")) {
                error.insertAfter(element.siblings(".note-editor"));
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
    
     var summernoteElement = $('.summernote');
     summernoteElement.summernote({
        height: 200,
        callbacks: {
            onChange: function (contents, $editable) {
                // Note that at this point, the value of the `textarea` is not the same as the one
                // you entered into the summernote editor, so you have to set it yourself to make
                // the validation consistent and in sync with the value.
                summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);

                // You should re-validate your element after change, because the plugin will have
                // no way to know that the value of your `textarea` has been changed if the change
                // was done programmatically.
                summernoteValidator.element(summernoteElement);
            }
        }
    });
     
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
                     {"data" : "youtubelink", "className":'text-center'},
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
                    { "width": "10%", "targets": 6},
                    { "width": "10%", "targets": 7},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        EVENTTABLE.columns(i).search(v).draw();
   });
   
   
    var EVENTTABLEPast = $('#events-datatable-past').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/admin/events/getdatatable-past",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "title", "className":'text-center'},
                    {"data" : "link", "className":'text-center'},
                     {"data" : "recordlink", "className":'text-center'},
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
                    { "width": "10%", "targets": 6},
                    { "width": "10%", "targets": 7},
                 
                  ],
            } );
 
    $('.search-input-text-past').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        EVENTTABLEPast.columns(i).search(v).draw();
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
   
     $(document).on('click', '.btn-status-live', function (e) { 
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
        var status =($(this).attr('data-status'));
       var st ='Past';
       var typ="red";
       var msg = "<p style='color:red;'>Sure you want to mark as <i>Past Event: </i> <strong>"+title+"</strong>? </p>";
       

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/admin/event/status/update/"+id+"/"+st,function(resp) {
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
     
      $(document).on('click', '.btn-status-new', function (e) {  
        var title =$(this).attr('data-title');
        var id =$(this).attr('data-id');
       $.confirm({
            icon:'fas fa-youtube',
            type: 'green',
            title: "Mark as live",
            content: '<p>'+title+'</p>'
                      +'<div class="form-group">'
                         +'<label>Youtube Url</label>'
                         +'<input type="url" id="youtube_url" class="form-control" value="" placeholder="Enter youtube url">'
                       +'</div>'
                       +'<p>Once update youtube url your event will be marked as LIVE.</p>',
            buttons: {
                sayMyName: {
                    text: 'UPDATE',
                    btnClass: 'btn-success',
                    action: function(){
                        var input = this.$content.find('input#youtube_url');
                        var errorText = this.$content.find('.text-danger');
                        if(!input.val().trim()){
                            $.alert({
                                content: "Please don't keep the url field empty.",
                                type: 'red'
                            });
                            return false;
                        }else{
                            //$.alert('Hello ' + input.val() + ', i hope you have a great day!');
                            
                            $.post(base_url+"/admin/events/mark-live/",{id:id,_url:input.val()},function(resp) {
                                if($.trim(resp.status)=='success'){
                                       toastr.success(resp.message, 'Success');
                                       $('#markHomeDisplay').empty();
                                       $('#markHomeDisplay').html(resp.html);
                                       EVENTTABLE.ajax.reload();
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
    
     $('body').on('click','#btnHomeDisplay',function(e){
         var val = $('#markHomeDisplay').val();
         $.post(base_url+"/admin/events/mark-home-display/",{val:val},function(resp) { 
             if($.trim(resp.status)=='success'){
                 toastr.success(resp.message, 'Success');
                }else{
                  toastr.error(resp.message, 'Error');
                }
         },'json');
     })
   
  
});