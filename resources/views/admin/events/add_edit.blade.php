@extends('layouts.admin')

@section('content')
 <div class="row">
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ADD New Event</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="EventForm" action="{{url('admin/events/save/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Event Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter event title" value="{{isset($event)?$event->title:''}}">
                          </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eventDateTime">Event Date</label>
                                
                                <input type="text" class="form-control" id="eventDateTime" name="eventDateTime" placeholder="Enter event date" value="{{isset($event)?$dateTime:''}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                <label for="eventImage">Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="eventImage" name="eventImage">
                                    <label class="custom-file-label" for="eventImage">Choose file</label>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="eventLink">Event link</label>
                                <input type="text" class="form-control" id="eventLink" name="eventLink" placeholder="Enter event link" value="{{isset($event)?$event->link:''}}">
                          </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                                <textarea class="textarea" placeholder="Place some text here" name="description" id="description"
                                                        style="width: 100%; height:400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                    {{isset($event)?(html_entity_decode($event->description)):''}}
                                                </textarea>
                              </div>
                        </div>
                    </div>
                    <!--<div class="row">-->
                    <!--    <div class="col-md-12"></div>-->
                    <!--</div>-->
                    <!--<div class="row">-->
                    <!--    <div class="col-md-12"></div>-->
                    <!--</div>-->
                  
                  
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     @if(isset($event))
                          <input type="hidden" name="id" id="id" value="{{$event->id}}" >
                        @endif
                  <button type="submit" id="btn-save" class="btn btn-primary">{{isset($event)?'Update':'Create'}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
</div>
@endsection
