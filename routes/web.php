<?php

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

Route::get('/', function () {
    return view('home');
});
Route::match(["GET", "POST"], "/", function () {
    return redirect("/login");
})->name("home");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/user', [App\Http\Controllers\UserController::class, 'user'])->name('user')->middleware(['auth']);

Route::post('/user/add-user', [App\Http\Controllers\UserController::class, 'postUser'])->name('add-user')->middleware(['auth']);


Route::get('/user/detail-user', [App\Http\Controllers\UserController::class, 'detailUser'])->name('detail-user')->middleware(['auth']);
Route::post('/user/delete-user', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');
Route::post('/user/edit-user', [App\Http\Controllers\UserController::class, 'editUser'])->name('edit-user');

Route::get('/template-email', [App\Http\Controllers\TemplateEmailController::class, 'templateEmail'])->name('template-email')->middleware(['auth']);
Route::post('/add-attachment', [App\Http\Controllers\TemplateEmailController::class, 'addAttachment'])->name('add-attachment');
Route::post('/delete-template', [App\Http\Controllers\TemplateEmailController::class, 'deleteTemplate'])->name('delete-template');
Route::get('/detail-template/{id}', [App\Http\Controllers\TemplateEmailController::class, 'detail'])->name('detail-template');
Route::put('/update-template/{id}', [App\Http\Controllers\TemplateEmailController::class, 'updateTemplate'])->name('update-template');

Route::get('/upload-data', [App\Http\Controllers\UploadDataController::class, 'uploadData'])->name('upload-data')->middleware(['auth']);
Route::get('/email', [App\Http\Controllers\EmailController::class, 'email'])->name('email')->middleware(['auth']);
Route::post('sent-all', [App\Http\Controllers\EmailController::class, 'sentAll'])->name('sent-all')->middleware(['auth']);
Route::post('sent-email', [App\Http\Controllers\EmailController::class, 'sentEmail'])->name('sent-email')->middleware(['auth']);



Route::post('add-transaction', [App\Http\Controllers\UploadDataController::class, 'addTransaction'])->name('add-transaction')->middleware(['auth']);
Route::post('/delete-transaction', [App\Http\Controllers\UploadDataController::class, 'delete'])->name('delete-transaction');
Route::post('/add-data', [App\Http\Controllers\UploadDataController::class, 'postData'])->name('add-data')->middleware(['auth']);
Route::get('/edit-data/{id}', [App\Http\Controllers\UploadDataController::class, 'editData'])->name('edit-data');
Route::put('/update-data/{id}', [App\Http\Controllers\UploadDataController::class, 'updateData'])->name('update-data');




