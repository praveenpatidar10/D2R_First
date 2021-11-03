<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Response;
use DB;
use App\Model\Blog;

class BlogsController extends Controller
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
        $templete=['title'=>'Blogs','subtitle'=>'List Blogs','Link'=>'blogs','scripts'=>[asset('admin/dist/js/pages/blogs.js')]];
        return view('admin.blogs.list',$templete);
    }
    
    
    public function getBlogsDatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'name'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $blogTitle = ($request->input('columns.0.search.value'))?:"";
           
        $query = DB::table('blogs');
        $query->select('*')
              ->when($blogTitle, function ($query, $blogTitle) {
                    return $query->where('title','like', '%'.$blogTitle.'%');
                });
              
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('blogs')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['title']        = $each->title;
                $eachData['description']       = '<a data-title="'.$each->title.'" class="view-desc" href="#" id="'.$each->id.'">View Description</a>';
                $eachData['status'] =($each->status=='Active')?'<span class="badge bg-success btn-status" data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Active</span>'
                                                              :'<span class="badge bg-danger btn-status"  data-title="'.$each->title.'" data-id="'.$each->id.'" data-status="'.$each->status.'">Inactive</span>';
                $eachData['action']          = '<div class="btn-group">
                                                <a href="'.url('admin/blogs/manage/'.$each->id).'"  data-name="'.$each->title.'" class="btn btn-info btn-edit btn-sm "><i class="fas fa-edit"></i></a>
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
        $templete=['title'=>'Blogs','Link'=>'blogs','scripts'=>[asset('admin/dist/js/pages/blogs.js')]];
        if(isset($request->param)){ 
             $templete['blog'] = Blog::find($request->param);
             $templete['subtitle']='Edit Blog';
        }else{
            $templete['subtitle']='Add Blog';
        }
        return view('admin.blogs.add_edit',$templete);
    }
    
    public function  saveBlogs(Request $request){
       // print_r($_POST);
        
        if(isset($request->id)){
            $blog = Blog::find($request->id);
            
             $error = false;$errorThumb=false;
            if($request->hasFile('blogImage')){
                $Size = getimagesize(request()->blogImage);
                $_width = $Size[0];$_height = $Size[1];
                $error = ($_width==1200 && $_height==500)?false:true;
            }
            
            if($request->hasFile('blogThumbnail')){
                $thumbSize = getimagesize(request()->blogThumbnail);
                $_width = $thumbSize[0];$_height = $thumbSize[1];
                $errorThumb = ($_width==450 && $_height==450)?false:true;
            }
            
            if($errorThumb==true){
                 return Response::json(['status'=>'error','param'=>'Updated','message'=>'Incorrect image size for Thumbnail image ,please enter image with size(450*450)']);
            }else if($error==true){
                 return Response::json(['status'=>'error','param'=>'Updated','message'=>'Incorrect image size ,please enter image with size(1200*500)']);
            }else{
                
                $blog->title= $request->title;
                $blog->description= htmlentities($_POST['description']);
                
               if($request->hasFile('blogImage')){ 
                $image_path = "public/images/".$blog->image;
                if(File::exists($image_path)) { File::delete($image_path); }
                $fileName = 'Blog-'.uniqid().'.'.request()->blogImage->getClientOriginalExtension();
                $request->blogImage->move('public/images/', $fileName);
                $blog->image=$fileName;
               }
               
               if($request->hasFile('blogThumbnail')){ 
                    $image_path_ = "public/images/".$blog->Thumbnailimage;
                    if(File::exists($image_path_)) { File::delete($image_path_); }
                    $fileName = 'Blog-Thumbnail-'.uniqid().'.'.request()->blogThumbnail->getClientOriginalExtension();
                    $request->blogThumbnail->move('public/images/', $fileName);
                    $blog->Thumbnailimage=$fileName;
                }
                
                $blog->save();
                return Response::json(['status'=>'success','param'=>"Updated",'message'=>'Blog Updated successfully.']);
            }
        }else{
             
            $error = false;$errorThumb = false;
            $size = getimagesize(request()->blogImage);
            $width = $size[0];$height = $size[1];
            $error=($width==1200 && $height==500)?false:true;
             
            $thumbSize = getimagesize(request()->blogThumbnail);
            $_width = $thumbSize[0];$_height = $thumbSize[1];
            $errorThumb = ($_width==450 && $_height==450)?false:true;
             
            if($errorThumb==true){
                 return Response::json(['status'=>'error','param'=>'Created','message'=>'Incorrect image size for Thumbnail image ,please enter image with size(450*450)']);
            }else if($error == true){
                 return Response::json(['status'=>'error','param'=>'Created','message'=>'Incorrect image size , please enter image with size(1200*500)']);
            }else{  
                
                $blog = new Blog;
                $blog->title= $request->title;
                $blog->description= htmlentities($_POST['description']);
                    
                    $fileName = 'Blog-'.uniqid().'.'.request()->blogImage->getClientOriginalExtension();
                    $request->blogImage->move('public/images/', $fileName);
                    $blog->image=$fileName;
                    
                    $fileName = 'Blog-Thumbnail-'.uniqid().'.'.request()->blogThumbnail->getClientOriginalExtension();
                    $request->blogThumbnail->move('public/images/', $fileName);
                    $blog->Thumbnailimage=$fileName;
                    
                    if($blog->save()){
                        return Response::json(['status'=>'success','param'=>"Created",'message'=>'Blog Created successfully.']);
                     }else{
                        return Response::json(['status'=>'Required','param'=>"Created",'message'=>'Something went wrong while add Blog']); 
                     }
            }
        }
       
    }
    
    
    function showBlogDescription(Request $request){
        if($request->id!=""){
            $template['id'] = $request->id;
            
            $count = Blog::where('id',$request->id)->count();
            if($count){ $template['temp'] =  $blog = Blog::where('id',$request->id)->first();}
            $template['count']  = $count;
            return view('admin.blogs.blogDescription')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function statusUpdate(Request $request){
      $blog = Blog::find($request->id);
      $blog->status= $request->status;
      if($blog->save()){
          $message = ($request->status=='Active')?"Blog marked as active successfully":"Blog marked as inactive successfully";
          return Response::json(['status'=>'success','message'=>$message]);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
     public function deleteBlog(Request $request){
        $blog = Blog::find($request->id);
        $image_path = "public/images/".$blog->image;
        if(File::exists($image_path)) { File::delete($image_path); }
       Blog::where('id',$request->id)->delete();
      return Response::json(['status'=>'success','message'=>"Blog successfully deleted "]);
    }
}
