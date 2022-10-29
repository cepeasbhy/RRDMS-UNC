<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudCredController;
use App\Http\Controllers\ArchivedRecordsController;
use App\Http\Controllers\AccountController;

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
Route::get('/stud_cred_mngmnt',[StudCredController::class, 'index'])->name('StudCredHome');
Route::get('/stud_cred_mngmnt/add_student',[StudCredController::class, 'addStudent'])->name('addStudent');
Route::get('/stud_cred_mngmnt/view_student/{id}',[StudCredController::class, 'viewStudent'])->name('viewStudent');
Route::post('/stud_cred_mngmnt/view_student/update/{id}',[StudCredController::class, 'update'])->name('updateStudent');
Route::post('/stud_cred_mngmnt/view_student/delete/{id}',[StudCredController::class, 'destroy'])->name('deleteStudent');
Route::post('/stud_cred_mngmnt/add_student', [StudCredController::class, 'create'])->name('submitStudent');
Route::post('/stud_cred_mngmnt/delete_cred/{studID}/{docID}', [StudCredController::class, 'deleteCred'])->name('deleteCred');
Route::post('/stud_cred_mngmnt/update_cred/{studID}/{docID}', [StudCredController::class, 'updateCred'])->name('updateCred');
Route::post('/stud_cred_mngmnt/view_student/add_single_rec', [StudCredController::class, 'addSingleRec'])->name('addSingleRec');


//Archived Records Routes
Route::get('/archived_records', [ArchivedRecordsController::class, 'index'])->name('index');
Route::get('/archived_records/show_unarchived_credential',[ArchivedRecordsController::class, 'getCredentials'])->name('toBeArchived');
Route::get('/archived_records/view_record/{id}',[ArchivedRecordsController::class, 'viewRecord'])->name('checkRecord');
Route::post('/archived_records/view_record/solo_archive/{id}',[ArchivedRecordsController::class, 'archiveSingleRecord'])->name('singleArchive');
Route::post('/archived_records/view_record/delete_record/{id}',[ArchivedRecordsController::class, 'deleteRecord'])->name('deleteCredential');
Route::post('/archived_records/view_record/update_record/{id}',[ArchivedRecordsController::class, 'updateRecord'])->name('updateRecord');
Route::post('/archived_records/view_record/update_credential/{studID}/{docID}', [ArchivedRecordsController::class, 'updateCredential'])->name('updateCredential');

//User Account Routes
Route::get('/account', [AccountController::class, 'index'])->name('accountHome');
Route::post('/account/update/{id}', [AccountController::class, 'update'])->name('accountUpdate');

