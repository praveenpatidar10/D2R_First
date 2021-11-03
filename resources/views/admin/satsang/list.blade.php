 @extends('layouts.admin')
    @section('content')
    <style>
        .remove-image {
display: none;
position: absolute;
top: -10px;
right: 0px;
border-radius: 10em;
padding: 2px 6px 3px;
text-decoration: none;
font: 700 21px/20px sans-serif;
background: #555;
border: 3px solid #fff;
color: #FFF;

box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
  text-shadow: 0 1px 2px rgba(0,0,0,0.5);
  -webkit-transition: background 0.5s;
  transition: background 0.5s;
}
.remove-image:hover {
 background: #E54E4E;
  padding: 3px 7px 5px;
  top: -11px;
right: -1px;
}
.remove-image:active {
 background: #E54E4E;
  top: -10px;
right: 0px;
}
    </style>
        <div  class="container-fluid">
            <div class="row">
                 
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">{{$subtitle}}</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                         <form id="uploadGalleryForm" action="{{url('admin/subscribers/import/')}}" enctype="multipart/form-data" method="POST">
                           @csrf
                           <div class="row">
                               
                               <div class="col-md-6">
                                   <div class="form-group">
                                    <label for="galleryTitle" style="padding: 6px;">Image Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="galleryTitle" name="galleryTitle" placeholder="Enter Title" >
                                  </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                    <label for="galleryImage" style="padding: 6px;">Choose File to upload in Gallery<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="galleryImage" name="galleryImage" placeholder="Choose File" >
                                  </div>
                               </div>
                                <div class="col-md-2"><button id="btn-save" style="margin-top: 45px;" type="submit" class="btn btn-success">UPLOAD</button></div>
                           </div>
                           
                            
                        </form>
                        
                        
                        
                      </div>
                      <!-- /.card-body -->
                    </div>
                    
                    <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Galleries
                </div>
              </div>
              <div class="card-body">
                <div class="row" id="galleryElem">
                    @foreach($images as $img)
                      <div class="col-sm-2" id="image-icon-{{$img->id}}">
                        <a href="{{asset('images/'.$img->image)}}" data-toggle="lightbox" data-title="{{$img->title}}" data-gallery="gallery">
                          <img style="width:100%;height: 185px;border: 1px solid #ccc;box-shadow: 0px 0px 4px #ccc;" src="{{asset('images/'.$img->image)}}" class="img-fluid mb-2" alt="{{$img->title}}"/>
                           <a class="remove-image btn-delete" data-id="{{$img->id}}" href="#" style="display: inline;">&#215;</a>
                        </a>
                      </div>
                    @endforeach
                </div>
              </div>
            </div>
                   </div>
            </div>
        </div>
     @endsection

