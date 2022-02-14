<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\FrontDetailsController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('courses', [FrontDetailsController::class, 'AllCourse'])->name('allcourses');
Route::get('course/{slug}', [FrontDetailsController::class, 'courseDetails'])->name('courseDetails');
Route::post('subscribe', [FrontDetailsController::class, 'subscribe'])->name('subscribefront');
Route::post('messagestore', [FrontDetailsController::class, 'messagestore'])->name('messagestore');
Route::get('destination', [FrontDetailsController::class, 'getDestination'])->name('destination');
Route::get('destination/{slug}', [FrontDetailsController::class, 'courseByDestination'])->name('courseDestination');
Route::get('category/{slug}', [FrontDetailsController::class, 'courseBycategory'])->name('coursecategory');
Route::get('level/{slug}', [FrontDetailsController::class, 'courseByProgram'])->name('courselevel');
Route::get('news', [FrontDetailsController::class, 'getNews'])->name('news');
Route::get('news/{slug}', [FrontDetailsController::class, 'newsDetails'])->name('newsdetail');
Route::get('service/{slug}', [FrontDetailsController::class, 'serviceDetails'])->name('servicedetail');
Route::get('team', [FrontDetailsController::class, 'allteam'])->name('allteam');
Route::get('team/{slug}', [FrontDetailsController::class, 'teamDetails'])->name('teamdetail');
Route::get('content/{slug}', [FrontDetailsController::class, 'contentDetails'])->name('contentdetail');
Route::get('testprepration', [FrontDetailsController::class, 'testPrepration'])->name('testprepration');
Route::get('testprepration/{slug}', [FrontDetailsController::class, 'testPreprationsDetails'])->name('testpreprationsdetails');
Route::post('testpreprationBooking', [FrontDetailsController::class, 'testprePrationBooking'])->name('testpreprationbooking');
Route::get('{category}', [CategoryController::class, 'category'])->name('category');
