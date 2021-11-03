@extends('layouts.web')
@section('content')
<style>
    



.text-center {
  text-align: center;
}

.image {
  display: block;
  max-width: 100%;
  height: auto;
}

.image--center {
  margin-left: auto;
  margin-right: auto;
}

.row-contain{
    max-width: 1400px;
    margin-top: 15%;
}


/* GRID */

/* CONTAINER */
/*.container {*/
/*  margin-left: auto;*/
/*  margin-right: auto;*/
/*  padding-left: 15px;*/
/*  padding-right: 15px;*/
/*}*/

/*@media (min-width: 768px) {*/
/*  .container {*/
/*    width: 750px;*/
/*  }*/
/*}*/

/*@media (min-width: 992px) {*/
/*  .container {*/
/*    width: 970px;*/
/*  }*/
/*}*/

/*@media (min-width: 1200px) {*/
/*  .container {*/
/*    width: 1170px;*/
/*  }*/
/*}*/


/* ROW */
.row {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  grid-gap: 20px;
}


.col-xs-12 {
  grid-column: span 12
}

.col-xs-11 {
  grid-column: span 11;
}

.col-xs-10 {
  grid-column: span 10
}

.col-xs-9 {
  grid-column: span 9
}

.col-xs-8 {
  grid-column: span 8
}

.col-xs-7 {
  grid-column: span 7
}

.col-xs-6 {
  grid-column: span 6
}

.col-xs-5 {
  grid-column: span 5
}

.col-xs-4 {
  grid-column: span 4
}

.col-xs-3 {
  grid-column: span 3
}

.col-xs-2 {
  grid-column: span 2
}

.col-xs-1 {
  grid-column: span 1
}

@media (min-width: 768px) {
  .col-sm-12 {
    grid-column: span 12
  }

  .col-sm-11 {
    grid-column: span 11;
  }

  .col-sm-10 {
    grid-column: span 10
  }

  .col-sm-9 {
    grid-column: span 9
  }

  .col-sm-8 {
    grid-column: span 8
  }

  .col-sm-7 {
    grid-column: span 7
  }

  .col-sm-6 {
    grid-column: span 6
  }

  .col-sm-5 {
    grid-column: span 5
  }

  .col-sm-4 {
    grid-column: span 4
  }

  .col-sm-3 {
    grid-column: span 3
  }

  .col-sm-2 {
    grid-column: span 2
  }

  .col-sm-1 {
    grid-column: span 1
  }
}

@media (min-width: 992px) {
  .col-md-12 {
    grid-column: span 12
  }

  .col-md-11 {
    grid-column: span 11;
  }

  .col-md-10 {
    grid-column: span 10
  }

  .col-md-9 {
    grid-column: span 9
  }

  .col-md-8 {
    grid-column: span 8
  }

  .col-md-7 {
    grid-column: span 7
  }

  .col-md-6 {
    grid-column: span 6
  }

  .col-md-5 {
    grid-column: span 5
  }

  .col-md-4 {
    grid-column: span 4
  }

  .col-md-3 {
    grid-column: span 3
  }

  .col-md-2 {
    grid-column: span 2
  }

  .col-md-1 {
    grid-column: span 1
  }
}

@media (min-width: 1200px) {
  .col-lg-12 {
    grid-column: span 12
  }

  .col-lg-11 {
    grid-column: span 11;
  }

  .col-lg-10 {
    grid-column: span 10
  }

  .col-lg-9 {
    grid-column: span 9
  }

  .col-lg-8 {
    grid-column: span 8
  }

  .col-lg-7 {
    grid-column: span 7
  }

  .col-lg-6 {
    grid-column: span 6
  }

  .col-lg-5 {
    grid-column: span 5
  }

  .col-lg-4 {
    grid-column: span 4
  }

  .col-lg-3 {
    grid-column: span 3
  }

  .col-lg-2 {
    grid-column: span 2
  }

  .col-lg-1 {
    grid-column: span 1
  }
}

.outer-index-elem{
    font-size: 14px;font-family:'Poppins', sans-serif;
}
.outer-index-elem a{color: #13a1e3;}
.outer-index-elem a span{font-size: 12px;float: right}
.col-preview h6,.col-preview p{
    font-family:'Poppins', sans-serif;
}
</style>
 <header class="about-header" style="background-image: url('./media/{{config('custom.page_header_contactus')}}');;background-position: center;background-repeat: no-repeat;">
        <!--<h1 class="hf1">We'd love to hear from You!</h1>-->
    </header>


    <div class="container contactus-container">
        <h1 class="trianglesection" style="background: #13a1e3; width: 100%; color: #13a1e3;"><br><br><br></h1>
        <svg id="CONTACTbigTriangleColor1" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="box-shadow: 0px -20px #13a1e3;margin-bottom: 15%;" >
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>

        <section class="contactus pb-5" style="background-color: #ffffff;padding-bottom: 35%;">
            <div class="container row-contain">
            <div class="contactus-title"><h2 class="hf2"><span id="latestTitle">{{$latest->title}}</span></h2></div>
            <div class="row">
                  <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12" id="player">
                    <!--<iframe width="100%" id="existing-iframe-example"  height="523" -->
                    <!--        src="https://www.youtube.com/embed/{{$latest->videoId}}?enablejsapi=1" -->
                    <!--       title="YouTube video player" frameborder="0" -->
                    <!--      allowfullscreen></iframe>-->
                  </div><!-- div col-8 -->
                  <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12" style="border: 1px solid #ccc;padding: 10px 8px;">
                    <div style="border: 1px solid #ccc;box-shadow: 0 1px 2px hsla(0,0%,0%,0.05),0 1px 4px hsla(0,0%,0%,0.05),0 2px 8px hsla(0,0%,0%,0.05);">
                        <div style="padding: 10px 8px;border-bottom: 1px solid #ccc;">
                            <h2 style="font-size:14px;font-family:'Poppins', sans-serif;">Video Index</h2>
                        </div>
                        <div style="padding: 10px 8px;" id="current-videoIndex">
                            @if(isset($latestIndexes))
                             @foreach($latestIndexes as $indx)
                                <p class="outer-index-elem"> 
                                    <a  data-videoId="{{$latest->videoId}}" data-index="{{$indx->indexTime}}" class="playIndex" href="#">{{$indx->title}}
                                      <span >({{$indx->labelTime}})</span>
                                    </a>
                                </p>
                             @endforeach
                            @endif
                           
                        </div>
                        
                    </div>
                     <br/>
                     <div style="border: 1px solid #ccc;box-shadow: 0 1px 2px hsla(0,0%,0%,0.05),0 1px 4px hsla(0,0%,0%,0.05),0 2px 8px hsla(0,0%,0%,0.05);">
                         <div style="padding: 10px 8px;border-bottom: 1px solid #ccc;">
                            <h2 style="font-size:14px;font-family:'Poppins', sans-serif;">Related Videos</h2>
                        </div>
                        <div style="padding: 10px 8px;">
                        
                        @if(isset($others))
                          @foreach($others as $othr)
                            <div class="row" >
                                 <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                                     <img onclick="playNewVideo('{{$othr->videoId}}',0)" src="https://img.youtube.com/vi/{{$othr->videoId}}/default.jpg" />
                                     <!--<iframe width="100%" src="https://www.youtube.com/embed/{{$othr->videoId}}" title="YouTube video player" frameborder="0" -->
                                     <!--        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                                            
                                 </div>
                                 <div class="col-preview col-lg-8 col-md-8 col-xs-12 col-sm-12">
                                     <h6 onclick="playNewVideo('{{$othr->videoId}}',0)">{{$othr->title}}</h6>
                                     <?php  $date=date_create($othr->created_at);?>
                                     <p>{{date_format($date,"F d,Y")}}</p>
                                 </div>
                             </div>
                         @endforeach
                        @endif
                        <br/>
                        <div class="d-flex justify-content-center">
                            {!! $others->links() !!}
                        </div>
                    
                         
                        </div>
                         
                     </div>
                     
                  </div><!-- div right side col-4-->
           </div>
           </div>
    <!-- /.row -->
        </section>
          <svg id="MINISTRYbigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none" style="background: white; ">
            <path d="M0 0 L50 100 L100 0 Z" />
        </svg>
    </div>
    



@endsection


