<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Site_setting;
use Config;

class Setting extends Controller
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
        $setting=Site_setting::first();
        $templete=['title'=>'Site Settings','subtitle'=>'Settings','Link'=>'settigs','setting'=>$setting,'scripts'=>[asset('admin/dist/js/pages/settings.js')]];
        return view('admin.settings.sitesetting',$templete);
    }
    
    public function saveMailSettings(Request $request){
          $_mail = Site_setting::find($request->mail_id);
          $_mail->mail_driver= $request->mail_driver;
          $_mail->mail_port= $request->mail_port;
          $_mail->mail_host= $request->mail_host;
          $_mail->mail_username= $request->mail_username;
          $_mail->mail_password= $request->mail_password;
          $_mail->mail_encryption= $request->mail_encryption;
          $_mail->mail_from_address= $request->mail_from_address;
          $_mail->mail_from_name= $request->mail_from_name;
          if($_mail->save()){
              return Response::json(['status'=>'success','message'=>"Mail Settings updated successfully"]);
          }else{
              return Response::json(array('status'=>'error','message'=>'something went wrong!'));
          }
    }
    
    function updateCustomConfig($key,$value){
        $array = Config::get('custom');
        $array[$key]  = $value;
        $data = var_export($array, 1);
       // print_r($array);
        if(File::put(getcwd().'/config/custom.php', "<?php\n return $data ;")) {
          return true;
        }else{
            return false;
        }
    }
    
    public function updateSiteSettings(Request $request){
        //print_r($_POST);
        //Array ( [_token] => W8qXesQHbenNmBmSeroZCnueFxeK0xK6JFF4k5rv [logo_id] => 1 [column] => website_logo )
        if($request->column){
            
            if($request->column=='home_video_content'){ 
                //if($request->homeVideoContent!=""){
                     $setting = Site_setting::find($request->homeVideoContent_id);
                     $setting->home_video_content=$request->homeVideoContent;  
                     $setting->save();
                     $this->updateCustomConfig('home_video_content',$request->homeVideoContent);
                     return Response::json(['status'=>'success','message'=>"Content updated successfully"]);
                // }else{
                //     return Response::json(array('status'=>'error','message'=>'content can not be empty')); 
                // }
            }else if($request->column=='website_logo'){
                if(request()->website_logo->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->website_logo);
                     $width = $size[0];$height = $size[1];
                     if($width==320 && $height==239){
                         $setting = Site_setting::find($request->logo_id);
                         $logo_path = "public/media/".$setting->website_logo;
                         if(File::exists($logo_path)) { File::delete($logo_path); }
                         $fileName = 'logo-'.time().'.'.request()->website_logo->getClientOriginalExtension();
                         $request->website_logo->move('public/media/', $fileName);
                         $setting->website_logo=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('website_logo',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Logo uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 320 X 239'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='satsang_logo'){
                if(request()->satsang_logo->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->satsang_logo);
                     $width = $size[0];$height = $size[1];
                     if($width==320 && $height==239){
                         $setting = Site_setting::find($request->satsanglogo_id);
                         $slogo_path = "public/media/".$setting->satsang_logo;
                         if(File::exists($slogo_path)) { File::delete($slogo_path); }
                         $fileName = 'satsang-logo-'.time().'.'.request()->satsang_logo->getClientOriginalExtension();
                         $request->satsang_logo->move('public/media/', $fileName);
                         $setting->satsang_logo=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('satsang_logo',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Satsang logo uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 320 X 239'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='website_aboutus'){
                if(request()->aboutusImage->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->aboutusImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1500 && $height==666){
                         $setting = Site_setting::find($request->aboutus_id);
                         $logo_path = "public/media/".$setting->aboutus_image;
                         if(File::exists($logo_path)) { File::delete($logo_path); }
                         $fileName = 'aboutus-section-img-'.time().'.'.request()->aboutusImage->getClientOriginalExtension();
                         $request->aboutusImage->move('public/media/', $fileName);
                         $setting->aboutus_image=$fileName;  
                         $setting->save();
                          $this->updateCustomConfig('website_aboutus',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Aboutus image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1500 X 666'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='contact_left_image'){
                if(request()->contactLeftImage->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->contactLeftImage);
                     $width = $size[0];$height = $size[1];
                     if($width==2124 && $height==1880){
                         $setting = Site_setting::find($request->contactLeftImage_id);
                         $logo_path = "public/media/".$setting->contact_left_image;
                         if(File::exists($logo_path)) { File::delete($logo_path); }
                         $fileName = 'events-section-img'.time().'.'.request()->contactLeftImage->getClientOriginalExtension();
                         $request->contactLeftImage->move('public/media/', $fileName);
                         $setting->contact_left_image=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('contact_left_image',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Contact Form Image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 2124 X 1880'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='website_homeVideo'){
                if(request()->website_homeVideo->getClientOriginalExtension()=='mp4'){
                     $size = filesize(request()->website_homeVideo);
                     //print_r($size);//5150000
                    //  $width = $size[0];$height = $size[1];
                    //  if($width==320 && $height==239){
                         $setting = Site_setting::find($request->homeVideo_id);
                         $vd_path = "public/media/".$setting->website_homeVideo;
                         if(File::exists($vd_path)) { File::delete($vd_path); }
                         $fileName = 'bgvideo'.time().'.'.request()->website_homeVideo->getClientOriginalExtension();
                         $request->website_homeVideo->move('public/media/', $fileName);
                         $setting->website_homeVideo=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('website_homeVideo',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Video uploded successfully"]);
                    //  }else{
                    //      return Response::json(array('status'=>'error','message'=>'Image size sholud be 320X239'));  
                    //  }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only mp4 extenstion is required.')); 
                }
            
                
            }else if($request->column=='newletter_icon'){
                if(request()->newletterIcon->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->newletterIcon);
                     //print_r($size);//5150000
                      $width = $size[0];$height = $size[1];
                     if($width==612 && $height==408){
                         $setting = Site_setting::find($request->newletterIcon_id);
                         $vd_path = "public/media/".$setting->newletter_icon;
                         if(File::exists($vd_path)) { File::delete($vd_path); }
                         $fileName = 'newletterIcon-'.time().'.'.request()->newletterIcon->getClientOriginalExtension();
                         $request->newletterIcon->move('public/media/', $fileName);
                         $setting->newletter_icon=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('newletter_icon',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"newletter icon uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 612X408'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='subscribe_icon'){
                if(request()->subscribeIcon->getClientOriginalExtension()=='png'){
                     $size = getimagesize(request()->subscribeIcon);
                      $width = $size[0];$height = $size[1];
                      if($width==256 && $height==256){
                        $setting = Site_setting::find($request->subscribeIcon_id);
                         $vd_path = "public/media/".$setting->subscribe_icon;
                         if(File::exists($vd_path)) { File::delete($vd_path); }
                         $fileName = 'subscribeIcon-'.time().'.'.request()->subscribeIcon->getClientOriginalExtension();
                         $request->subscribeIcon->move('public/media/', $fileName);
                         $setting->subscribe_icon=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('subscribe_icon',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"subscribe icon uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 256X256'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only png extenstion is required.')); 
                }
            }else if($request->column=='page_header_about'){ 
                if(request()->headerAboutImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerAboutImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerAbout_id);
                         $path = "public/media/".$setting->page_header_about;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'aboutus-header-'.time().'.'.request()->headerAboutImage->getClientOriginalExtension();
                         $request->headerAboutImage->move('public/media/', $fileName);
                         $setting->page_header_about=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_about',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"About Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }else if($request->column=='page_header_event'){ 
                if(request()->headerEventImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerEventImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerEvent_id);
                         $path = "public/media/".$setting->page_header_event;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'event-header-'.time().'.'.request()->headerEventImage->getClientOriginalExtension();
                         $request->headerEventImage->move('public/media/', $fileName);
                         $setting->page_header_event=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_event',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Event Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }else if($request->column=='page_header_ministries'){ 
                if(request()->headerMinistriesImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerMinistriesImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerMinistries_id);
                         $path = "public/media/".$setting->page_header_ministries;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'ministries-header-'.time().'.'.request()->headerMinistriesImage->getClientOriginalExtension();
                         $request->headerMinistriesImage->move('public/media/', $fileName);
                         $setting->page_header_ministries=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_ministries',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Ministries Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }else if($request->column=='page_header_blog'){ 
                if(request()->headerBlogImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerBlogImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerBlog_id);
                         $path = "public/media/".$setting->page_header_blog;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'blog-header-'.time().'.'.request()->headerBlogImage->getClientOriginalExtension();
                         $request->headerBlogImage->move('public/media/', $fileName);
                         $setting->page_header_blog=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_blog',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Blog Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }else if($request->column=='page_header_gallery'){ 
                if(request()->headerGalleryImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerGalleryImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerGallery_id);
                         $path = "public/media/".$setting->page_header_gallery;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'gallery-header-'.time().'.'.request()->headerGalleryImage->getClientOriginalExtension();
                         $request->headerGalleryImage->move('public/media/', $fileName);
                         $setting->page_header_gallery=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_gallery',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Gallery Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }else if($request->column=='page_header_contactus'){ 
                if(request()->headerContactusImage->getClientOriginalExtension()=='jpeg'){
                     $size = getimagesize(request()->headerContactusImage);
                     $width = $size[0];$height = $size[1];
                     if($width==1280 && $height==553){
                         $setting = Site_setting::find($request->headerContactus_id);
                         $path = "public/media/".$setting->page_header_contactus;
                         if(File::exists($path)) { File::delete($path); }
                         $fileName = 'contactus-header-'.time().'.'.request()->headerContactusImage->getClientOriginalExtension();
                         $request->headerContactusImage->move('public/media/', $fileName);
                         $setting->page_header_contactus=$fileName;  
                         $setting->save();
                         $this->updateCustomConfig('page_header_contactus',$fileName);
                         return Response::json(['status'=>'success','path'=>asset('media/'.$fileName),'message'=>"Contact us Page Header image uploded successfully"]);
                     }else{
                         return Response::json(array('status'=>'error','message'=>'Image size sholud be 1280 X 553'));  
                     }
                }else{
                    return Response::json(array('status'=>'error','message'=>'Only jpeg extenstion is required.')); 
                }
            }
        }else{
            return Response::json(array('status'=>'error','message'=>'something went wrong, try again!')); 
        }
        
    
    }
}