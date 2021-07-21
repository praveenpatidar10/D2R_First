@extends('layouts.web')
@section('content')
  
    <header class="about-header">
        <h1 class="hf1">Explore All Events!</h1>
    </header>


    <div class="container events-container">
        
        <?php  $count = 1; ?>
          @foreach($events as $event)
              <?=($count%4 == 1)?'<div class="events-wrapper">':'';?>
                   <div class="event-wrapper">
                        <a href="#openModal{{$event->id}}" class="event-square">
                            <img src="{{asset('images/'.$event->image)}}" alt="{{$event->title}}">
                            <h3 class="bf">{{$event->title}}</h3>
                        </a>
                    </div>
                    
                    <div id="openModal{{$event->id}}" class="modal-window">
                    <div>
                        <a href="#" title="Close" class="bf modal-close">X</a>
                        <div class="bf modal-content">
                            <img src="{{asset('images/'.$event->image)}}">
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
            
        <section class="contactus" style="background-color: #dce0df;">
            <div class="contactus-title"><h2 class="hf2">Wanna Know More?</h2></div>
            <div class="contactus-content">
                <img src="{{asset('media/events-section-img.png')}}">
                <div class="form">
                    <p class="bf">Drop In Your Details And Leave Us A Message...</p>
                    <div class="ipfields">
                        <div class="subdetails">
                            <input type="text" class="bf email" placeholder="Your E-mail Address">
                            <input type="text" class="bf name" placeholder="Your Name">
                        </div>
                        <textarea class="bf joinmsg" cols="30" rows="5" placeholder="What would you like to know?"></textarea>
                        <a class="bf" href="#">Submit</a>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection