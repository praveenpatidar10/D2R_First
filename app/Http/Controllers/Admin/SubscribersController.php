<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Subscriber;
use Carbon\Carbon;
use DateTime;
use App\Imports\SubscribersImport;
use Maatwebsite\Excel\Facades\Excel;

class SubscribersController extends Controller
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
        $templete=['title'=>'Subscribers','subtitle'=>'List Subscribers','Link'=>'subscriber','scripts'=>[asset('admin/dist/js/pages/subscribers.js')]];
        return view('admin.subscribers.list',$templete);
    }
    
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
           Excel::import(new SubscribersImport, $request->file('import_file')->store('temp'));
           return Response::json(['status'=>'success','message'=>"Subscriber import successfully "]);
        }else{
         return Response::json(['status'=>'error','message'=>"Please choose file."]);
        }
    }

    
    
    public function getSubscribersDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $subscriberName = ($request->input('columns.0.search.value'))?:"";
         $subscriberEamil = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('subscribers');
        $query->select('*')
              ->when($subscriberName, function ($query, $subscriberName) {
                    return $query->where('subscribers.name','like', '%'.$subscriberName.'%');
                })
                ->when($subscriberEamil, function ($query, $subscriberEamil) {
                    return $query->where('subscribers.email','like', '%'.$subscriberEamil.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('subscribers')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['name']        = $each->name;
                $eachData['email']        = $each->email;
                $eachData['group']        = '<span class="badge bg-primary">'.$each->source_type.'</span>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-email="'.$each->email.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-email="'.$each->email.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="#" data-id="'.$each->id.'" data-email="'.$each->email.'" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
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
    
    
    public function statusUpdate(Request $request){
      $event = Subscriber::find($request->id);
      $event->status= $request->status;
      if($event->save()){
          $message = ($request->status=='Active')?"Subscriber marked as active successfully":"Subscriber marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteSubscriber(Request $request){
       Subscriber::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Subscriber successfully deleted "]);
    }
}
