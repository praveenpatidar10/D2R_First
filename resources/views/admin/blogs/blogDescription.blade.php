<div class="row">
      @isset($temp)
       <div class="col-md-12">
           <img class="img-fluid" src="{{asset('public/images/'.$temp->image)}}" alt="{{$temp->title}}">
       </div>
    <div class="col-md-12">
      
         
         <?php $html = html_entity_decode($temp->description);
         echo $html;?>
        
    </div>
    @endisset
</div>