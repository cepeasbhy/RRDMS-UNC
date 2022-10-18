<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentCredential;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/stud_cred_mngmnt',[StudentCredential::class, 'index'])->name('StudCredHome');
Route::get('/stud_cred_mngmnt/add_student',[StudentCredential::class, 'addStudent'])->name('addStudent');
Route::get('/stud_cred_mngmnt/view_student/{id}',[StudentCredential::class, 'viewStudent'])->name('viewStudent');
Route::post('/stud_cred_mngmnt/view_student/update/{id}',[StudentCredential::class, 'update'])->name('updateStudent');
Route::post('/stud_cred_mngmnt/view_student/delete/{id}',[StudentCredential::class, 'destroy'])->name('deleteStudent');
Route::post('/stud_cred_mngmnt/add_student', [StudentCredential::class, 'create'])->name('submitStudent');
