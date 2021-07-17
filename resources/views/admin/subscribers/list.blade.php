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
                        
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                         <table class="table filter-table ">
                            <tbody><tr>
                                <td style="width:40%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Search by name" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder=" Search by email" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </tbody></table>
                        <table class="table table-bordered table-hover" id="subscribers-datatable">
                          <thead>                  
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Group</th>
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

