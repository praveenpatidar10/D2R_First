@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$resource->title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body table-responsive p-0">
                    
                  <table class="table table-hover">
                  
                  <tbody>
                    <tr>
                      <th>Tite</th>
                      <td>{{$resource->title}}</td>
                    </tr>
                     <tr>
                      <th>Video Url </th>
                      <td>{{$resource->src_url}}</td>
                    </tr>
                    <tr>
                      <th>video ID</th>
                      <td>{{$resource->videoId}}</td>
                    </tr>
                    <tr>
                      <th>Embed Code</th>
                      <td>{{$resource->embed_code}}</td>
                    </tr>
                  </tbody>
                </table>
                
                </div>
                </div>
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Video Indexing</h3>
                  </div>
                <div class="card-body">
                    <form action="#" method="POST" id="FormCreateIndex">
                         @csrf
                         <input type="hidden" name="resourceId" id="resourceId" value="{{$resource->id}}"/>
                       <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="index_title">Index Title</label>
                                <input type="text" class="form-control" id="index_title" name="index_title" placeholder="Enter title">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="labelTime">Video label Time</label>
                                <input type="text" class="form-control" id="labelTime" name="labelTime" placeholder="Ex: 0:01:20">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="indexTime">Video index Time</label>
                                <input type="text" class="form-control" id="indexTime" name="indexTime" placeholder="Ex: 80">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button style="margin-top: 30px;" id="btnSaveIndex" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    </form>
                   <table class="table table-hover">
                  <thead>  
                    <tr>
                      <th>Title</th>
                      <th>Label</th>
                      <th>index(seconds)</th>
                    </tr>
                  </thead>
                  <tbody id="indexBody">
                      @foreach($Indexes as $indx)
                    <tr id="index-tr-{{$indx->id}}">
                      <th>{{$indx->title}}</th>
                      <td>{{$indx->labelTime}}</td>
                      <td>{{$indx->indexTime}}</td>
                       <td><a href="#" data-id="{{$indx->id}}" data-title="{{$indx->title}}" class="btn btn-danger btn-sm btn-delete-index"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
