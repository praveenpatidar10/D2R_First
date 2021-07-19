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
                         <div class="row">
                              <div class="col-md-6">
                                 <div class="card">
                                      <div class="card-header"><h3 class="card-title">Other Members</h3></div>
                                      <div class="card-body">
                                         <table class="table table-bordered">
                                              <tbody id="otherTbody">  
                                              @foreach($othermembers as $om)
                                                <tr id="othr-{{$om->id}}-{{$group->id}}">
                                                  <td><b>{{$om->name}}</b> - {{$om->email}}</td>
                                                  <td style="width: 40px"><a data-m="{{$om->id}}" data-g="{{$group->id}}" class="btn btn-sm btn-success btn-manage-group-member add-member">Add</a></td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                         </table>
                                      </div>
                                    </div>
                             </div><!-- left-->
                             <div class="col-md-6">
                                 <div class="card">
                                      <div class="card-header"><h3 class="card-title">Group Members</h3></div>
                                      <div class="card-body">
                                         <table class="table table-bordered">
                                              <tbody id="groupTbody">  
                                              @foreach($groupmembers as $gm)
                                                <tr id="grp-{{$gm->id}}-{{$group->id}}">
                                                  <td><b>{{$gm->name}}</b> - {{$gm->email}}</td>
                                                  <td style="width: 40px"><a data-m="{{$gm->id}}" data-g="{{$group->id}}"  class="btn btn-sm btn-danger btn-manage-group-member remove-member">Remove</a></td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                         </table>
                                      </div>
                                    </div>
                             </div><!-- right-->
                         </div>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>
                   </div>
            </div>
        </div>
     @endsection

