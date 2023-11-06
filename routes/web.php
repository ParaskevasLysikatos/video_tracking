<?php

use App\Http\Controllers\SaveController;
use App\Http\Controllers\SignUserController;
use App\Http\Controllers\UploadfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


/*  post routes*/
Route::post('/ManageVideos', [UploadfileController::class, 'upload']);

Route::post('/video_save', [SaveController::class, 'store']);

Route::post('/video_save2', [SaveController::class, 'store2']);

Route::post('/video_save3',[SaveController::class, 'store3']);

Route::post('/video_session', [SaveController::class, 'UserSession']);


Route::post('/SignIn', [SignUserController::class, 'SignInUser'])->name('SignInUser');

Route::delete('/VideoHeatmap', [SignUserController::class, 'SecondsInspect2'])->name('InspectVideo2');

Route::get('/VideoHeatmap', [SignUserController::class, 'SecondsInspect3'])->name('InspectVideo3');


Route::post('/VideoHeatmap', [SignUserController::class, 'SecondsInspect'])->name('InspectVideo1');

Route::post('/SortedUsers', [SignUserController::class, 'SeeInspectVideo'])->name('InspectVideoS');

Route::post('/Register', [SignUserController::class, 'RegisterUser'])->name('RegisterUser');

Route::post('/EditName', [SignUserController::class, 'EditName'])->name('EditName');

Route::post('/UsersSelect', [SaveController::class, 'UserSelection'])->name('UserSelect');

Route::post('/OneUserSelect', [SaveController::class, 'OneUserSelection'])->name('OneUser');

Route::post('/ChooseVideoforUser', [SaveController::class, 'chartUser'])->name('VideoforUser');

Route::post('/VideosHeatmap', [SaveController::class, 'VideosHeatmap'])->name('VideosHeatmap');

Route::post('/SaveVideo', [UploadfileController::class, 'SaveVideo']);

Route::post('/DownVideo', [UploadfileController::class, 'DownVideo']);


/* delete routes */
Route::delete('/DeleteUser', [SignUserController::class, 'DeleteUser'])->name('DeleteUser');

Route::delete('/ManageVideos', [UploadfileController::class, 'DelVideo'])->name('DeleteVideo');

/*  view routes */
Route::view('/Register', 'Register');

Route::view('/welcome', 'welcome');




/* get routes */
Route::get('/', function () {
    return view('welcome');
});


Route::get('/ChooseVideoforUser', [SignUserController::class, 'ChooseVideoforUser'])->middleware('student');

Route::get('/ManageVideos', [UploadfileController::class, 'displayManageVideos'])->middleware('lecturer');

Route::get('/VideoDisplay', [SignUserController::class, 'Display']);

Route::get('/EditName', [SignUserController::class, 'DisplayEditName']);

Route::get('/SortedUsers', [SaveController::class, 'SortedUsers'])->middleware('lecturer');

Route::get('/SortedVideos', [SaveController::class, 'SortedVideos'])->middleware('lecturer');

Route::get('/VideosHeatSelect', [SignUserController::class, 'VideosHeatmap'])->middleware('lecturer');

Route::get('/SignOut', [SignUserController::class, 'SignOutUser']);

Route::get('/SignIn', [SignUserController::class, 'DisplaySignUser']);

Route::get('/UsersSelect', [SignUserController::class, 'DisplaySelectUser'])->middleware('lecturer');

Route::get('/OneUserSelect', [SignUserController::class, 'DisplayOneUser'])->middleware('lecturer');

Route::get('/DeleteUser', [SignUserController::class, 'DisplayDeleteUser']);



