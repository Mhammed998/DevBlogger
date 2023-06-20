<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth' ,
 'namespace' => 'backend' ,'prefix' => 'dashboard' ] , function(){
    Route::get('/main', 'DashboardController@index');
    Route::get('/account-profile/show' , 'DashboardController@showAccountProfile')->name('account-profile.show');
    Route::get('/account-profile/edit' , 'DashboardController@editAccountProfile')->name('account-profile.edit');
    Route::post('update-user-password/{id}' ,'UserController@updatePassword' )->name('user-password.update');


});

Route::group(['middleware' =>'auth', 'prefix' => 'dashboard'] , function(){
    Route::resource('roles','backend\RoleController');
    Route::resource('users','backend\UserController');
    Route::resource('categories','backend\CategoryController');
    Route::resource('posts','backend\PostController');
    Route::resource('comments','backend\CommentController');
    Route::resource('tags','backend\TagController');





});



