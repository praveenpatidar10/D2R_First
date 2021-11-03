<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Resources;
use App\Model\ResourceIndexing;

class ResourcesController extends Controller
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
        $templete=['title'=>'Resources','subtitle'=>'List Resources','Link'=>'resources','scripts'=>[asset('admin/dist/js/pages/resources.js')]];
        return view('admin.recourcePages.list',$templete);
    }
    
    public function getResourcesDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $blogTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('resources');
        $query->select('*')
              ->when($blogTitle, function ($query, $blogTitle) {
                    return $query->where('title','like', '%'.$blogTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('resources')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                $eachData['srcUrl']       = '<a data-title="'.$each->title.'" class="view-desc" data-href="'.$each->src_url.'" id="'.$each->id.'">View</a>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/resources/view/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-success btn-sm "><i class="fas fa-eye"></i></a>
                                                <a href="'.url('admin/resources/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
                                                <a href="#" data-id="'.$each->id.'" data-title="'.$each->title.'" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
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
        $templete=['title'=>'Resources','Link'=>'resources','scripts'=>[asset('admin/dist/js/pages/resources.js')]];
        if(isset($request->param)){ 
             $templete['resource'] = Resources::find($request->param);
             $templete['subtitle']='Edit Resource';
        }else{
            $templete['subtitle']='Add Resource';
        }
        return view('admin.recourcePages.add_edit',$templete);
    }
    
    public function view(Request $request){
        $templete=['title'=>'Resources','Link'=>'resources','scripts'=>[asset('admin/dist/js/pages/resources.js')]];
        $templete['resource'] = Resources::find($request->param);
        $templete['Indexes'] = ResourceIndexing::orderBy('id','ASC')->where('resourceId',$request->param)->get();
        $templete['subtitle']='View Resource';
        
        return view('admin.recourcePages.view',$templete);
    }
    
    public function saveResourcesVideoIndexing(Request $request){
            $ResourcesInd = new ResourceIndexing;
            $ResourcesInd->title= $request->index_title;
            $ResourcesInd->labelTime= $request->labelTime;
            $ResourcesInd->indexTime= $request->indexTime;
            $ResourcesInd->resourceId = $request->resourceId;
            $ResourcesInd->save();
            $HTML = '<tr id="index-tr-'.$ResourcesInd->id.'">
                      <th>'.$request->index_title.'</th>
                      <td>'.$request->labelTime.'</td>
                      <td>'.$request->indexTime.'</td>
                      <td><a href="#" data-id="'.$ResourcesInd->id.'" data-title="'.$request->index_title.'" class="btn btn-danger btn-sm btn-delete-index"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>';
          return Response::json(['status'=>'success','data'=>$HTML,'message'=>'Indexing added successfully.']);  
    }
    
    public function  saveResources(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $Resources = Resources::find($request->id);
            $Resources->title= $request->title;
            $Resources->src_url= $request->srcUrl;
            $Resources->videoId= $request->videoId;
            $Resources->embed_code= $request->embed_code;
            $Resources->description="TEXT";// htmlentities($_POST['description']);
            $Resources->save();
            $id=$Resources->id;
            $msg = "Updated";
        }else{
            $Resources = new Resources;
            $Resources->title= $request->title;
            $Resources->src_url= $request->srcUrl;
            $Resources->videoId= $request->videoId;
            $Resources->embed_code= $request->embed_code;
            $Resources->description= "TEXT";//htmlentities($_POST['description']);
            
            $Resources->save();
            $id=$Resources->id;
            $msg = "Created";
        }
        return Response::json(['status'=>'success','data'=>$id,'param'=>$msg,'message'=>'Resource '.$msg.' successfully.']);
    }
    
    function showResourcesDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Resources::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $blog = Resources::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.recourcePages.resourcesDescription')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $Resources = Resources::find($request->id);
      $Resources->status= $request->status;
      if($Resources->save()){
          $message = ($Resources->status=='Active')?"Resource marked as active successfully":"Resource marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function deleteResourcesIndex(Request $request){
       ResourceIndexing::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Resource index successfully deleted "]);
    }
    
     public function deleteResources(Request $request){
       Resources::where('id',$request->id)->delete();
       ResourceIndexing::where('resourceId',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Resource successfully deleted "]);
    }
}
