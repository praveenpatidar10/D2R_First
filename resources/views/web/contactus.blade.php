@extends('layouts.web')
@section('content')

 <header class="about-header" style="background-image: url('./media/{{config('custom.page_header_contactus')}}');;background-position: center;background-repeat: no-repeat;">
        <!--<h1 class="hf1">We'd love to hear from You!</h1>-->
    </header>


    <div class="container contactus-container">
        <h1 class="trianglesection" style="background: #13a1e3; width: 100%; color: #13a1e3;"><br><br><br></h1>
        <svg id="CONTACTbigTriangleColor1" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="box-shadow: 0px -20px #13a1e3;" >
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>

        <section class="contactus" style="background-color: #ffffff;">
            <div class="contactus-title"><h2 class="hf2">Wanna Know More?</h2></div>
            <div class="contactus-content">
                <img src="{{asset('/media/'.config('custom.contact_left_image'))}}">
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

        <svg id="CONTACTbigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="background: white; ">
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>
    </div>
    

@endsection