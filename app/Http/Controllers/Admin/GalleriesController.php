<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Gallery;
use Maatwebsite\Excel\Facades\Excel;

class GalleriesController extends Controller
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
        $images = Gallery::orderBy('id','DESC')->get();
        $templete=['title'=>'Galleries','subtitle'=>'Gallery','Link'=>'galleries','images'=>$images,
        'scripts'=>[asset('admin/plugins/filterizr/jquery.filterizr.min.js'),
                    asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js'),
                    asset('admin/dist/js/pages/galleries.js')]];
        return view('admin.galleries.list',$templete);
    }
    
    public function saveFile(Request $request)
    {
        if($request->hasFile('galleryImage')){
            $gallery = new Gallery;
             $gallery->title=$request->galleryTitle;
            
            $fileName = 'Gallery-'.uniqid().'.'.request()->galleryImage->getClientOriginalExtension();
            $request->galleryImage->move('public/images/', $fileName);
            $gallery->image=$fileName;
            if($gallery->save()){
                return Response::json(['status'=>'success','data'=>['id'=>$gallery->id,'title'=>$request->galleryTitle,'path'=>asset('images/'.$fileName)],'message'=>"Image uploaded successfully "]);
            }else{
                return Response::json(['status'=>'error','message'=>"Something went wrong "]);
            }
           
        }else{
         return Response::json(['status'=>'error','message'=>"Please choose file."]);
        }
    }

    
     public function deleteGallery(Request $request){
         if(isset($request->id)){
            $row = Gallery::find($request->id);
            $image_path = "public/images/".$row->image;
            if(File::exists($image_path)) { File::delete($image_path); }
            Gallery::where('id',$request->id)->delete();
            return Response::json(['status'=>'success','message'=>"Image successfully deleted "]);
         }else{
              return Response::json(['status'=>'error','message'=>"Something went wrong "]);
         }
    }
}
