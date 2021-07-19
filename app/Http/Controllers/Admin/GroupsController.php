<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Usergroup;
use App\Model\Groupmember;
use App\Model\Subscriber;

class GroupsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $templete=['title'=>'Groups','subtitle'=>'List Groups','Link'=>'groups','scripts'=>[asset('admin/dist/js/pages/groups.js')]];
        return view('admin.groups.list',$templete);
    }
    
    
    public function getGroupsDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $groupTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('usergroups');
        $query->select('*')
              ->when($groupTitle, function ($query, $groupTitle) {
                    return $query->where('group_name','like', '%'.$groupTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('usergroups')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['group_name']        = $each->group_name;
                //$eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View Description</a>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->group_name.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->group_name.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                 <a href="'.url('admin/group/members/'.$each->id).'" class="btn btn-success btn-sm "><i class="fas fa-plus"></i></a>
                                                <a href="#" data-id="'.$each->id.'" data-name="'.$each->group_name.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
                                                <a href="#" data-id="'.$each->id.'" data-title="'.$each->group_name.'" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                               </div>';  
             
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        return Response::json($json_data); 
   }
    
    public function groupMembers(Request $request){
        $group = Usergroup::where('id',$request->id)->first();
        $groupId = $request->id;
       
        $templete=['title'=>'Groups','subtitle'=>'Group Members('.$group->group_name.')','Link'=>'groups','group'=>$group,'scripts'=>[asset('admin/dist/js/pages/groups.js')]];
        $templete['groupmembers'] = DB::table("subscribers")->select('*')
                ->whereIn('id',function($query) use ($groupId){
                     $query->select('member_id')->where('group_id',$groupId)->from('groupmembers');
          })->get();
          
        $templete['othermembers'] = DB::table("subscribers")->select('*')
                        ->whereNOTIn('id',function($query) use ($groupId){
                             $query->select('member_id')->where('group_id',$groupId)->from('groupmembers');
                      })->get();
          
        return view('admin.groups.members',$templete);
    }
    
    public function  groupMembersManage(Request $request){
        if($request->param=='add'){
            $member = Subscriber::find($request->memberId);
            $gm = new Groupmember;
            $gm->member_id = $request->memberId;
            $gm->group_id = $request->groupId;
            $gm->save();
              return Response::json(['status'=>'success','message'=>$member->name.' successfully added to group','data'=>['name'=>$member->name,'email'=>$member->email]]);
        }else if($request->param=='remove'){
            $member = Subscriber::find($request->memberId);
             Groupmember::where('member_id',$request->memberId)->where('group_id',$request->groupId)->delete();
             return Response::json(['status'=>'success','message'=>$member->name.' successfully removed from group','data'=>['name'=>$member->name,'email'=>$member->email]]);
        }else{
            return Response::json(['status'=>'error','message'=>'Invalid access']);
        }
    }
    
    public function  saveGroups(Request $request){
       if(isset($request->id)){
            $group = Usergroup::find($request->id);
            $group->group_name= $request->groupName;
            $group->save();
            $msg = "Updated";
        }else{
            $group = new Usergroup;
            $group->group_name= $request->groupName;
           
            $group->save();
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Group '.$msg.' successfully.']);
    }
    
    
    function showGroupDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Usergroup::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $group = Usergroup::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.groups.blogDescription')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $group = Usergroup::find($request->id);
      $group->status= $request->status;
      if($group->save()){
          $message = ($request->status=='Active')?"Group marked as active successfully":"Group marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteGroup(Request $request){
        
       Usergroup::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Group successfully deleted "]);
    }
}
