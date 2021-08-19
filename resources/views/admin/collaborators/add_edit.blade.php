@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD New Collaborator</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="CollaboratorForm" action="{{url('admin/collaborators/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="name">Collaborator Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter collaborator's name" value="{{isset($collaborator)?$collaborator->name:''}}">
                  </div>
                  <div class="form-group">
                    <label for="title">Collaborator Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter collaborator's title" value="{{isset($collaborator)?$collaborator->title:''}}">
                  </div>
                  
                  <div class="form-group">
                    <label for="collaboratorImage">Image  @if(!isset($collaborator))<span class="text-danger">*</span>  @endif</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="collaboratorImage" name="collaboratorImage">
                        <label class="custom-file-label" for="collaboratorImage">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">-->
                      <!--  <span class="input-group-text" id="">Upload</span>-->
                      <!--</div>-->
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($collaborator))
                          <input type="hidden" name="id" id="id" value="{{$collaborator->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($collaborator)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
