<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Collaborators;

class CollaboratorsController extends Controller
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
        $templete=['title'=>'Collaborators','subtitle'=>'List Collaborators','Link'=>'collaborators','scripts'=>[asset('admin/dist/js/pages/collaborators.js')]];
        return view('admin.collaborators.list',$templete);
    }
    
    
    public function getCollaboratorsDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $collaboratorTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('collaborators');
        $query->select('*')
              ->when($collaboratorTitle, function ($query, $collaboratorTitle) {
                    return $query->where('title','like', '%'.$collaboratorTitle.'%')
                                 ->orWhere('name','like', '%'.$collaboratorTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('collaborators')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['image']        = '<img alt="Avatar" class="table-avatar" src="'.asset('public/images/'.$each->image).'">';
                $eachData['name']       = $each->name;
                 $eachData['title']       = $each->title;
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/collaborators/manage/'.$each->id).'"  data-name="'.$each->name.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
                                                <a href="#" data-id="'.$each->id.'" data-title="'.$each->name.'" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
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
    
    public function manage(Request $request){
        $templete=['title'=>'Collaborators','Link'=>'collaborators','scripts'=>[asset('admin/dist/js/pages/collaborators.js')]];
        if(isset($request->param)){ 
             $templete['collaborator'] = Collaborators::find($request->param);
             $templete['subtitle']='Edit Collaborator';
        }else{
            $templete['subtitle']='Add Collaborator';
        }
        return view('admin.collaborators.add_edit',$templete);
    }
    
    public function  saveCollaborators(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $collaborator = Collaborators::find($request->id);
            if($request->hasFile('collaboratorImage')){
                $image_path = "public/images/".$collaborator->image;
                if(File::exists($image_path)) { File::delete($image_path); }
                $fileName = 'Collaborator-'.uniqid().'.'.request()->collaboratorImage->getClientOriginalExtension();
                $request->collaboratorImage->move('public/images/', $fileName);
                $collaborator->image=$fileName;
            }
           $collaborator->name= ucwords(strtolower($request->name));
            $collaborator->title= ucwords(strtolower($request->title));
            $collaborator->save();
            $msg = "Updated";
        }else{
            $collaborator = new Collaborators;
            $collaborator->name= ucwords(strtolower($request->name));
            $collaborator->title= ucwords(strtolower($request->title));
            
            $fileName = 'Collaborator-'.uniqid().'.'.request()->collaboratorImage->getClientOriginalExtension();
            $request->collaboratorImage->move('public/images/', $fileName);
            $collaborator->image=$fileName;
            $collaborator->save();
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Collaborator '.$msg.' successfully.']);
    }
    
    public function statusUpdate(Request $request){
      $collaborator = Collaborators::find($request->id);
      $collaborator->status= $request->status;
      if($collaborator->save()){
          $message = ($request->status=='Active')?"Collaborator marked as active successfully":"Collaborator marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteCollaborator(Request $request){
        $collaborator = Collaborators::find($request->id);
        $image_path = "public/images/".$collaborator->image;
        if(File::exists($image_path)) { File::delete($image_path); }
       Collaborators::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Collaborator successfully deleted "]);
    }
}
