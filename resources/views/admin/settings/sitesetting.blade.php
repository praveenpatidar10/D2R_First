@extends('layouts.admin')

@section('content')
<style>
    .p-image {
    position: relative;
    text-align: center;
    color: #ffc751;
    transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
    cursor: pointer;
}
.file-upload {
    display: none !important;
}
</style>
 <div class="row">
      <div class="col-md-12">
         <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Email Setup</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="MailSettingForm" action="{{url('admin/settings/save-mail-setting/')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                 <input type="hidden" value="{{$setting->id}}" class="form-control" id="mail_id" name="mail_id" >
                 <div class="card-body">
                    <div class="row"> 
                      <div class="form-group col-md-4">
                        <label for="mail_driver" class="col-form-label">Email Driver</label>
                         <select class="form-control" id="mail_driver" name="mail_driver">
                              <option value="smtp" @if($setting->mail_driver=='smtp') selected @endif>smtp</option>
                              <option value="mail" @if($setting->mail_driver=='mail') selected @endif>mail</option>
                         </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="mail_host" class="col-form-label">Email Host</label>
                          <input type="text" value="{{$setting->mail_host}}" class="form-control" id="mail_host" name="mail_host" placeholder="Enter Mail Host (smtp.googlemail.com)">
                       </div>
                      <div class="form-group col-md-4">
                        <label for="mail_port" class="col-form-label">Email Port</label>
                        <input type="number" value="{{$setting->mail_port}}" class="form-control" id="mail_port" name="mail_port"  placeholder="Enter Mail Post (465,587,2525)">
                       </div>
                      <div class="form-group col-md-4">
                        <label for="mail_username" class="col-form-label">Email Username</label>
                         <input type="text" value="{{$setting->mail_username}}" class="form-control" id="mail_username" name="mail_username" placeholder="Enter mail username (example@gmail.com)">
                       </div>
                      <div class="form-group col-md-4">
                        <label for="mail_password" class="col-form-label">Email Password</label>
                         <input type="password" value="{{$setting->mail_password}}" class="form-control"  id="mail_password" name="mail_password" placeholder="Enter Mail Password">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="mail_encryption" class="col-form-label">Email Encryption</label>
                        <select class="form-control"  class="form-control"  id="mail_encryption" name="mail_encryption">
                              <option value="ssl"  @if($setting->mail_encryption=='ssl') selected @endif>ssl</option>
                              <option value="tls"  @if($setting->mail_encryption=='tls') selected @endif>tls</option>
                         </select>
                       </div>
                      <div class="form-group col-md-4">
                        <label for="mail_from_address" class="col-form-label">Email Address</label>
                        <input type="email" value="{{$setting->mail_from_address}}" class="form-control"  id="mail_from_address" name="mail_from_address" placeholder="Enter mail address (example@gmail.com)">
                       </div>
                      <div class="form-group col-md-4">
                        <label for="mail_from_name" class=" col-form-label">Sender Name</label>
                         <input type="text" value="{{$setting->mail_from_name}}" class="form-control" id="mail_from_name" name="mail_from_name" placeholder="Enter Sender name (DFB CENTRAL)">
                       </div>
                       
                   </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                 <button type="submit" id="btn-mail-setup" class="btn btn-info float-right">UPDATE</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>  
      </div>
      <div class="col-md-12">
         <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Home Page video Contant</h3>
                  </div>
                <div class="card-body">
                    
                    <form class="form-horizontal" id="VideoContentForm" action="#" enctype="multipart/form-data" method="POST">
                      @csrf
                     <input type="hidden" value="{{$setting->id}}" class="form-control" id="homeVideoContent_id" name="homeVideoContent_id" >
                     <input type="hidden" value="home_video_content"  id="column" name="column" >
                     <div class="form-group col-md-12">
                         <label for="mail_host" class="col-form-label">Content</label>
                         <textarea id="homeVideoContent" name="homeVideoContent" class="form-control" id="homeVideoContent" rows="3">{{$setting->home_video_content}}</textarea>
                       </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="update-button-homeVideoContent" style="">Update</a>
                </div>
           </div>
      </div>
       <div class="col-md-12">  
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Home Page video (<span style="font-size: 14px;">Preferred Size:  Width:320px * Height:239px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-homeVideo">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="homeVideo_id" name="homeVideo_id" >
                             <input class="file-upload file-upload-homeVideo" name="website_homeVideo" id="website_homeVideo" type="file" accept="video/mp4"/>
                             
                           </form>
                           <video id="uploaded-elem-homeVideo" autoplay muted loop  style="width: 100%;">
                             <source src="{{asset('media/'.config('custom.website_homeVideo'))}}" id="uploaded-homeVideo" type="video/mp4">
                           </video>
            			</div>
            			<div id="progressBar-homeVideo" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-homeVideo" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-homeVideo" style="">Update</a>
                </div>
           </div>
         
      </div>
      <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Website Logo (<span style="font-size: 14px;">Preferred Size:  Width:320px * Height:239px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-logo">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="logo_id" name="logo_id" >
                             <input class="file-upload file-upload-logo" name="website_logo" id="website_logo" type="file" accept="image/png"/>
                             
                           </form>
                           <img style="width:45%" src="{{asset('media/'.config('custom.website_logo'))}}" id="uploaded-logo" class="avatar-xl rounded-circle" alt="">
            			</div>
            			<div id="progressBar-logo" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-logo" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-logo" style="">Update</a>
                </div>
           </div>
       </div>
       <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">About us image (<span style="font-size: 14px;">Preferred Size:  Width:1500px * Height:666px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-aboutus">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="aboutus_id" name="aboutus_id" >
                             <input class="file-upload file-upload-aboutus" name="aboutusImage" id="aboutusImage" type="file" accept="image/png"/>
                             
                           </form>
                           <img style="width: 75%;" src="{{asset('media/'.config('custom.website_aboutus'))}}" id="uploaded-aboutus" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-aboutus" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-aboutus" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-aboutus" style="">Update</a>
                </div>
           </div>
       </div>
      <?php /* 
       <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Header image (For all Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-header">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="header_id" name="header_id" >
                             <input class="file-upload file-upload-header" name="headerImage" id="headerImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;" src="{{asset('media/'.config('custom.page_header'))}}" id="uploaded-header" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-header" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-header" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-header" style="">Update</a>
                </div>
           </div>
       </div> */?>
       
       <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Contact Form Left Image (Events/Contactus)(<span style="font-size: 14px;">Preferred Size:  Width:2124px * Height:1880px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-contactLeftImage">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="contactLeftImage_id" name="contactLeftImage_id" >
                             <input class="file-upload file-upload-contactLeftImage" name="contactLeftImage" id="contactLeftImage" type="file" accept="image/png"/>
                             
                           </form>
                           <img style="width:45%;" src="{{asset('media/'.config('custom.contact_left_image'))}}" id="uploaded-header" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-contactLeftImage" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-contactLeftImage" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-contactLeftImage" style="">Update</a>
                </div>
           </div>
       </div>
       
       <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">News Letter Icon(<span style="font-size: 14px;">Preferred Size:  Width:612px * Height:408px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-newletterIcon">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="newletterIcon_id" name="newletterIcon_id" >
                             <input class="file-upload file-upload-newletterIcon" name="newletterIcon" id="newletterIcon" type="file" accept="image/png"/>
                             
                           </form>
                           <img style="width: 220px;" src="{{asset('media/'.config('custom.newletter_icon'))}}" id="uploaded-newletterIcon" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-newletterIcon" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-newletterIcon" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-newletterIcon" style="">Update</a>
                </div>
           </div>
       </div>
       
    <div class="col-md-6">
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">subscribe Icon(<span style="font-size: 14px;">Preferred Size:  Width:256px * Height:256px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-subscribeIcon">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="subscribeIcon_id" name="subscribeIcon_id" >
                             <input class="file-upload file-upload-subscribeIcon" name="subscribeIcon" id="subscribeIcon" type="file" accept="image/png"/>
                             
                           </form>
                           <img style="width:145px;" src="{{asset('media/'.config('custom.subscribe_icon'))}}" id="uploaded-subscribeIcon" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-subscribeIcon" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-subscribeIcon" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-subscribeIcon" style="">Update</a>
                </div>
           </div>
       </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (About Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerAbout">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerAbout_id" name="headerAbout_id" >
                             <input class="file-upload file-upload-headerAbout" name="headerAboutImage" id="headerAboutImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_about'))}}" id="uploaded-headerAbout" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerAbout" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerAbout" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerAbout" style="">Update</a>
                </div>
           </div>
    </div>
    
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (Event Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerEvent">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerEvent_id" name="headerEvent_id" >
                             <input class="file-upload file-upload-headerEvent" name="headerEventImage" id="headerEventImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_event'))}}" id="uploaded-headerEvent" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerEvent" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerEvent" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerEvent" style="">Update</a>
                </div>
           </div>
    </div>
    
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (Ministries Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerMinistries">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerMinistries_id" name="headerMinistries_id" >
                             <input class="file-upload file-upload-headerMinistries" name="headerMinistriesImage" id="headerMinistriesImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_ministries'))}}" id="uploaded-headerMinistries" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerMinistries" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerMinistries" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerMinistries" style="">Update</a>
                </div>
           </div>
    </div>
    
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (Blog Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerBlog">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerBlog_id" name="headerBlog_id" >
                             <input class="file-upload file-upload-headerBlog" name="headerBlogImage" id="headerBlogImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_blog'))}}" id="uploaded-headerBlog" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerBlog" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerBlog" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerBlog" style="">Update</a>
                </div>
           </div>
    </div>
    
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (Gallery Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerGallery">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerGallery_id" name="headerGallery_id" >
                             <input class="file-upload file-upload-headerGallery" name="headerGalleryImage" id="headerGalleryImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_gallery'))}}" id="uploaded-headerGallery" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerGallery" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerGallery" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerGallery" style="">Update</a>
                </div>
           </div>
    </div>
    
    <div class="col-md-12">
        <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Header image (Contact us Pages) (<span style="font-size: 14px;">Preferred Size:  Width:1280px * Height:553px</span>)</h3>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="p-image">
            		       <form action="#" method="post" enctype="multipart/form-data" id="form-upload-headerContactus">
                             @csrf
                             <input type="hidden" value="{{$setting->id}}" class="form-control" id="headerContactus_id" name="headerContactus_id" >
                             <input class="file-upload file-upload-headerContactus" name="headerContactusImage" id="headerContactusImage" type="file" accept="image/jpeg"/>
                             
                           </form>
                           <img style="width: 100%;height: 270px;" src="{{asset('media/'.config('custom.page_header_contactus'))}}" id="uploaded-headerContactus" class="avatar-xl " alt="">
            			</div>
            			<div id="progressBar-headerContactus" class="progress progress-sm active" style="display:none;">
                          <div class="progress-bar bg-success progress-bar-striped" id="progressBar-striped-headerContactus" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-success btn-sm" id="upload-button-headerContactus" style="">Update</a>
                </div>
           </div>
    </div>
</div>
@endsection
