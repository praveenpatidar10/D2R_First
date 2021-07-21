 @extends('layouts.admin')
    @section('content')
    <style>
       .select2-container .select2-selection--single {
          height: 36px;
       }
       .select2-container--default .select2-selection--single .select2-selection__rendered { margin-top: -5px; }
    </style>
        <div  class="container-fluid">
            <div class="row">
                 
                  <div class="col-md-12">
                      <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">{{$subtitle}}</h3>
                      </div>
                      <!-- /.card-header -->
                     <form id="sendmailForm" action="{{url('admin/sendmail')}}" enctype="multipart/form-data" method="POST">
                          @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="groupId">Choose Goup</label>
                                        <select name="groupId"  id="groupId" class="select2 select2-hidden-accessible"  data-placeholder="Select a Group" data-dropdown-css-class="select2-purple" style="width: 100%;"  aria-hidden="true">
                                              <option value="">Select</option>
                                              @foreach($groups as $group)
                                              <option value="{{$group->id}}">{{$group->group_name}}</option>
                                              @endforeach
                                        </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempId">Choose Email Template</label>
                                        <select   name="tempId"  id="tempId" class="select2 select2-hidden-accessible"  data-placeholder="Select a Template" data-dropdown-css-class="select2-purple" style="width: 100%;"  aria-hidden="true">
                                             <option value="">Select</option>
                                              @foreach($templates as $tm)
                                              <option value="{{$tm->id}}">{{$tm->title}}</option>
                                              @endforeach
                                        </select>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mailbox-read-info">
                                    <h5>Message Receiver Is Placed Here</h5>
                                    <h6>To: <span id="receiverList"></span> </h6>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                     <div class="mailbox-read-info">
                                        <h5>Message Body Is Placed Here</h5>
                                        <div id="messageBody"></div>
                                      </div>
                                </div>
                            </div>
                           
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            
                          <button type="submit" id="btn-save" class="btn btn-primary">Send</button>
                        </div>
                      </form>
                      <!-- /.card-body -->
                      
                    </div>
                   </div>
            </div>
        </div>
     @endsection

