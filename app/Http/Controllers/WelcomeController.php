<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Response;
use Mail;
use App\Model\Blog;
use App\Model\Subscriber;
use App\Model\Event;
use App\Model\Ministries;
use App\Model\Satsang;
use App\Model\Collaborators;
use App\Model\Resources;
use App\Model\ResourceIndexing;
class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Home','Link'=>'home'];
        $eventcount = Event::count();
        
        $homeeventcount=Event::where('homeDisplay','YES')->count();
        if($homeeventcount){ $templete['homedisplay'] = Event::where('homeDisplay','YES')->first();}
        $liveeventcount=Event::where('status','Live')->count();
        if($liveeventcount){ $templete['liveevent'] = Event::where('status','Live')->first();}
        $cntNew=Event::where('status','New')->count();
        if($cntNew>=4){ 
            $templete['newEvents'] = Event::where('status','New')->orderBy('eventDate','ASC')->limit(4)->get();
        }else if($cntNew<4){
           $templete['newEvents'] = Event::where('status','New')->orderBy('eventDate','ASC')->limit($cntNew)->get(); 
           $lmtPast = 4-$cntNew;
           $templete['pastEvents'] = Event::where('status','Past')->orderBy('eventDate','ASC')->limit($lmtPast)->get();
        }
          
        $templete['events'] = Event::orderByRaw("FIELD(status, \"Live\", \"New\", \"Past\")")->limit(4)->get();
        // if($liveeventcount>=4){
        //     $templete['liveEvents'] = Event::where('status','Live')->orderBy('eventDate','ASC')->limit(4)->get();
        // }else if($liveeventcount<4){
        //      $templete['liveEvents'] = Event::where('status','Live')->orderBy('eventDate','ASC')->limit($liveeventcount)->get();
        //      $cntNew=Event::where('status','New')->count();
        //      $lmt = 4-$liveeventcount;
        //      if($cntNew>=$lmt){
        //          $templete['newEvents'] = Event::where('status','New')->orderBy('eventDate','ASC')->limit($lmt)->get();
        //      }else if($cntNew<$lmt){
        //          $templete['newEvents'] = Event::where('status','New')->orderBy('eventDate','ASC')->limit($cntNew)->get();
                 
        //      }
             
        // }
        
        
        
        if($request->session()->has('temp_session')) {
            if($request->session()->get('temp_session')=="DBF") { 
                $templete['hasSession'] = "Yes";  
            }else{
                return redirect('dbf-satsang.htm');
                $templete['hasSession'] = "Yes";  
            } 
        }else{
            $templete['hasSession'] = "No";  
        }
        
        
        $templete['homeeventcount'] = $homeeventcount;
        $templete['liveeventcount'] = $liveeventcount;
        $templete['eventcount']=$eventcount;
        return view('web.welcome',$templete);
    }
    
    public function setVisitPreference(Request $request){
        if($request->visit=='DBF'){
            $request->session()->put('temp_session', 'DBF');
             echo url('/');
        }else{
         $request->session()->put('temp_session', 'DBFSATSANG');   
         echo url('/dbf-satsang.htm');
        }
    }
    
    
    
    public function aboutUsPage(){
        
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'About Us','Link'=>'about'];
        $templete['collaborators']=Collaborators::where('status','Active')->get();
        return view('web.about',$templete);
    }
    
    public function satSangPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'DBF Satsang','Link'=>'satsang'];
        $templete['images'] = Satsang::orderBy('id','DESC')->get();
        return view('web.satSang',$templete);
    }
    
    public function eventsPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Events','Link'=>'events'];
        $eventcount = Event::count();
        if($eventcount){
             $templete['events'] = Event::orderByRaw("FIELD(status,'New', 'Live', 'Past')")->get();
        }
        $templete['eventcount']=$eventcount;
        return view('web.events',$templete);
    }
    
    public function resourcesPage(){
        
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Resources','Link'=>'resources'];
        $Count = Resources::where('status','Active')->first();
        if($Count){
          $templete['latest'] = Resources::orderBy('id','DESC')->where('status','Active')->first();
          $templete['latestIndexes'] = ResourceIndexing::orderBy('id','ASC')->where('resourceId',$templete['latest']->id)->get();
          $templete['others'] = Resources::orderBy('id','DESC')->where('status','Active')->where('id','!=', $templete['latest']->id)->paginate(5);
        }
        return view('web.resourcePage',$templete);
    }
    
    function getVideoIndexing(){
        $videoId =  $_POST['videoId'];
        $res = Resources::where('videoId',$videoId)->first();
        $indexes = ResourceIndexing::select('title','labelTime','indexTime')->orderBy('id','ASC')->where('resourceId',$res->id)->get();
        return Response::json(['status'=>'success','message'=>'Info get successfully','data'=>['resource'=>$res,'indexes'=>$indexes]]);
    }
    
    
    public function blogsPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Blogs','Link'=>'blogs'];
        $blogcount = Blog::where('status','Active')->count();
        if($blogcount){
             $templete['blogs'] = Blog::where('status','Active')->get();
        }
        $templete['blogcount']=$blogcount;
        return view('web.blogs',$templete);
    }
     public function blogsDeatilPage(Request $request){
         
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Blogs','Link'=>'blogs'];
         $templete['blog'] = Blog::where('id',$request->param)->first();
        return view('web.blogDetail',$templete);
    }
    
    
    public function ministriesPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Ministries','Link'=>'ministries'];
        $ministriescount = Ministries::where('status','Active')->count();
        if($ministriescount){
             $templete['ministries'] = Ministries::where('status','Active')->get();
        }
        $templete['ministriescount']=$ministriescount;
        return view('web.ministries',$templete);
    }
    public function galleryPage(){
        $images = Gallery::orderBy('id','DESC')->get();
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Gallery','Link'=>'gallery','images'=>$images];
        return view('web.gallery',$templete);
    }
    public function contactusPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Contact Us','Link'=>'contactus'];
        return view('web.contactus',$templete);
    }
    
     public function joinusPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Join Us','Link'=>'joinus'];
        return view('web.joinus',$templete);
    }
    
    
    
    public function addUserSubscription(Request $request){
        $gm = new Subscriber;
        $gm->email = $request->_subEmail;
        $gm->name = $request->_subName;
        $gm->status='Active';
        $gm->source_type='newslatter';
        if($gm->save()){
            $to_name  = $request->_subName;
            $to_email = $request->_subEmail;
            $data = array('body'=>$to_name);
                    Mail::send('web.templates.welcome', $data,function($message) use ($to_name, $to_email) {
                     $message->to($to_email, $to_name)
                             ->subject("Welcome to DBF CENTRAL");
                     $message->from("prnpatidar@gmail.com",'DFB CENTERAL');
                    });
          return Response::json(['status'=>'success','message'=>'Thankyou for your subscription']);
        }else{
           return Response::json(['status'=>'error','message'=>'Something went wrong try again!']);  
        }
    }
    
    public function savePostEnquiry(Request $request){
        $gm = new Subscriber;
        $gm->email = $request->_contactEmail;
        $gm->name = $request->_contactName;
        $gm->status='Active';
        $gm->source_type='contact';
        if($gm->save()){
            $to_name = $request->_contactName;
            $to_email = $request->_contactEmail;
            $data = array('body'=>$request->_contactDesc,'name'=>$to_name,'email'=>$to_email);
                    Mail::send('web.templates.contactus', $data, function($message) use ($to_name, $to_email) {
                      $message->to('prnpatidar@gmail.com', 'admin')
                              ->subject("New enquery received");
                     $message->from("prnpatidar@gmail.com",'DFB CENTERAL');
                    });
           return Response::json(['status'=>'success','message'=>'Your message is received , our team will contact you soon!']);
        }else{
          return Response::json(['status'=>'success','message'=>'Somthig went wrong , try again later.']); 
        }
       
    }
    
    
    
    
}
