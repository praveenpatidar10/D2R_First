<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Ministries;

class MinistriesController extends Controller
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
        $templete=['title'=>'Ministries','subtitle'=>'List Ministries','Link'=>'ministries','scripts'=>[asset('admin/dist/js/pages/ministries.js')]];
        return view('admin.ministries.list',$templete);
    }
    
    
    public function getMinistriesDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $ministrieTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('ministries');
        $query->select('*')
              ->when($ministrieTitle, function ($query, $ministrieTitle) {
                    return $query->where('title','like', '%'.$ministrieTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('ministries')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                $eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View Description</a>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/ministries/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
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
        $templete=['title'=>'Ministries','Link'=>'ministries','scripts'=>[asset('admin/dist/js/pages/ministries.js')]];
        if(isset($request->param)){ 
             $templete['ministries'] = Ministries::find($request->param);
             $templete['subtitle']='Edit Ministries';
        }else{
            $templete['subtitle']='Add Ministries';
        }
        return view('admin.ministries.add_edit',$templete);
    }
    
    public function  saveMinistries(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $ministries = Ministries::find($request->id);
            
            $error = false;
            if($request->hasFile('ministriesImage')){
                $Size = getimagesize(request()->ministriesImage);
                $_width = $Size[0];$_height = $Size[1];
                $error = ($_width==1000 && $_height==500)?false:true;
            }
            
            if($error==true){
                 return Response::json(['status'=>'error','param'=>'Updated','message'=>'Incorrect image size for image ,please enter image with size(1000*500)']);
            }else{
                if($request->hasFile('ministriesImage')){
                    $image_path = "public/images/".$ministries->image;
                    if(File::exists($image_path)) { File::delete($image_path); }
                    $fileName = 'Ministries-'.uniqid().'.'.request()->ministriesImage->getClientOriginalExtension();
                    $request->ministriesImage->move('public/images/', $fileName);
                    $ministries->image=$fileName;
                }
                $ministries->title= $request->title;
                $ministries->description= htmlentities($_POST['description']);
                $ministries->save();
                $msg = "Updated";  
                return Response::json(['status'=>'success','param'=>$msg,'message'=>'Ministries '.$msg.' successfully.']);
            }
        }else{
            
                $error = false;
                if($request->hasFile('ministriesImage')){
                    $Size = getimagesize(request()->ministriesImage);
                    $_width = $Size[0];$_height = $Size[1];
                    $error = ($_width==1000 && $_height==500)?false:true;
                }
                
                if($error==true){
                     return Response::json(['status'=>'error','param'=>'Created','message'=>'Incorrect image size for image ,please enter image with size(1000*500)']);
                }else{
                
                $ministries = new Ministries;
                $ministries->title= $request->title;
                $ministries->description= htmlentities($_POST['description']);
                
                $fileName = 'Ministries-'.uniqid().'.'.request()->ministriesImage->getClientOriginalExtension();
                $request->ministriesImage->move('public/images/', $fileName);
                $ministries->image=$fileName;
                $ministries->save();
                $msg = "Created";
                return Response::json(['status'=>'success','param'=>$msg,'message'=>'Ministries '.$msg.' successfully.']);
            }
        }
       
    }
    
    
    function showMinistriesDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Ministries::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $ministries = Ministries::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.ministries.ministriesDescription')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $ministries = Ministries::find($request->id);
      $ministries->status= $request->status;
      if($ministries->save()){
          $message = ($request->status=='Active')?"Ministries marked as active successfully":"Ministries marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteMinistries(Request $request){
        $ministries = Ministries::find($request->id);
        $image_path = "public/images/".$ministries->image;
        if(File::exists($image_path)) { File::delete($image_path); }
       Ministries::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Ministries successfully deleted "]);
    }
}
