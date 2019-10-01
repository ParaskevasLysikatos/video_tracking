<?php

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

/*  post routes*/
Route::post('/ManageVideos', 'UploadfileController@upload');

Route::post('/video_save','SaveController@store');

Route::post('/video_save2','SaveController@store2');

Route::post('/video_save3','SaveController@store3');

Route::post('/video_session','SaveController@UserSession');


Route::post('/SignIn','SignUserController@SignInUser')->name('SignInUser');

Route::delete('/VideoHeatmap','SignUserController@SecondsInspect2')->name('InspectVideo2');

Route::get('/VideoHeatmap','SignUserController@SecondsInspect3')->name('InspectVideo3');


Route::post('/VideoHeatmap','SignUserController@SecondsInspect')->name('InspectVideo1');

Route::post('/SortedUsers','SignUserController@SeeInspectVideo')->name('InspectVideoS');

Route::post('/Register','SignUserController@RegisterUser')->name('RegisterUser');

Route::post('/EditName', 'SignUserController@EditName')->name('EditName');

Route::post('/UsersSelect', 'SaveController@UserSelection')->name('UserSelect');

Route::post('/ChooseVideoforUser', 'SaveController@chartUser')->name('VideoforUser');

Route::post('/VideosHeatmap', 'SaveController@VideosHeatmap')->name('VideosHeatmap');

Route::post('/SaveVideo', 'UploadfileController@SaveVideo');

Route::post('/DownVideo', 'UploadfileController@DownVideo');


/* delete routes */
Route::delete('/DeleteUser','SignUserController@DeleteUser')->name('DeleteUser');

Route::delete('/ManageVideos','UploadfileController@DelVideo')->name('DeleteVideo');

/*  view routes */
Route::view('/Register', 'Register');

Route::view('/welcome', 'welcome');




/* get routes */
Route::get('/', function () {
    return view('welcome');
});


Route::get('/ChooseVideoforUser', 'SignUserController@ChooseVideoforUser')->middleware('student');

Route::get('/ManageVideos', 'UploadfileController@displayManageVideos')->middleware('lecturer');

Route::get('/VideoDisplay', 'SignUserController@Display');

Route::get('/EditName', 'SignUserController@DisplayEditName');

Route::get('/SortedUsers', 'SaveController@SortedUsers')->middleware('lecturer');

Route::get('/SortedVideos', 'SaveController@SortedVideos')->middleware('lecturer');

Route::get('/VideosHeatSelect', 'SignUserController@VideosHeatmap')->middleware('lecturer');

Route::get('/SignOut', 'SignUserController@SignOutUser');

Route::get('/SignIn', 'SignUserController@DisplaySignUser');

Route::get('/UsersSelect', 'SignUserController@DisplaySelectUser')->middleware('lecturer');

Route::get('/DeleteUser', 'SignUserController@DisplayDeleteUser');
