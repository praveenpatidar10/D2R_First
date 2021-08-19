 @extends('layouts.admin')
    @section('content')
    <style>
        .btn-status:hover{
            cursor:pointer;
        }
        .dataTables_filter{
          display:none;
      }
    </style>
        <div  class="container-fluid">
            <div class="row">
                 
                  <div class="col-md-12">
                      <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Upcomming & Live Events</h3>
                        <div class="card-tools">
                                <div class="input-group input-group-sm" style="width:500px;float: left;margin-top: 0px;margin-right: 56px;">
                                    <select id="markHomeDisplay" class="form-control float-right">
                                        <option value="none">None</option>
                                         @foreach($liveRows as $lv)
                                         <?php $date=date_create($lv->eventDate);?>
                                         <option value="{{$lv->id}}" @if($lv->homeDisplay=='YES') selected @endif>{{$lv->title}} - {{date_format($date,"F d,Y")}}</option>
                                        @endforeach
                                    </select>
                                   <div class="input-group-append">
                                    <button id="btnHomeDisplay" type="button" class="btn btn-default">Update as Home display</button>
                                  </div>
                              </div>
                          <a href="{{url('admin/events/manage')}}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Create New Blog">
                            <i class="fas fa-plus"></i> Create
                          </a>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                         <table class="table filter-table ">
                            <tbody><tr>
                                <td style="width:70%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Event title" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </tbody></table>
                        <table class="table table-bordered table-hover" id="events-datatable">
                          <thead>                  
                            <tr>
                              <th>#</th>
                              <th>Title</th>
                              <th>Register Link</th>
                              <th>Live Link</th>
                              <th>Event Date</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>
                   </div>
                   
                     
                  <div class="col-md-12">
                      <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Past Event</h3>
                        <div class="card-tools">
                          <a href="{{url('admin/events/manage')}}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Create New Blog">
                            <i class="fas fa-plus"></i> Create
                          </a>
                          
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                         <table class="table filter-table ">
                            <tbody><tr>
                                <td style="width:70%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text-past" data-column="0" type="text" placeholder="Event title" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </tbody></table>
                        <table class="table table-bordered table-hover" id="events-datatable-past">
                          <thead>                  
                            <tr>
                              <th>#</th>
                              <th>Title</th>
                              <th>Register Link</th>
                              <th>Recording Link</th>
                              <th>Event Date</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>
                   </div>
            </div>
        </div>
     @endsection

