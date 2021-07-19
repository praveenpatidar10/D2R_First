@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD New Template</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="TemplateForm" action="{{url('admin/templates/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                    <p><code>Subscriber Name : {subscriber_name}</code></br><code>Subscriber Email :{subscriber_email}</code></p>
                  <div class="form-group">
                    <label for="title">Subject</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter email subject" value="{{isset($temp)?$temp->title:''}}">
                  </div>
                  <div class="form-group">
                    <label for="description">Mail Body</label>
                        <textarea class="textarea summernote" placeholder="Place some text here" name="description" id="description"
                          style="width: 100%; height:400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($temp)?(html_entity_decode($temp->description)):''}}</textarea>
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($temp))
                          <input type="hidden" name="id" id="id" value="{{$temp->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($temp)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
