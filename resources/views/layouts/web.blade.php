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
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('media/favicon/site.webmanifest')}}">
    
    
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
        
        .btnSubmitForm{
            padding: 10px 35px;
           
            background-color: #812c90;
            color: #fff;
            border-color: #812c90;
        }
        


.pagination {
  display: inline-block;
}
.pagination li {
    display: inline;
}
.pagination  li.active span{
    background-color: #13A1E3;
   color: white;
}

.pagination span,  .pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination span.active,.pagination a.active {
  background-color: #13A1E3;
  color: white;
}
.pagination li:hover:not(.active) a{
    background-color: #ddd;
}
.pagination a:hover:not(.active),.pagination span:hover:not(.active) {background-color: #ddd;} 
        
    </style>
</head>
<body>
    <?php $show=true;?>
    @if(isset($subtitle))
    @if($subtitle=='Home')
        <?php  if($hasSession=='No'){ 
            $show = false;
        }?>
    @endif
    @endif
      @if($show)
           <nav id="navbar" class="navbar">
        
        <a href="{{url('/')}}" class="logo-a">
            @if($subtitle=="DBF Satsang")
             <img src="{{asset('/media/'.config('custom.satsang_logo'))}}" alt="logo" class="logo-i">
            @else
             <img src="{{asset('/media/'.config('custom.website_logo'))}}" alt="logo" class="logo-i">
            @endif
        </a>
        <ul class="nav-list">
            <li class="navf nav-item"><a class="@if($Link=='home') active-page @endif" href="{{url('/')}}">Home</a></li>
            <li class="navf nav-item"><a class="@if($Link=='about') active-page @endif" href="{{url('/about-us.htm')}}">About Us</a></li>
            <li class="navf nav-item"><a class="@if($Link=='satsang') active-page @endif" href="{{url('/dbf-satsang.htm')}}">DBF Satsang</a></li>
            <li class="navf nav-item"><a class="@if($Link=='events') active-page @endif" href="{{url('/events.htm')}}">Events</a></li>
            <li class="navf nav-item"><a class="@if($Link=='ministries') active-page @endif" href="{{url('/ministries.htm')}}">Ministries</a></li>
            <li class="navf nav-item"><a class="@if($Link=='blogs') active-page @endif" href="{{url('/blogs.htm')}}">Blog</a></li>
            <li class="navf nav-item"><a class="@if($Link=='resources') active-page @endif" href="{{url('/resources.htm')}}">Resources</a></li>
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
                <li class="navf"><a href="{{url('/about-us.htm')}}">DBF Satsang</a></li>
                <li class="navf"><a href="{{url('/events.htm')}}">Events</a></li>
                <li class="navf"><a href="{{url('/ministries.htm')}}">Ministries </a></li>
                <li class="navf"><a href="{{url('/blogs.htm')}}">Blog</a></li>
                <?php /*<li class="navf"><a href="{{url('/gallery.htm')}}">Gallery</a></li> */?>
                <li class="navf"><a href="{{url('/contact-us.htm')}}">Contact Us</a></li>
                <?php /*<li class="navf"><a href="{{url('/contact-us.htm')}}">Join Us</a></li> */?>
            </ul>
        </div>
    </nav>
     @endif
      @yield('content')
      
        <footer  style="background: white; ">
        <div class="instagramfeed" style="background: white; ">
            <a href="https://www.instagram.com/dbfcentral/" class="hf2" style="color: black;" >Our Latest Posts on Instagram</a>
            <div id="instagramfeedPlaceholder"></div>
            <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
            <script src="{{asset('js/instagramFeed.js')}}"></script>
            <br><br><br><br>
        </div>
        <div class="footer-section">
            <div class="logo">
                <img src="{{asset('/media/'.config('custom.website_logo'))}}" alt="Logo">
                <div class="social">
                    <h2 class="hf2">Don't forget to Follow us at</h2>
                    <div class="links">
                        <a class="follow" href="{{config('custom.youtube_link')}}" target="_blank" style="margin: 0 15% 0 0;"><i class="fab fa-youtube"></i></a>
                        <a class="follow" href="{{config('custom.insta_link')}}" target="_blank" style="margin: 0 5% 0 15%;"><i class="fab fa-instagram"></i></a>
                        <a class="follow" href="{{config('custom.facebook_link')}}" target="_blank" style="margin: 0 15% 0 35%;"><i class="fab fa-facebook-square"></i></a>
                        <a class="follow" href="{{config('custom.twitter_link')}}" target="_blank" style="margin: 0 0 0 40%;"><i class="fab fa-twitter"></i></a>
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
                   <?php /* <li class="bf"><a href="{{url('/gallery.htm')}}"><h3>Gallery</h3></a></li> */?>
                    <li class="bf"><a href="{{url('/contact-us.htm')}}"><h3>Contact Us</h3></a></li>
                    <?php /*<li class="bf"><a href="{{url('/join-us.htm')}}"><h3>Join Us</h3></a></li> */?>
                </ul>
            </div>
            <div class="address">
                <h2 class="hf2">Get in Touch!</h2>
                <address><h3 class="bf">{{config('custom.contact_phone')}}<br>{{config('custom.contact_email')}}<br><br>{{config('custom.contact_address')}}</h3></address>
            </div>
        </div>
        <div class="copyright">
            <h3 class="hf2">© 2021 DBF Central</h3>
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
     
     <script>
         function setvisitPreference(visit){
             $.post(base_url+"/update-visit-preferance.htm",{visit:visit},function(resp) {
                 //if(visit=="DBFSATSANG"){
                   window.location.href=resp
                 //}
             });
         }
     </script>
     
     
     @if($Link=='resources')
     
     <!DOCTYPE html>
<html>
  <body>
    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '530',
          width: '100%',
          videoId: 'Zw7FNrajTSY',
          playerVars: {
            'playsinline': 1, 'controls': 0 
          },
          origin:"https://fmhc.visionux.in",
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }
      
      

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 4000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
      
      function playVideoByID(videoId,startTime){
         player.loadVideoById({'videoId': videoId,
                              'startSeconds': startTime
                             });
        }
        
        function playNewVideo(videoId,startTime){
            getVideoData(videoId);
            player.loadVideoById({'videoId': videoId,
                                 'startSeconds': startTime
                             });
                            
        }
        
        function getVideoData(videoId){
            $('#current-videoIndex').empty();
            $.post(base_url+'/get-resource-data.htm',{videoId:videoId},function(result){
               if($.trim(result.status)=='success'){
                  // console.log(result.data);
                  var html ="";
                   $.each(result.data.indexes, function (index, data) {
                        console.log('index', data);
                        
                        html +="<p class='outer-index-elem'>"
                                    +"<a data-videoId='"+result.data.resource.videoId+"' data-index='"+data.indexTime+"' class='playIndex' href='#' >"+data.title
                                      +"<span>("+data.labelTime+")</span>"
                                    +"</a>"
                                +"</p>";
                    })
                    
                     $('#current-videoIndex').html(html);
                     $('#latestTitle').text(result.data.resource.title);
               } 
            },'json');
        } 
        
        $('body').on('click','.playIndex',function(e){
            e.preventDefault();
            var videoId = $(this).attr('data-videoId');
            var videoIndex = $(this).attr('data-index');
            playVideoByID(videoId,videoIndex);
        })
    </script>
     <script type="text/javascript">
        //   var tag = document.createElement('script');
        //   tag.id = 'iframe-demo';
        //   tag.src = 'https://www.youtube.com/iframe_api';
        //   var firstScriptTag = document.getElementsByTagName('script')[0];
        //   firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        
        //   var player;
        //   function onYouTubeIframeAPIReady() {
        //     player = new YT.Player('existing-iframe-example', {
        //         events: {
        //           'onReady': onPlayerReady,
        //           'onStateChange': onPlayerStateChange
        //         }
        //     });
        //   }
        //   function onPlayerReady(event) {
        //     document.getElementById('existing-iframe-example').style.borderColor = '#FF6D00';
            
        //   }
        //   function changeBorderColor(playerStatus) {
        //     var color;
        //     if (playerStatus == -1) {
        //       color = "#37474F"; // unstarted = gray
        //     } else if (playerStatus == 0) {
        //       color = "#FFFF00"; // ended = yellow
        //     } else if (playerStatus == 1) {
        //       color = "#33691E"; // playing = green
        //     } else if (playerStatus == 2) {
        //       color = "#DD2C00"; // paused = red
        //     } else if (playerStatus == 3) {
        //       color = "#AA00FF"; // buffering = purple
        //     } else if (playerStatus == 5) {
        //       color = "#FF6DOO"; // video cued = orange
        //     }
        //     if (color) {
        //       document.getElementById('existing-iframe-example').style.borderColor = color;
        //     }
        //   }
        //   function onPlayerStateChange(event) {
        //     changeBorderColor(event.data);
        //   }
        </script>
  @endif
</body>
</html>