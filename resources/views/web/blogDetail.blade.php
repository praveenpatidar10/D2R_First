  @extends('layouts.web')
@section('content')
  <header class="about-header">
        <!--<h1 class="hf1">DBF Central's Memoir!</h1>-->
    </header>


    <div class="container blog-container">
        <section class="blog-sample-wrapper">
            <h1 class="hf2">{{$blog->title}}</h1>
            <h4 class="bf">Manav Das</h4>
            <h4 class="bf"><?php $date=date_create($blog->created_at);?>
                            <?php echo date_format($date,"F d,Y");?></h4>
            <img src="{{asset('images/'.$blog->image)}}">
            
         <p class="bf opening">
             <?php $html = html_entity_decode($blog->description);echo $html;?>
         </p>
           
            <a href="{{url('/blogs.htm')}}" class="bf backBtn">
                <span class="line tLine"></span>
                <span class="line mLine"></span>
                <span class="label"><a href="{{url('/blogs.htm')}}">Go Back</a></span>
                <span class="line bLine"></span>
            </a>
        </section>
    </div>
    
@endsection