@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD New Blog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="BlogForm" action="{{url('admin/blogs/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Blog Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" value="{{isset($blog)?$blog->title:''}}">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                                    <textarea class="textarea" placeholder="Place some text here" name="description" id="description"
                          style="width: 100%; height:400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        {{isset($blog)?(html_entity_decode($blog->description)):''}}
                                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="blogImage">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="blogImage" name="blogImage">
                        <label class="custom-file-label" for="blogImage">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">-->
                      <!--  <span class="input-group-text" id="">Upload</span>-->
                      <!--</div>-->
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($blog))
                          <input type="hidden" name="id" id="id" value="{{$blog->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($blog)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection