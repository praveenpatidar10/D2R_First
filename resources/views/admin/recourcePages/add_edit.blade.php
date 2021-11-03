@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$subtitle}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="ResourceForm" action="{{url('admin/resources/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title"> Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Resource title" value="{{isset($resource)?$resource->title:''}}">
                  </div>
                  <div class="form-group">
                    <label for="srcUrl">Video Url <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="srcUrl" name="srcUrl" placeholder="Enter video Url" value="{{isset($resource)?$resource->src_url:''}}">
                  </div>
                   <div class="form-group">
                    <label for="videoId"> video Id <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="videoId" name="videoId" placeholder="Enter video Id" value="{{isset($resource)?$resource->videoId:''}}">
                  </div>
                  <div class="form-group">
                    <label for="embed_code"> video Embed code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="embed_code" name="embed_code" placeholder="Enter video Embed code" value="{{isset($resource)?$resource->embed_code:''}}">
                  </div>
                  
                  <?php /*
                  <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="textarea summernote" placeholder="Place some text here" name="description" id="description"
                          style="width: 100%; height:400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($resource)?(html_entity_decode($resource->description)):''}}</textarea>
                  </div>
                  */?>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($resource))
                          <input type="hidden" name="id" id="id" value="{{$resource->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($resource)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
