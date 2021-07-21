<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/toastr/toastr.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('js/confirm/css/jquery-confirm.css')}}" type="text/css">
     <link rel="stylesheet" href="https://toert.github.io/Isolated-Bootstrap/versions/4.0.0-beta/iso_bootstrap4.0.0min.css"><!-- for ministries-->
    <title>DBF CENTRAL</title>
    <style>
        .has-error{
            border-color: #f43c3c !important;
        }
    </style>
</head>
<body>
    <nav id="navbar" class="navbar">
        <a href="{{url('/')}}" class="logo-a"><img src="{{asset('media/logo.png')}}" alt="logo" class="logo-i"></a>
        <ul class="nav-list">
            <li class="navf nav-item"><a class="@if($Link=='home') active-page @endif" href="{{url('/')}}">Home</a></li>
            <li class="navf nav-item"><a class="@if($Link=='about') active-page @endif" href="{{url('/about-us.htm')}}">About Us</a></li>
            <li class="navf nav-item"><a class="@if($Link=='events') active-page @endif" href="{{url('/events.htm')}}">Events</a></li>
            <li class="navf nav-item"><a class="@if($Link=='ministries') active-page @endif" href="{{url('/ministries.htm')}}">Ministries</a></li>
            <li class="navf nav-item"><a class="@if($Link=='blogs') active-page @endif" href="{{url('/blogs.htm')}}">Blog</a></li>
            <li class="navf nav-item"><a class="@if($Link=='gallery') active-page @endif" href="{{url('/gallery.htm')}}">Gallery</a></li>
            <li class="navf nav-item"><a class="@if($Link=='contactus') active-page @endif" href="{{url('/contact-us.htm')}}">Contact Us</a></li>
        </ul>
        <div id="menuToggle">
            <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
            <ul id="menu">
                <li class="navf"><a href="{{url('/')}}">Home</a></li>
                <li class="navf"><a href="{{url('/about-us.htm')}}">About Us</a></li>
                <li class="navf"><a href="{{url('/events.htm')}}">Events</a></li>
                <li class="navf"><a href="{{url('/ministries.htm')}}">Ministries </a></li>
                <li class="navf"><a href="{{url('/blogs.htm')}}">Blog</a></li>
                <li class="navf"><a href="{{url('/gallery.htm')}}">Gallery</a></li>
                <li class="navf"><a href="{{url('/contact-us.htm')}}">Contact Us</a></li>
                <li class="navf"><a href="{{url('/contact-us.htm')}}">Join Us</a></li>
            </ul>
        </div>
    </nav>
      @yield('content')
    <footer>
        <div class="instagramfeed">
            <a href="https://www.instagram.com/dbfcentral/" class="hf2">Our Latest Posts on Instagram</a>
            <div id="instagramfeedPlaceholder"></div>
            <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
            <script src="{{asset('js/instagramFeed.js')}}"></script>
        </div>
        <div>
            <div class="logo">
                <img src="{{asset('media/logo.png')}}" alt="Logo">
                <div class="social">
                    <h2 class="hf2">Don't forget to Follow us at</h2>
                    <div class="links">
                        <a class="follow" href="https://www.youtube.com/user/CDCTeaching/videos" target="_blank" style="margin: 0 15% 0 0;"><i class="fab fa-youtube"></i></a>
                        <a class="follow" href="https://www.instagram.com/dbfcentral/" target="_blank" style="margin: 0 5% 0 15%;"><i class="fab fa-instagram"></i></a>
                        <a class="follow" href="https://www.facebook.com/DBFCDC" target="_blank" style="margin: 0 15% 0 35%;"><i class="fab fa-facebook-square"></i></a>
                        <a class="follow" href="https://twitter.com/DBFCDC" target="_blank" style="margin: 0 0 0 40%;"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="support">
                <h2 class="hf2">Support</h2>
                <ul class="footer-list">
                    <li class="bf"><a href="{{url('/about-us.htm')}}"><h3>About Us</h3></a></li>
                    <li class="bf"><a href="{{url('/events.htm')}}"><h3>Events</h3></a></li>
                    <li class="bf"><a href="{{url('/ministries.htm')}}"><h3>Ministries</h3></a></li>
                    <li class="bf"><a href="{{url('/blogs.htm')}}"><h3>Blog</h3></a></li>
                    <li class="bf"><a href="{{url('/gallery.htm')}}"><h3>Gallery</h3></a></li>
                    <li class="bf"><a href="{{url('/contact-us.htm')}}"><h3>Contact Us</h3></a></li>
                    <li class="bf"><a href="{{url('/join-us.htm')}}"><h3>Join Us</h3></a></li>
                </ul>
            </div>
            <div class="address">
                <h2 class="hf2">Get in Touch!</h2>
                <address><h3 class="bf">011-23342732<br>centraloffice@dbfcentral.org<br><br>22, Bhai Vir Singh Marg, Gole Market, New Delhi - 110001</h3></address>
            </div>
        </div>
        <div class="copyright">
            <h3 class="hf2">Copyright Information</h3>
        </div>
    </footer>
    <script src="{{asset('js/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery/jquery.validate.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript"> var base_url = "{{url('/')}}"; </script> 
    <script src="{{asset('js/nav-scroll.js')}}"></script>
    <script src="{{asset('js/nav-scroll-mob.js')}}"></script>
    <script src="{{asset('js/readmore.js')}}"></script><!-- for ministries-->
    <script src="https://kit.fontawesome.com/2bb7f1865a.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/toastr/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/confirm/js/jquery-confirm.js')}}" type="text/javascript"></script>
     <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>