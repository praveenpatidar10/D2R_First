@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD New Ministries</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="MinistriesForm" action="{{url('admin/ministries/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Ministries Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Ministries title" value="{{isset($ministries)?$ministries->title:''}}">
                  </div>
                  <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="textarea summernote" placeholder="Place some text here" name="description" id="description"
                          style="width: 100%; height:400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($ministries)?(html_entity_decode($ministries->description)):''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ministriesImage">Image(1000*500)  @if(!isset($ministries))<span class="text-danger">*</span>  @endif</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="ministriesImage" name="ministriesImage">
                        <label class="custom-file-label" for="ministriesImage">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">-->
                      <!--  <span class="input-group-text" id="">Upload</span>-->
                      <!--</div>-->
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($ministries))
                          <input type="hidden" name="id" id="id" value="{{$ministries->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($ministries)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
