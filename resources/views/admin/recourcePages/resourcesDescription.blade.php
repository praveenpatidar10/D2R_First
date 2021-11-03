<div class="row">
      @isset($temp)
       <div class="col-md-12">
         
         <iframe style="width:100%;height:400px;" src="https://www.youtube.com/embed/{{$temp->videoId}}"
                 title="{{$temp->title}}" 
                 frameborder="0"
                 allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                 allowfullscreen>
            
         </iframe>
       </div>

    @endisset
</div>