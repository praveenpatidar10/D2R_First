<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Model\Blog;
use App\Model\Subscriber;
use App\Model\Event;
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
    public function index(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Home','Link'=>'home'];
        return view('web.welcome',$templete);
    }
    
    public function aboutUsPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'About Us','Link'=>'about'];
        return view('web.about',$templete);
    }
    public function eventsPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Events','Link'=>'events'];
        $eventcount = Event::count();
        if($eventcount){
             $templete['events'] = Event::get();
        }
        $templete['eventcount']=$eventcount;
        return view('web.events',$templete);
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
     public function blogsDeatilPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Ministries','Link'=>'ministries'];
        return view('web.blogDetail',$templete);
    }
    
    
    public function ministriesPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Ministries','Link'=>'ministries'];
        return view('web.ministries',$templete);
    }
    public function galleryPage(){
        $templete=['title'=>'DBF CENTRAL','subtitle'=>'Gallery','Link'=>'gallery'];
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
        if($gm->save()){
          return Response::json(['status'=>'success','message'=>'Thankyou for your subscription']);
        }else{
           return Response::json(['status'=>'error','message'=>'Something went wrong try again!']);  
        }
    }
    
    public function savePostEnquiry(Request $request){
        // $gm = new Subscriber;
        // $gm->email = $request->_subEmail;
        // $gm->name = $request->_subName;
        // $gm->save();
        return Response::json(['status'=>'success','message'=>'Your message is received , our team will contact you soon!']);
    }
    
    
    
    
}
