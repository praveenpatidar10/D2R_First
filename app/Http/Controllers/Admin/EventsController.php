<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Event;
use Carbon\Carbon;
use DateTime;

class EventsController extends Controller
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
        
        $templete=['title'=>'Events','subtitle'=>'List Events','Link'=>'events','scripts'=>[asset('admin/dist/js/pages/events.js')]];
        $templete['liveRows'] = DB::table('events')->where('status','Live')->get();
        return view('admin.events.list',$templete);
    }
    
    function homeDisplayMark(Request $request){
        if($request->val=='none'){
            DB::table('events')->where('homeDisplay','YES')->update(['homeDisplay'=>'NO']);
            return Response::json(['status'=>'success','message'=>'Event removed form home page']); 
        }else{
           $rowCnt = DB::table('events')->where('status','Live')->where('id',$request->val)->count();
           if($rowCnt){
             DB::table('events')->where('homeDisplay','YES')->update(['homeDisplay'=>'NO']);
             DB::table('events')->where('id',$request->val)->update(['homeDisplay'=>'YES']);
              return Response::json(['status'=>'success','message'=>'Event displayed on home page']); 
           }else{
              return Response::json(['status'=>'error','message'=>'Selected event is not Live.']); 
           }
        }
    }
    
    
    public function getEventsDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $eventTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('events')->whereIn('status',['Live','New']);
        $query->select('*')
              ->when($eventTitle, function ($query, $eventTitle) {
                    return $query->where('title','like', '%'.$eventTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('events')->whereIn('status',['Live','New'])->count();
        $result=[];$i=1;
         foreach($brands as $each){
             //$each->status=='New'
              
                $eachData=array();
                 $eachData['youtubelink']="-";
            //  if($each->status=='Past'){
            //       $eachData['status'] ='<span class="badge bg-danger" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Past</span>';
            //       $eachData['youtubelink'] = '<a href="'.$each->youtube_link.'">'.$each->youtube_link.'</a>';
            //   }else
              
              if($each->status=='Live'){
                    $eachData['status'] =' <span>Click here to Mark Past </span></br><span class="badge bg-success btn-status-live" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Live</span>';
                    $eachData['youtubelink'] = ($each->youtube_link!="")?'<a href="'.$each->youtube_link.'">'.$each->youtube_link.'</a>':'<span class="text-danger">Update YouTube link to go live.</span>';
              }else{
                   $eachData['status'] ='<span>Click here to Mark live </span></br><span class="badge bg-warning btn-status-new" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Upcoming</span>';
              }
              
             
              
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                 $eachData['link']        = '<a href="'.$each->link.'" target="_blank">'.$each->link.'</a>';
                 
                 $eachData['eventDate']        = Carbon::createFromFormat('Y-m-d H:i:s', $each->eventDate)->format('d/m/Y h:i A');
                $eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View</a>';
                // $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                //                                               :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/events/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
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
   
     public function getEventsDatatablePast(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $eventTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('events')->where('status','Past');
        $query->select('*')
              ->when($eventTitle, function ($query, $eventTitle) {
                    return $query->where('title','like', '%'.$eventTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('events')->where('status','Past')->count();
        $result=[];$i=1;
         foreach($brands as $each){
             //$each->status=='New'
              
                $eachData=array();
                $eachData['status'] ='<span class="badge bg-danger " data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Past</span>';
                $eachData['recordlink'] = ($each->recording_link!="")?'<a href="'.$each->recording_link.'">'.$each->youtube_link.'</a>':'<span class="text-danger">Update recording link.</span>';
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                 $eachData['link']        = '<a href="'.$each->link.'" target="_blank">'.$each->link.'</a>';
                 
                 $eachData['eventDate']        = Carbon::createFromFormat('Y-m-d H:i:s', $each->eventDate)->format('d/m/Y h:i A');
                $eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View</a>';
                // $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                //                                               :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/events/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
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
        $templete=['title'=>'Events','Link'=>'events','scripts'=>[asset('admin/dist/js/pages/events.js')]];
        if(isset($request->param)){ 
             $templete['event'] = Event::find($request->param);
             $templete['dateTime'] = Carbon::createFromFormat('Y-m-d H:i:s', $templete['event']->eventDate)->format('d/m/Y h:i A');
             $templete['subtitle']='Edit Event';
        }else{
            $templete['subtitle']='Add Event';
        }
        return view('admin.events.add_edit',$templete);
    }
    
    public function  saveEvents(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $event = Event::find($request->id);
            if($request->hasFile('eventImage')){
                $image_path = "public/images/".$event->image;
                if(File::exists($image_path)) { File::delete($image_path); }
                $fileName = 'Event-'.uniqid().'.'.request()->eventImage->getClientOriginalExtension();
                $request->eventImage->move('public/images/', $fileName);
                $event->image=$fileName;
            }
             $dateTime = Carbon::createFromFormat('d/m/Y h:i A', $request->eventDateTime)->format('Y-m-d H:i:s');
            $event->title= $request->title;
            $event->link= $request->eventLink;
            $event->eventDate= $dateTime;//$request->eventDateTime;
            $event->description= htmlentities($_POST['description']);
            if( $event->status=='Live'){
                 $event->youtube_link =$request->YouTubeUrl;
            }
            if( $event->status=='Past'){
                 $event->recording_link =$request->recordUrl;
            }
            $event->save();
            $msg = "Updated";
        }else{
            // $dt = Carbon::create($request->eventDateTime);
            // $dateTime = $dt->format('Y-m-d H:i:s');  
            $dateTime = Carbon::createFromFormat('d/m/Y h:i A', $request->eventDateTime)->format('Y-m-d H:i:s');
            $event = new Event;
            $event->title= $request->title;
            $event->link= $request->eventLink;
            $event->eventDate= $dateTime;//$request->eventDateTime;
            $event->description= htmlentities($_POST['description']);
            
            $fileName = 'Event-'.uniqid().'.'.request()->eventImage->getClientOriginalExtension();
            $request->eventImage->move('public/images/', $fileName);
            $event->image=$fileName;
            $event->save();
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Event '.$msg.' successfully.']);
    }
    
    
    function showEventDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Event::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $event = Event::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.events.eventDescription')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $event = Event::find($request->id);
      $event->status= $request->status;
      if($event->save()){
          $message = ($request->status=='Active')?"Event marked as active successfully":"Event marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function statusMarkLive(Request $request){
    //   $count = Event::where('status','Live')->count();
    //   if($count){
    //       return Response::json(array('status'=>'error','message'=>'Other events is already Live'));
    //   }else{
          $event = Event::find($request->id);
          if($event->status=='New'){
              $event->status = "Live";
              $event->youtube_link =$request->_url;
              if($event->save()){
                 $liveEvents=Event::where('status','Live')->get();
                 $html= '<option value="none">None</option>';
                 foreach($liveEvents as $lvent){
                     $selected=($lvent->homeDisplay=='YES')?'selected':'';
                     $html .= '<option value="'.$lvent->id.'" '.$selected.'>'.$lvent->title.'</option>';
                 }
                 return Response::json(['status'=>'success','html'=>$html,'message'=>"Event marked as live successfully"]);
              }else{
                  return Response::json(array('status'=>'error','message'=>'something went wrong!'));
              }
          }else{
             return Response::json(array('status'=>'error','message'=>'Invalid access')); 
          }
     // }
    }
    
    
    
     public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        $image_path = "public/images/".$event->image;
        if(File::exists($image_path)) { File::delete($image_path); }
       Event::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Event successfully deleted "]);
    }
}
