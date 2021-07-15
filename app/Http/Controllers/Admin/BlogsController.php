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
            if($request->hasFile('blogImage')){
                $image_path = "public/images/".$blog->image;
                if(File::exists($image_path)) { File::delete($image_path); }
                $fileName = 'Blog-'.uniqid().'.'.request()->blogImage->getClientOriginalExtension();
                $request->blogImage->move('public/images/', $fileName);
                $blog->image=$fileName;
            }
            $blog->title= $request->title;
            $blog->description= htmlentities($_POST['description']);
            $blog->save();
            $msg = "Updated";
        }else{
            $blog = new Blog;
            $blog->title= $request->title;
            $blog->description= htmlentities($_POST['description']);
            
            $fileName = 'Blog-'.uniqid().'.'.request()->blogImage->getClientOriginalExtension();
            $request->blogImage->move('public/images/', $fileName);
            $blog->image=$fileName;
            $blog->save();
            $msg = "Created";
        }
        return Response::json(['status'=>'success','param'=>$msg,'message'=>'Blog '.$msg.' successfully.']);
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
