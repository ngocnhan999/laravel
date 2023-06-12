<?php

use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\StudentController;
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


Route::get('/', [
    'as'   => 'public.index',
    'uses' => 'HomeController@index'
]);


Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'namespace' => 'Admin', 'middleware' => 'web'], function () {
    include('admin_route.php');
});

// // Google URL
// Route::prefix('google')->name('google.')->group(function () {
//     Route::get('login', [GoogleController::class, 'loginWithGoogleStudent'])->name('login');//student
//     Route::get('mentor/login', [GoogleController::class, 'loginWithGoogleMentor'])->name('mentor.login');//mentor

//     Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
// });

