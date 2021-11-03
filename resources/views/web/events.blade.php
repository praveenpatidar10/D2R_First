@extends('layouts.web')
@section('content')
  
    <header class="about-header" style="background-image: url('./media/{{config('custom.page_header_event')}}');;background-position: center;background-repeat: no-repeat;">
        <!--<h1 class="hf1">Explore All Events!</h1>-->
    </header>
<style>
 .box {
  position: relative;
 }


.live-ribbon{
    position: absolute;
    transition: .3s ease;
    bottom: 10px;
    right: 5px;
    color: #fff;
    border: 1px solid #ff0202;
    font-size: 13px;
    padding: 0px 10px;
    border-radius: 11px;
    background-color: #ff0202;
}

</style>

    <h1 class="trianglesection" style="background: #13a1e3; width: 100%"><br><br><br></h1>
    <svg id="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
        <path d="M0 0 L50 100 L100 0 Z" />
    </svg>
    <div class="container events-container">
        
        <?php  $count = 1; ?>
          @foreach($events as $event)
              <?=($count%4 == 1)?'<div class="events-wrapper">':'';?>
                   <div class="event-wrapper @if($event->status=='Live') box @endif">
                       
                         <!--<div class="ribbon"><span>Live</span></div>-->
                         
                        
                        <a href="#openModal{{$event->id}}" class="event-square">
                             @if($event->status=='Live')
                            <span class="live-ribbon">Live</span>
                             @endif
                            <img src="{{asset('images/'.$event->Thumbnailimage)}}" alt="{{$event->title}}">
                            <h3 class="bf">{{$event->title}}</h3>
                        </a>
                    </div>
                    
                    <div id="openModal{{$event->id}}" class="modal-window">
                    <div>
                        <a href="#" title="Close" class="bf modal-close">X</a>
                        <div class="bf modal-content">
                            <img src="{{asset('images/'.$event->Thumbnailimage)}}" style="height: 450px;">
                            <div class="event-details">
                                <h1 class="hf2">{{$event->title}}</h1>
                                <?php $date=date_create($event->eventDate);?>
                                <h2 class="hf2"><?php echo date_format($date,"F d,Y h:i A");?></h2>
                                <h3 class="bf"> 
                                  <?php $html = html_entity_decode($event->description);
                                    echo $html;?>
                                    </h3>
                                @if($event->status=='New')
                                 <a  target="_blank" href="{{$event->link}}" class="bf event-register">Register</a>
                                @else
                                 <a  target="_blank" href="{{$event->youtube_link}}" class="bf event-register">View</a>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
         <?=($count%4 == 0)?"</div>":"";$count++; ?>
         @endforeach
       <?=($count%4 != 1)?"</div>":""; ?>
        <!--<div class="events-wrapper">-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
            
            
            
            
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="events-wrapper">-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--    <div class="event-wrapper">-->
        <!--        <a href="#openModal" class="event-square">-->
        <!--            <img src="{{asset('media/events-event-tile.png')}}" alt="event">-->
        <!--            <h3 class="bf">Event Name</h3>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--    <div id="openModal" class="modal-window">-->
        <!--            <div>-->
        <!--                <a href="#" title="Close" class="bf modal-close">X</a>-->
        <!--                <div class="bf modal-content">-->
        <!--                    <img src="{{asset('media/events-event-tile.png')}}">-->
        <!--                    <div class="event-details">-->
        <!--                        <h1 class="hf2">Event Title</h1>-->
        <!--                        <h2 class="hf2">Event Time</h2>-->
        <!--                        <h3 class="bf">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium unde eveniet officia deleniti, quasi facilis nemo, aliquid doloremque, assumenda qui nostrum! Repellat laboriosam modi fugit suscipit, aperiam ad amet? Necessitatibus!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ullam itaque voluptatibus excepturi nihil. </h3>-->
        <!--                        <a href="#" class="bf event-register">Register</a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--    </div>-->
        <!--</div>-->
            
        <section class="contactus" style="background-color: #ffffff;">
            <div class="contactus-title"><h2 class="hf2">Wanna Know More?</h2></div>
            <div class="contactus-content">
                <img src="{{asset('media/'.config('custom.contact_left_image'))}}">
                <div class="form">
                    <p class="bf">Drop In Your Details And Leave Us A Message...</p>
                  <form id="contactUsForm" action="#" enctype="multipart/form-data" method="POST">
                     @csrf
                        <div class="ipfields">
                            <div class="subdetails">
                                <input type="text" id="_contactEmail" name="_contactEmail"  class="bf email" placeholder="Your E-mail Address">
                                <input type="text" id="_contactName" name="_contactName" class="bf name" placeholder="Your Name">
                            </div>
                            <textarea class="bf joinmsg" id="_contactDesc" name="_contactDesc" cols="30" rows="5" placeholder="What would you like to know?"></textarea>
                            <button type="submit" class="_contactusButton bf btnSubmitForm" style=" margin-top: 5px;">Submit</button>
                        </div>
                     </form>
                </div>
            </div>
        </section>
        <svg id="EVENTSbigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="background: white; ">
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>
    </div>


@endsection