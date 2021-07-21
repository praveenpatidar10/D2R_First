<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use Mail;
use App\Model\Template;
use App\Model\Usergroup;
use App\Model\Groupmember;
use App\Model\Subscriber;

class MailerController extends Controller
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
        $groups = Usergroup::where('status','Active')->get();
        $templates = Template::where('status','Active')->get();
        $templete=['title'=>'Mailer','subtitle'=>'Send Mail','Link'=>'blogs','groups'=>$groups,'templates'=>$templates,'scripts'=>[asset('admin/dist/js/pages/mailer.js')]];
        return view('admin.mailer.mailbox',$templete);
    }
    
    function getGroupMembers(Request $request){
        if($request->id){
             $members=   Groupmember::select(DB::raw("GROUP_CONCAT(subscribers.email) as members"))
                                      ->leftJoin('subscribers', 'subscribers.id', '=', 'groupmembers.member_id')
                                      ->where(['groupmembers.group_id'=>$request->id])->value('members');
             return Response::json(['status'=>'success','data'=>$members,'message'=>'Members get suucessfully.']);
        }else{
             return Response::json(['status'=>'error','message'=>'Invalid access']);
        }
    }
    
    
    
    function sendMail(Request $request){
               $emailTemp = Template::where(['id'=>$request->tempId])->first();
               $members=   Groupmember::where(['group_id'=>$request->groupId])->get();
               $subject = $emailTemp->title;
               foreach($members as $each){
                   $member  = Subscriber::where('id',$each->member_id)->first();
                   $findArr = ["{subscriber_name}","{subscriber_email}"];
                   $rplcArr = [$member->name,$member->email];
                   $body = str_replace($findArr,$rplcArr,$emailTemp->description);
                   $to_name = $member->name;
                   $to_email = $member->email;
                   $data = array('body'=>$body,'subject'=>$subject);
                    Mail::send('admin.templates.mail_frame', $data, function($message) use ($to_name, $to_email,$subject) {
                      $message->to($to_email, $to_name)
                              ->subject($subject);
                     $message->from("prnpatidar@gmail.com",'DFB CENTERAL');
                    });
                    
                    // if( count(Mail::failures()) > 0 ){
                    //     echo 'There seems to be a problem. Please try again in a while'; 
                    //     return Response::json(['status'=>'error','message'=>'Invalid access']);
                    // }else{                      
                    //   echo 'Thanks for your message. Please check your mail for more details!'; 
                     
                    // }
               }
                 
                  return Response::json(['status'=>'success','message'=>'Email sent successfully']);  
    }
    
}
