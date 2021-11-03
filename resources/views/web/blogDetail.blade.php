  @extends('layouts.web')
@section('content')

    <header class="about-header" style="background-image: url('../media/{{config('custom.page_header_blog')}}');;background-position: center;background-repeat: no-repeat;">
        <!--<h1 class="hf1">DBF Central's Memoir!</h1>-->
    </header>

    <h1 class="trianglesection" style="background: #13a1e3; width: 100%"><br><br><br></h1>
    <svg id="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
        <path d="M0 0 L50 100 L100 0 Z" />
    </svg>

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
        <svg id="BLOGSbigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="background: white; ">
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>
    </div>
    
@endsection