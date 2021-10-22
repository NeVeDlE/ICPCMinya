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


Auth::routes();
Route::get('/', function () {
    $trainees = \App\Models\Requests::where('status',1)->count();
    $trainings = \App\Models\TrainingPage::count();
    $events = \App\Models\EventsPage::count();
    $mentors = \App\Models\AboutPage::count();
    return view('user_pages.index',compact('trainees','trainings','events','mentors'));});
Route::get('/index', function () {
    $trainees = \App\Models\Requests::where('status',1)->count();
    $trainings = \App\Models\TrainingPage::count();
    $events = \App\Models\EventsPage::count();
    $mentors = \App\Models\AboutPage::count();
    return view('user_pages.index',compact('trainees','trainings','events','mentors'));});

Route::get('about', 'App\Http\Controllers\UserPagesController@about');
Route::get('training', 'App\Http\Controllers\UserPagesController@training');
Route::get('training-details/{id}', 'App\Http\Controllers\UserPagesController@details')->name('training-details');
Route::get('events', 'App\Http\Controllers\UserPagesController@events');
Route::group(['middleware' => ['auth']], function () {
    // your routes


    Route::resource('aboutController', 'App\Http\Controllers\AboutPageController');
    Route::resource('trainingController', 'App\Http\Controllers\TrainingPageController');
    Route::resource('eventsController', 'App\Http\Controllers\EventsPageController');
    Route::resource('topics', 'App\Http\Controllers\TopicsController');
    Route::resource('requests', 'App\Http\Controllers\RequestsController');
    Route::get('/admin/Search', 'App\Http\Controllers\RequestsController@Search')->name('Search');
    Route::get('/admin/export', 'App\Http\Controllers\RequestsController@export')->name('export');
    Route::get('/admin/notify/{id}', 'App\Http\Controllers\RequestsController@Notify')->name('Notify');
    Route::get('/home', 'App\Http\Controllers\RequestsController@index')->name('home');
    Route::get('/dashboard', 'App\Http\Controllers\RequestsController@index')->name('dashboard');
    Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
});





