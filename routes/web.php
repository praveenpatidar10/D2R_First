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
         
});


