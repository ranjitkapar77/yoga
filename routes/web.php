<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChooseUsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CoureseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseLevelController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\MailMessagesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PlanTypeController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StudentStoryController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Models\MailMessages;
use App\Models\Partners;
use App\Models\Services;
use App\Models\Subscribers;
use App\Models\User;
use App\Models\Course;
use App\Models\Destination;
use App\Models\Learn;
use App\Models\StudentStory;
use App\Models\Team;
use App\Models\TestPreprationBooking;
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

// Backend
Route::get('/dashboard', function () {
    $users_count = User::all()->count();
    $course = Course::all()->count();
    $destination = Destination::all()->count();
    $destinations = Destination::get();
    $team = Team::all()->count();
    $classes = Learn::all()->count();
    $partners = Partners::latest()->take(10)->get();
    $partners_count = Partners::count();
    $subscribers = Subscribers::latest()->take(10)->get();
    $services_count = Services::count();
    $messages = MailMessages::latest()->take(10)->get();
    $testBooking = TestPreprationBooking::latest()->take(10)->get();
    return view('backend.dashboard', compact('testBooking', 'messages', 'partners', 'course', 'destination', 'destinations', 'team', 'classes', 'partners_count', 'services_count', 'subscribers', 'users_count'));
})->name('dashboard')->middleware(['auth:sanctum', 'verified']);

Route::group(['prefix' => 'admin'], function () {


    Route::resource('product-category',ProductCategoryController::class)->middleware('auth');
    Route::resource('setting', SettingController::class)->middleware(['auth:sanctum', 'verified']);
    Route::get('socialMedia', [SettingController::class, 'socialMedia'])->name('socialMedia')->middleware(['auth:sanctum', 'verified']);
    Route::get('aboutUs', [SettingController::class, 'aboutUs'])->name('aboutUs')->middleware(['auth:sanctum', 'verified']);
    Route::resource('services', ServicesController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('brand', BrandController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('series', SeriesController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('products', ProductController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('slider', SliderController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('menu', MenuController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('saveMenuCategory', [MenuController::class, 'create_menuCategory'])->name('saveMenuCategory')->middleware(['auth:sanctum', 'verified']);
    Route::resource('partner', PartnersController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('news', NewsController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('courses', CourseController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('coursecategory', CoureseCategoryController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('content', ContentController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('users', UserController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('team', TeamController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('team/search', [TeamController::class, 'teamsearch'])->name('team.search')->middleware(['auth:sanctum', 'verified']);
    Route::resource('testimonial', TestimonialController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('testimonial/search', [TestimonialController::class, 'testimonialsearch'])->name('testimonial.search')->middleware(['auth:sanctum', 'verified']);
    Route::resource('message', MailMessagesController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('message', [MailMessagesController::class, 'store'])->name('message.store');
    Route::resource('album', AlbumController::class)->middleware(['auth:sanctum', 'verified']);
    Route::delete('albumImage/{id}', [AlbumController::class, 'deleteAlbumImage'])->name('deleteAlbumImage');
    Route::get('getSeries/{id}', [BrandController::class, 'getSeries'])->name('getSeries');
    Route::delete('productimage/{id}', [ProductController::class, 'deleteproductimage'])->name('deleteproductimage');
    Route::resource('plantype', PlanTypeController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('plantype/search', [PlanTypeController::class, 'plantypesearch'])->name('plantype.search')->middleware(['auth:sanctum', 'verified']);
    Route::resource('pricing', PricingController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('pricing/search', [PricingController::class, 'pricingsearch'])->name('pricing.search')->middleware(['auth:sanctum', 'verified']);

    Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index')->middleware(['auth:sanctum', 'verified']);
    Route::post('subscribers', [SubscribersController::class, 'store'])->name('subscribers.store');
    Route::resource('extra', ExtraController::class)->middleware(['auth:sanctum', 'verified'])->only('index', 'update', 'edit');
    Route::resource('learns', LearnController::class)->middleware(['auth:sanctum', 'verified']);
    Route::get('testbooking', [LearnController::class, 'getBookedtestPreparation'])->name('testbooking')->middleware(['auth:sanctum', 'verified']);

    //choose us home page
    Route::resource('choose', ChooseUsController::class)->middleware(['auth:sanctum', 'verified']);

    //student story home page
    Route::resource('student', StudentStoryController::class)->middleware(['auth:sanctum', 'verified']);

    //Destination
    Route::get('destination', [DestinationController::class, 'index'])->name('destination.index')->middleware(['auth:sanctum', 'verified']);
    Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create')->middleware(['auth:sanctum', 'verified']);
    Route::post('destination/store', [DestinationController::class, 'store'])->name('destination.store')->middleware(['auth:sanctum', 'verified']);
    Route::get('destination/edit/{id}', [DestinationController::class, 'edit'])->name('destination.edit')->middleware(['auth:sanctum', 'verified']);
    Route::post('destination/update/{id}', [DestinationController::class, 'update'])->name('destination.update')->middleware(['auth:sanctum', 'verified']);
    Route::delete('destination/delete/{id}', [DestinationController::class, 'delete'])->name('destination.delete')->middleware(['auth:sanctum', 'verified']);

    //level
    Route::get('level', [CourseLevelController::class, 'index'])->name('level.index')->middleware(['auth:sanctum', 'verified']);
    Route::get('level/create', [CourseLevelController::class, 'create'])->name('level.create')->middleware(['auth:sanctum', 'verified']);
    Route::post('level/store', [CourseLevelController::class, 'store'])->name('level.store')->middleware(['auth:sanctum', 'verified']);
    Route::get('level/edit/{id}', [CourseLevelController::class, 'edit'])->name('level.edit')->middleware(['auth:sanctum', 'verified']);
    Route::post('level/update/{id}', [CourseLevelController::class, 'update'])->name('level.update')->middleware(['auth:sanctum', 'verified']);
    Route::delete('level/delete/{id}', [CourseLevelController::class, 'delete'])->name('level.delete')->middleware(['auth:sanctum', 'verified']);
});

Route::post('updateMenu', [MenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');
Route::post('updateMember', [TeamController::class, 'updateMemberOrder'])->name('updateMemberOrder');

// Frontend
Route::get('/', [FrontController::class, 'index'])->name('index');
