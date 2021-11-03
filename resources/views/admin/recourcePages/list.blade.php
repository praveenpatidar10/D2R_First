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
                        <h3 class="card-title">{{$subtitle}}</h3>
                        <div class="card-tools">
                          <a href="{{url('admin/resources/manage')}}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Create New Resources">
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
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Resources title" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </tbody></table>
                        <table class="table table-bordered table-hover" id="resources-datatable">
                          <thead>                  
                            <tr>
                              <th>#</th>
                              <th>Title</th>
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

