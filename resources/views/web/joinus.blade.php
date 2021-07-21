@extends('layouts.web')
@section('content')

  
    <header class="about-header">
        <h1 class="hf1">Let's Join Hands Together!</h1>
    </header>


    <div class="container joinus-container">

        <section class="newsletter">
            <img src="{{asset('media/newsletter.png')}}">
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