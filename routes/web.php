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

Route::get('/', function () {
    return view('welcome');
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
         Route::post('events/getdatatable', 'Admin\EventsController@getEventsDatatable');
         Route::get('event/status/update/{id}/{status}', 'Admin\EventsController@statusUpdate');
         Route::post('events/mark-live', 'Admin\EventsController@statusMarkLive');
         Route::get('event/getDesc/{id}', 'Admin\EventsController@showEventDescription');
         Route::get('event/delete/{id}', 'Admin\EventsController@deleteEvent');
         
          //Subscriber
         Route::get('subscribers', 'Admin\SubscribersController@index')->name('admin.subscribers');
         Route::post('subscribers/getdatatable', 'Admin\SubscribersController@getSubscribersDatatable');
         Route::get('subscriber/status/update/{id}/{status}', 'Admin\SubscribersController@statusUpdate');
         Route::get('subscriber/delete/{id}', 'Admin\SubscribersController@deleteSubscriber');
         
          //Groups
         Route::get('groups', 'Admin\GroupsController@index')->name('admin.groups');
         Route::post('groups/save', 'Admin\GroupsController@saveGroups');
         Route::post('groups/getdatatable', 'Admin\GroupsController@getGroupsDatatable');
         Route::get('group/status/update/{id}/{status}', 'Admin\GroupsController@statusUpdate');
         //Route::get('event/getDesc/{id}', 'Admin\EventsController@showEventDescription');
         Route::get('group/delete/{id}', 'Admin\GroupsController@deleteGroup');
         
});


