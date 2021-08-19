@extends('layouts.web')
@section('content')
 <header class="about-header" style="background-image: url('./media/{{config('custom.page_header_gallery')}}');;background-position: center;background-repeat: no-repeat;">
        <!--<h1 class="hf1">Welcome to the Arcade!</h1>-->
    </header>


    <div class="container gallery-container">
        @foreach($images as $img)
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('images/'.$img->image)}}">
                    <div class="gallery-subtitle-overlay"><p>{{$img->title}}</p><div>
                </div>
        </section>
        @endforeach
        <?php /*
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('media/gallery-tile.jpg')}}">
                    <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
                </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('media/gallery-tile.jpg')}}">
                    <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
                </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('media/gallery-tile.jpg')}}">
                    <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
                </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('media/gallery-tile.jpg')}}">
                    <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
                </div>
        </section>
        <section class="gallery-wrapper">
            <div class="gallery-tile">
                <img src="{{asset('media/gallery-tile.jpg')}}">
                <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
            </div>
        </section>
        <section class="gallery-wrapper">
                <div class="gallery-tile">
                    <img src="{{asset('media/gallery-tile.jpg')}}">
                    <div class="gallery-subtitle-overlay"><p>Image Description</p><div>
                </div>
        </section> */?>
    </div>


@endsection