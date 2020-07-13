<?php

use Illuminate\Support\Facades\Route;

use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
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

Auth::routes();
Route::resource('files','FileController');

Route::get('/home', 'FileController@create')->name('home');
Route::get('/showSuccess', 'FileController@showSuccess')->name('showSuccess');
Route::get('/sm-test', function (Request $request)
{
  try {
    Mail::to('olamideadebayo2001@gmail.com')
     // ->cc(['olamide@ebis.com.ng','flexzone226@gmail.com'])
     ->send(new Notification("Ola",'Filename test'));
     return 'A message has been sent!';
  }
  catch (\Swift_TransportException $e) {
      echo $e->getMessage();
  }

});
Route::post('file-upload', 'UploadFileController@fileUploadPost')->name('file.upload.post');
