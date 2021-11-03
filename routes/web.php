<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'WelcomeController@index');
Route::get('/about-us.htm', 'WelcomeController@aboutUsPage');
Route::get('/dbf-satsang.htm', 'WelcomeController@satSangPage');
Route::get('/events.htm', 'WelcomeController@eventsPage');
Route::get('/resources.htm', 'WelcomeController@resourcesPage');
Route::get('/blogs.htm', 'WelcomeController@blogsPage');
Route::get('/blog-detail.htm/{param}', 'WelcomeController@blogsDeatilPage');
Route::get('/ministries.htm', 'WelcomeController@ministriesPage');
Route::get('/gallery.htm', 'WelcomeController@galleryPage');
Route::get('/contact-us.htm', 'WelcomeController@contactusPage');
Route::get('/join-us.htm', 'WelcomeController@joinusPage');

Route::post('/user-subscribe.htm', 'WelcomeController@addUserSubscription');
Route::post('/post-enquiry.htm', 'WelcomeController@savePostEnquiry');
Route::post('/get-resource-data.htm', 'WelcomeController@getVideoIndexing');
Route::post('/update-visit-preferance.htm', 'WelcomeController@setVisitPreference');

 Route::get('/clear-cache', function() {
         // $exitCode = Artisan::call('route:cache');
          $exitCode = Artisan::call('config:cache');
          $exitCode = Artisan::call('cache:clear');
          $exitCode = Artisan::call('view:clear');
         return 'Application cache cleared';
     });

Route::get('/cc', function () {
    Artisan::call('cache:clear');
    echo '<script>alert("cache clear Success")</script>';
});
Route::get('/ccc', function () {
    Artisan::call('config:cache');
    echo '<script>alert("config cache Success")</script>';
});
Route::get('/vc', function () {
    Artisan::call('view:clear');
    echo '<script>alert("view clear Success")</script>';
});
Route::get('/cr', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear Success")</script>';
});
Route::get('/coc', function () {
    Artisan::call('config:clear');
    echo '<script>alert("config clear Success")</script>';
});
Route::get('/storage123', function () {
    Artisan::call('storage:link');
    echo '<script>alert("linked")</script>';
});

Auth::routes();
 
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
        Route::get('dashboard', 'Admin\DashoardController@index')->name('admin.dashboard');
        
        //Blogs
         Route::get('blogs', 'Admin\BlogsController@index')->name('admin.blogs');
         Route::get('blogs/manage/{param?}', 'Admin\BlogsController@manage');
         Route::post('blogs/save', 'Admin\BlogsController@saveBlogs');
         Route::post('blogs/getdatatable', 'Admin\BlogsController@getBlogsDatatable');
         Route::get('blog/status/update/{id}/{status}', 'Admin\BlogsController@statusUpdate');
         Route::get('blog/getDesc/{id}', 'Admin\BlogsController@showBlogDescription');
         Route::get('blog/delete/{id}', 'Admin\BlogsController@deleteBlog');
         
          //Events
         Route::get('events', 'Admin\EventsController@index')->name('admin.events');
         Route::get('events/manage/{param?}', 'Admin\EventsController@manage');
         Route::post('events/save', 'Admin\EventsController@saveEvents');
         Route::post('events/getdatatable/{param?}', 'Admin\EventsController@getEventsDatatable');
         Route::post('events/getdatatable-past', 'Admin\EventsController@getEventsDatatablePast');
         Route::get('event/status/update/{id}/{status}', 'Admin\EventsController@statusUpdate');
         Route::post('events/mark-live', 'Admin\EventsController@statusMarkLive');
          Route::post('events/mark-home-display', 'Admin\EventsController@homeDisplayMark');
         Route::get('event/getDesc/{id}', 'Admin\EventsController@showEventDescription');
         Route::get('event/delete/{id}', 'Admin\EventsController@deleteEvent');
         
         //ministreis
         Route::get('ministries', 'Admin\MinistriesController@index')->name('admin.ministries');
         Route::get('ministries/manage/{param?}', 'Admin\MinistriesController@manage');
         Route::post('ministries/save', 'Admin\MinistriesController@saveMinistries');
         Route::post('ministries/getdatatable', 'Admin\MinistriesController@getMinistriesDatatable');
         Route::get('ministries/status/update/{id}/{status}', 'Admin\MinistriesController@statusUpdate');
         Route::get('ministries/getDesc/{id}', 'Admin\MinistriesController@showMinistriesDescription');
         Route::get('ministries/delete/{id}', 'Admin\MinistriesController@deleteMinistries');
         
          //Subscriber
         Route::get('subscribers', 'Admin\SubscribersController@index')->name('admin.subscribers');
         Route::post('subscribers/getdatatable', 'Admin\SubscribersController@getSubscribersDatatable');
         Route::get('subscriber/status/update/{id}/{status}', 'Admin\SubscribersController@statusUpdate');
         Route::get('subscriber/delete/{id}', 'Admin\SubscribersController@deleteSubscriber');
         Route::post('subscribers/import', 'Admin\SubscribersController@importExcel');
         
         
          //Groups
         Route::get('groups', 'Admin\GroupsController@index')->name('admin.groups');
         Route::post('groups/save', 'Admin\GroupsController@saveGroups');
         Route::post('groups/getdatatable', 'Admin\GroupsController@getGroupsDatatable');
         Route::get('group/status/update/{id}/{status}', 'Admin\GroupsController@statusUpdate');
         Route::get('group/members/{id}', 'Admin\GroupsController@groupMembers');
         Route::post('group/members/manage/{param}/{id}', 'Admin\GroupsController@groupMembersManage');
         Route::get('group/delete/{id}', 'Admin\GroupsController@deleteGroup');
         
         //Templates
         Route::get('templates', 'Admin\TemplateController@index')->name('admin.templates');
         Route::get('templates/manage/{param?}', 'Admin\TemplateController@manage');
         Route::post('templates/save', 'Admin\TemplateController@saveTemplates');
         Route::post('templates/getdatatable', 'Admin\TemplateController@getTemplatesDatatable');
         Route::get('template/status/update/{id}/{status}', 'Admin\TemplateController@statusUpdate');
         Route::get('template/getDesc/{id}', 'Admin\TemplateController@showTemplateDescription');
         Route::get('template/delete/{id}', 'Admin\TemplateController@deleteTemplate');
         
          //Templates
         Route::get('mail-box', 'Admin\MailerController@index')->name('admin.mailbox');
         Route::post('sendmail', 'Admin\MailerController@sendMail');
         Route::get('mail/get-group-mail/{id}', 'Admin\MailerController@getGroupMembers');
         
         //Site Settings
         Route::get('settings', 'Admin\Setting@index')->name('admin.settings');
         Route::post('settings/save-mail-setting', 'Admin\Setting@saveMailSettings');
         Route::post('settings/update/site-setting', 'Admin\Setting@updateSiteSettings');
         
         //Galleries
         Route::get('satsang', 'Admin\SatsangsController@index')->name('admin.satsang');
         Route::post('satsang/save', 'Admin\SatsangsController@saveFile');
         Route::get('satsang/delete/{id}', 'Admin\SatsangsController@deleteGallery');
         
         
          //Collaborators
         Route::get('collaborators', 'Admin\CollaboratorsController@index')->name('admin.collaborator');
         Route::get('collaborators/manage/{param?}', 'Admin\CollaboratorsController@manage');
         Route::post('collaborators/save', 'Admin\CollaboratorsController@saveCollaborators');
         Route::post('collaborators/getdatatable', 'Admin\CollaboratorsController@getCollaboratorsDatatable');
         Route::get('collaborator/status/update/{id}/{status}', 'Admin\CollaboratorsController@statusUpdate');
         Route::get('collaborator/getDesc/{id}', 'Admin\CollaboratorsController@showCollaboratorDescription');
         Route::get('collaborator/delete/{id}', 'Admin\CollaboratorsController@deleteCollaborator');
         
         //Blogs
         Route::get('resources', 'Admin\ResourcesController@index')->name('admin.resources');
         Route::get('resources/manage/{param?}', 'Admin\ResourcesController@manage');
          Route::get('resources/view/{param?}', 'Admin\ResourcesController@view');
         Route::post('resources/save', 'Admin\ResourcesController@saveResources');
         Route::post('resources/video-indexing/save', 'Admin\ResourcesController@saveResourcesVideoIndexing');
         
         Route::post('resources/getdatatable', 'Admin\ResourcesController@getResourcesDatatable');
         Route::get('resources/status/update/{id}/{status}', 'Admin\ResourcesController@statusUpdate');
         Route::get('resources/getDesc/{id}', 'Admin\ResourcesController@showResourcesDescription');
         Route::get('resources/delete/{id}', 'Admin\ResourcesController@deleteResources');
         Route::get('resources/video-index/delete/{id}', 'Admin\ResourcesController@deleteResourcesIndex');
         
         
      //   Route::post('settings/save-mail-setting', 'Admin\Setting@saveMailSettings');
         
});


