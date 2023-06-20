<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'frontend'] , function(){
   Route::get('/' , 'SiteController@index')->name('site.index');
});


Route::group(['namespace' => 'frontend' , 'middleware'=> 'auth'] , function(){
    Route::get('/posts/{postId}/show-post-details' , 'SiteController@showPostDetails')->name('site.post-details');
    Route::post('/comments/store' , 'SiteController@saveComment')->name('user-comment.store');
    Route::post('/comments/reply' , 'SiteController@storeRepliedComment')->name('user-comment.store-reply');
    Route::delete('/comments/delete/{id}' , 'SiteController@deleteComment')->name('user-comment.delete');
    Route::put('/comments/update/{id}' , 'SiteController@updateComment')->name('user-comment.update');
    Route::get('author/{id}/profile' , 'SiteController@showAuthorProfile')->name('author.profile');
    Route::get('Account/profile' , 'SiteController@showAccountprofile')->name('account.profile');
    Route::get('Account/profile/edit' , 'SiteController@editAccountprofile')->name('account.edit-profile');
    Route::put('Account/profile/update-info/{id}' , 'SiteController@updateAccountInfo')->name('account.update-profile');
    Route::put('Account/profile/update-password/{id}' , 'SiteController@updateAccountPassword')->name('account.update-password');
    Route::get('categories/{id}/show' , 'SiteController@showCategory')->name('show.category');
    Route::get('tags/{id}/show' , 'SiteController@tagPosts')->name('tag.posts');
    Route::get('posts/{id}/add-to-favorite' , 'SiteController@addToFavorite')->name('posts.favorites');
    Route::get('posts/favorite-posts/show' , 'SiteController@showFavoritePosts')->name('favorite-posts.show');

});


Auth::routes();
