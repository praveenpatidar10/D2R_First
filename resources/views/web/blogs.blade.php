@extends('layouts.web')
@section('content')

 
    <header class="about-header">
        <h1 class="hf1">DBF Central's Memoir!</h1>
    </header>


    <div class="container blog-container">
       
  <?php  $count = 1; ?>
 @foreach($blogs as $blog)
    <?=($count%4 == 1)?'<section class="blogs-wrapper">':'';?>
    <?php  $len = strlen($blog->title);?>
            <div class="blog-wrapper">
                <a href="{{url('/blog-detail.htm/'.base64_encode($blog->id))}}" class="blog-square">
                    <img src="{{asset('images/'.$blog->image)}}">
                    <h3 class="bf">@if($len<=30) {{$blog->title}} @else {{substr($blog->title,0,28)}}... @endif</h3>
                    <div class="blog-desc">
                        <p class="bf">Blog Author</p>
                        <p class="bf">
                            <?php $date=date_create($blog->created_at);?>
                            <?php echo date_format($date,"F d,Y");?>
                        </p>
                    </div>
                </a>
            </div>
           
    <?=($count%4 == 0)?"</section>":"";?>
    <?php  $count++; ?>
@endforeach
<?=($count%4 != 1)?"</section>":""; ?>
            
       
        <!--<section class="blogs-wrapper">-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="https://fmhc.visionux.in/images/Blog-60f05dfc71ae5.jpg">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="https://fmhc.visionux.in/images/Blog-60f8326ca66df.png">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</section>-->
        <!--<section class="blogs-wrapper">-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div class="blog-wrapper">-->
        <!--        <a href="../PAGES/blog-sample.html" class="blog-square">-->
        <!--            <img src="{{asset('media/blog-tile.jpeg')}}">-->
        <!--            <h3 class="bf">Blog Title</h3>-->
        <!--            <div class="blog-desc">-->
        <!--                <p class="bf">Blog Author</p>-->
        <!--                <p class="bf">Blog Publishing Date</p>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</section>-->
    </div>
@endsection