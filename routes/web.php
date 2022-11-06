<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudCredController;
use App\Http\Controllers\ArchivedRecordsController;
use App\Http\Controllers\requestRecordsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Role;

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

//Admin Routes
Route::group(['middleware' => 'role:admin'], function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('adminHome');
    Route::get('/register', [AdminController::class, 'register'])->name('register');
});

//Student Credential Management Routes
Route::group(['middleware' => 'role:cic'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/stud_cred_mngmnt', [StudCredController::class, 'index'])->name('StudCredHome');
    Route::get('/stud_cred_mngmnt/add_student', [StudCredController::class, 'addStudent'])->name('addStudent');
    Route::get('/stud_cred_mngmnt/view_student/{id}', [StudCredController::class, 'viewStudent'])->name('viewStudent');
    Route::get('/stud_cred_mngmnt/request_archive', [StudCredController::class, 'requestArchive'])->name('requestArchive');
    Route::post('/stud_cred_mngmnt/request_archive/make_request/{id}', [StudCredController::class, 'makeRequestArchive'])->name('makeRequestArchive');
    Route::post('/stud_cred_mngmnt/request_archive/view_requested_archive/{id}', [StudCredController::class, 'viewRequestedArchive'])->name('viewRequestedArchive');
    Route::post('/stud_cred_mngmnt/request_archive//view_requested_archive/return_archive/{id}', [StudCredController::class, 'returnToArchive'])->name('returnToArchive');
    Route::post('/stud_cred_mngmnt/view_student/update/{id}', [StudCredController::class, 'update'])->name('updateStudent');
    Route::post('/stud_cred_mngmnt/view_student/delete/{id}', [StudCredController::class, 'destroy'])->name('deleteStudent');
    Route::post('/stud_cred_mngmnt/add_student', [StudCredController::class, 'create'])->name('submitStudent');
    Route::post('/stud_cred_mngmnt/delete_cred/{studID}/{docID}', [StudCredController::class, 'deleteCred'])->name('deleteCred');
    Route::post('/stud_cred_mngmnt/update_cred/{studID}/{docID}', [StudCredController::class, 'updateCred'])->name('updateCred');
    Route::post('/stud_cred_mngmnt/view_student/add_single_rec', [StudCredController::class, 'addSingleRec'])->name('addSingleRec');
});

//Archived Records Routes
Route::group(['middleware' => 'role:rec_assoc'], function(){
    Route::get('/archived_records', [ArchivedRecordsController::class, 'index'])->name('index');
    Route::get('/archived_records/add_credential', [ArchivedRecordsController::class, 'addCredential'])->name('add_credential');
    Route::get('/archived_records/show_unarchived_credential', [ArchivedRecordsController::class, 'getCredentials'])->name('toBeArchived');
    Route::get('/archived_records/view_record/{id}', [ArchivedRecordsController::class, 'viewRecord'])->name('checkRecord');
    Route::post('/archived_records/view_record/add_single_rec', [ArchivedRecordsController::class, 'addSingleRec'])->name('addSingleRecArchive');
    Route::post('/archived_records/view_record/solo_archive/{id}', [ArchivedRecordsController::class, 'archiveSingleRecord'])->name('singleArchive');
    Route::post('/archived_records/view_record/delete_record/{id}', [ArchivedRecordsController::class, 'deleteRecord'])->name('deleteRecord');
    Route::post('/archived_records/view_record/update_record/{id}', [ArchivedRecordsController::class, 'updateRecord'])->name('updateRecord');
    Route::post('/archived_records/view_record/update_credential/{studID}/{docID}', [ArchivedRecordsController::class, 'updateCredential'])->name('updateCredential');
    Route::post('/archived_records/view_record/delete_credential/{studID}/{docID}', [ArchivedRecordsController::class, 'deleteCredential'])->name('deleteCredential');
});


//Request Records Routes
Route::group(['middleware' => 'role:student'], function(){
    Route::get('/request', [requestRecordsController::class, 'index'])->name('StudRequest');
    Route::get('/request/make_request', [requestRecordsController::class, 'makeRequest'])->name('makeRequest');
    Route::post('/request/submit_request', [requestRecordsController::class, 'submitRequest'])->name('submitRequest');
});


//User Account Routes
Route::middleware('auth')->group(function(){
    Route::get('/account', [AccountController::class, 'index'])->name('accountHome');
    Route::post('/account/update/{id}', [AccountController::class, 'update'])->name('accountUpdate');
});
