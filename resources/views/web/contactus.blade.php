@extends('layouts.web')
@section('content')

 <header class="about-header">
        <h1 class="hf1">We'd love to hear from You!</h1>
    </header>


    <div class="container contactus-container">

        <section class="contactus" style="background-color: #dce0df;">
            <div class="contactus-title"><h2 class="hf2">Wanna Know More?</h2></div>
            <div class="contactus-content">
                <img src="{{asset('media/events-section-img.png')}}">
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
                            <button type="submit" class="_contactusButton bf">Submit</button>
                        </div>
                     </form>
                </div>
            </div>
        </section>

    </div>

@endsection