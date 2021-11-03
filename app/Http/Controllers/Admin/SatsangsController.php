<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Satsang;
use Maatwebsite\Excel\Facades\Excel;

class SatsangsController extends Controller
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
        $images = Satsang::orderBy('id','DESC')->get();
        $templete=['title'=>'Satsangs','subtitle'=>'Satsang','Link'=>'Satsangs','images'=>$images,
        'scripts'=>[asset('admin/plugins/filterizr/jquery.filterizr.min.js'),
                    asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js'),
                    asset('admin/dist/js/pages/satsangs.js')]];
        return view('admin.satsang.list',$templete);
    }
    
    public function saveFile(Request $request)
    {
        if($request->hasFile('galleryImage')){
            
            $size = getimagesize(request()->galleryImage);
            $width = $size[0];$height = $size[1];
            if($width==300 && $height==300){
                
                $gallery = new Satsang;
                $gallery->title=$request->galleryTitle;
                
                $fileName = 'Satsang-'.uniqid().'.'.request()->galleryImage->getClientOriginalExtension();
                $request->galleryImage->move('public/images/', $fileName);
                $gallery->image=$fileName;
                if($gallery->save()){
                    return Response::json(['status'=>'success','data'=>['id'=>$gallery->id,'title'=>$request->galleryTitle,'path'=>asset('images/'.$fileName)],'message'=>"Image uploaded successfully "]);
                }else{
                    return Response::json(['status'=>'error','message'=>"Something went wrong "]);
                }
            }else{
                 return Response::json(['status'=>'Required','message'=>'Incorrect image size,please enter image with size(300X300)']); 
            }
           
        }else{
         return Response::json(['status'=>'error','message'=>"Please choose file."]);
        }
    }

    
     public function deleteGallery(Request $request){
         if(isset($request->id)){
            $row = Satsang::find($request->id);
            $image_path = "public/images/".$row->image;
            if(File::exists($image_path)) { File::delete($image_path); }
            Satsang::where('id',$request->id)->delete();
            return Response::json(['status'=>'success','message'=>"Image successfully deleted "]);
         }else{
              return Response::json(['status'=>'error','message'=>"Something went wrong "]);
         }
    }
}
