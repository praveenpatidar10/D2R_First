<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Template;

class TemplateController extends Controller
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
        $templete=['title'=>'Templates','subtitle'=>'List Templates','Link'=>'templates','scripts'=>[asset('admin/dist/js/pages/templates.js')]];
        return view('admin.templates.list',$templete);
    }
    
    
    public function getTemplatesDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $templateTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('templates');
        $query->select('*')
              ->when($templateTitle, function ($query, $templateTitle) {
                    return $query->where('title','like', '%'.$templateTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('templates')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                $eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View Description</a>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/templates/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
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
        $templete=['title'=>'Templates','Link'=>'templates','scripts'=>[asset('admin/dist/js/pages/templates.js')]];
        if(isset($request->param)){ 
             $templete['temp'] = Template::find($request->param);
             $templete['subtitle']='Edit Template';
        }else{
            $templete['subtitle']='Add Template';
        }
        return view('admin.templates.add_edit',$templete);
    }
    
    public function  saveTemplates(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $template = Template::find($request->id);
            $template->title= $request->title;
            $template->description= htmlentities($_POST['description']);
            $template->save();
            $msg = "Updated";
        }else{
            $template = new Template;
            $template->title= $request->title;
            $template->description= htmlentities($_POST['description']);
            $template->save();
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Template '.$msg.' successfully.']);
    }
    
    
    function showTemplateDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Template::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $template = Template::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.templates.description',$template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $template = Template::find($request->id);
      $template->status= $request->status;
      if($template->save()){
          $message = ($request->status=='Active')?"Template marked as active successfully":"Template marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteTemplate(Request $request){
        Template::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Template successfully deleted "]);
    }
}
