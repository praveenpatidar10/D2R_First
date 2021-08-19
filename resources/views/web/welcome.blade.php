@extends('layouts.web')
@section('content')

 <header>
        <video autoplay muted loop id="bgv">
            
            <source src="{{asset('media/')}}/{{config('custom.website_homeVideo')}}" type="video/mp4">
        </video>
        <h1 class="hf1">{{config('custom.home_video_content')}}</h1>
        <!--<a href="#" class="bf watch"><i class="fas fa-video"></i> Watch Full Video</a>-->
    </header>


    <div class="container home-container" style="background-color: #dce0df;">

        <section class="home-mission">
            <div class="mission-content">
                <h1 class="hf2">Mission</h1>
                <p class="bf">We exist to Cultivate Christ centred Communities to Redeem Delhi & beyond for the glory of God</p>
                <a href="{{url('/about-us.htm')}}" class="bf">Know More</a>
            </div>
        </section>
        
        <svg id="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>
        @if($homeeventcount)
        <section class="live" id="liveHolder" style="background: #FFF;">
            <div class="live-title">
                <h1 class="hf2" style="color: #000;">Join The</h1>
                <a href="https://www.youtube.com/user/CDCTeaching/videos" target="_blank"><img src="{{asset('media/ytlogo.png')}}" alt="Youtube"></a>
                <h1 class="hf2" style="color: #000;">Livestream Here!</h1>
            </div>
            <div id="live">
                <iframe class="video" src="{{$homedisplay->youtube_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </section>
       
        <svg id="bigTriangleShadow" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path id="trianglePath1" d="M0 0 L50 100 L100 0 Z" />
            <path id="trianglePath2" d="M50 100 L100 40 L100 0 Z" />
        </svg>
 @endif
        <section class="events" style="background: #F3F1F5;">
            
                <div class="events-desc">
                    <h2 class="hf2">Check out all events!</h2>
                    <p class="bf">See a list of all the events ever conducted by the fellowship including some of the upcoming events along with a registration link</p>
                    <a class="bf" href="{{url('events.htm')}}">View all</a>
                </div>

                <div class="slider-container">
                <div class="flexbox-slider flexbox-slider-1">
                    @isset($events)
                        @foreach($events as $event)
                          <div class="flexbox-slide">
                               <img src="{{asset('images/'.$event->image)}}">
                                <div class="text-block">
                                    <h3 class="hf2">{{$event->title}}</h3>
                                    <?php $html = html_entity_decode($event->description);
                                    
                                                //echo $html;?>
                                    <div class="text">
                                        <p class="bf"><?php echo strip_tags(substr($html,0,140)).'...';?></p>
                                    </div>
                                       @if($event->status=='New')
                                          <a target="_blank" href="{{$event->link}}" class="bf">REGISTER</a>
                                        @else
                                          <a target="_blank" href="{{$event->youtube_link}}" class="bf">View</a>
                                        @endif
                                    
                    
                                </div>
                         </div>
                        @endforeach
                    @endisset
                    
                   
                </div>
                </div>

        </section>

        <section class="newsletter" style="background: #FFF;">
            <img src="{{asset('media/'.config('custom.newletter_icon'))}}">
            <h2 class="hf2">Subscribe to our <span>Newsletter</span> to get the Latest News</h2>
            <p class="bf">Fill in these details to get started...</p>
             <form id="subscriptionForm" action="#" enctype="multipart/form-data" method="POST">
                 @csrf
                <div class="ipfields">
                <div>
                    <input type="text" id="_subEmail" name="_subEmail" class="bf email" placeholder="Your E-mail Address">
                    <input type="text" id="_subName" name="_subName" class="bf name" placeholder="Your Name">
                </div>
                <button type="submit"  class="_subsButton bf" href="#">Subscribe!</button>
            </div>
            </form>
            <p class="bf">We won't share your data without your permission. Your secret's safe with us!</p>
        </section>

    </div>

@endsection