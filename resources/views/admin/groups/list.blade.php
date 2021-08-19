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
            <form id="addGroupForm" action="{{url('admin/groups/save/')}}"  method="POST">
                  @csrf
                 <div  class="row">
                <div class="col-md-3"></div>
                 <div class="col-md-4">
                     <div class="form-group ">
                          <label for="groupName" class="form-label">Group Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="groupName" id="groupName" placeholder="Enter group name">
                     </div>
                 </div>
                 <div class="col-md-2">
                     <button  style="margin-top: 30px;" type="submit" id="btn-save" class="btn btn-block btn-success btn-flat">Create</button>
                 </div>
                <div class="col-md-3"></div>
            </div>
            </form>
            <div class="row">
                 
                  <div class="col-md-12">
                      <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">{{$subtitle}}</h3>
                        
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                         <table class="table filter-table ">
                            <tbody><tr>
                                <td style="width:70%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Search by group name" data-original-title="" title="">
                                    </div>
                               </td>
                              
                            </tr>
                            
                        </tbody></table>
                        <table class="table table-bordered table-hover" id="groups-datatable">
                          <thead>                  
                            <tr>
                              <th>#</th>
                              <th>Group Name</th>
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

