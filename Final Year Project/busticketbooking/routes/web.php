<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Schedule\ScheduleController;
use App\Http\Controllers\Admin\StartDestination\StartController;
use App\Http\Controllers\Admin\Destination\DestinationController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\ShowBooking\ShowBookingController;



use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SchedulesController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\User\UserController;




use App\Http\Controllers\Auth\LoginController;





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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['logout'=>false]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/',[FrontendController::class, 'index'])->name('frontend.index');
Route::get('/about',[AboutController::class, 'index'])->name('frontend.about');
Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::post('/get-contact', [ContactController::class, 'getContractUser'])->name('frontend.getcontact');
Route::get('/schedules', [SchedulesController::class, 'index'])->name('frontend.schedules');
Route::get('/schedules/show-map/{id}', [SchedulesController::class, 'showMap'])->name('frontend.showmap');
Route::post('/booking', [BookingController::class, 'booking'])->name('frontend.booking');
// Check coupon
Route::post('/check-coupon-code', [BookingController::class, 'checkCoupon'])->name('frontend.checkcoupon');
// Remove coupon
Route::get('/remove-coupon', [BookingController::class, 'removeCoupon'])->name('frontend.removecoupon');
// Checkout with razorpay
Route::post('/proceed-to-pay', [BookingController::class, 'razorpayCheck'])->name('frontend.razorpay');
Route::get('/show-rating/{id}', [SchedulesController::class, 'showRating'])->name('frontend.showrating');
// Rating
Route::post('/add-rating', [RatingController::class, 'addRatings'])->name('frontend.rating.bus');
// Feedback
Route::post('/add-feedback', [FeedbackController::class, 'addFeedback'])->name('frontend.feedback.bus');
// Search bus house
Route::get('/schedules/searchBusHouseByAjax', [SchedulesController::class, 'searchBusHouseByAjax'])->name('frontend.searchBusHouse.ajax');
// Route::get('/schedules/searchBusHouse', [SchedulesController::class, 'searchBusHouse'])->name('frontend.searchBusHouse');
// Route::get('/home', [HomeController::class, 'index'])->name('home');


// Route::prefix('admin')->group(function(){
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::get('/account',[AccountController::class,'index'])->name('admin.account.index');

// });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/change-password', [UserController::class, 'changePassword']);
    Route::post('/update-password', [UserController::class, 'updatePassword']);
    Route::get('/edit-profile', [UserController::class, 'profile']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/upload-avatar', [UserController::class, 'uploadAvatar']);
    Route::get('/my-booking',[UserController::class, 'myBooking']);
    // Route::delete('/my-booking/{id}',[UserController::class, 'CancelBooking']);
    // Note: 'role:admin,driver' not have any space between
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin,driver'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Index for account
        Route::get('/account',[AccountController::class,'index'])->name('admin.account.index');
        Route::post('/account/create',[AccountController::class, 'create'])->name('admin.account.create');
        // Display all account
        Route::get('/get-all-account', [AccountController::class, 'getAllRowData']);
        // Edit
        Route::get('/account/edit/{id}', [AccountController::class, 'edit'])->name('admin.account.edit');
        Route::post('/account/update/{id}', [AccountController::class, 'update'])->name('admin.account.update');
        Route::delete('/account/delete/{id}', [AccountController::class, 'delete'])->name('admin.account.delete');
        // Ban Account
        Route::get('/account/ban/{id}/{status_code}', [AccountController::class,'banAccount'])->name('admin.account.ban');

        Route::get('/bus', [BusController::class, 'index'])->name('admin.bus.index');
        Route::post('/bus/create', [BusController::class, 'create'])->name('admin.bus.create');
        // Display all bus
        Route::get('/get-all-bus', [BusController::class, 'getAllRowData']);

        Route::get('/image-bus/{id}', [BusController::class, 'showImage'])->name('admin.account.viewImage');

        // Edit
        Route::get('/bus/edit/{id}', [BusController::class, 'edit'])->name('admin.bus.edit');
        Route::post('/bus/update/{id}', [BusController::class, 'update'])->name('admin.bus.update');

        // Delete bus
        Route::delete('/bus/delete/{id}', [BusController::class, 'delete'])->name('admin.bus.delete');
        // Delete từng ảnh của bus
        Route::get('/bus/delete-image-bus/{bus_image_id}', [BusController::class,'deleteImage'])->name('admin.bus.deleteImage');

        // Index Schedule
        Route::get('/schedule',[ScheduleController::class, 'index'])->name('admin.schedule.index');
        // Display all schedule
        Route::get('/get-all-schedule', [ScheduleController::class, 'getAllRowData']);


        // Index page of start Destination
        Route::get('/start-dest', [StartController::class, 'index'])->name('admin.startdestination.index');
        // Create Start Destination
        Route::get('/start-dest/create', [StartController::class, 'create'])->name('admin.startdestination.create');
        Route::post('/start-dest/store', [StartController::class, 'store'])->name('admin.startdestination.store');
        // Display all start destination
        Route::get('/get-all-start-dest', [StartController::class, 'getAllRowData']);
        Route::get('/start-dest/show-detail/{id}', [StartController::class, 'detail'])->name('admin.startdestination.detail');
        
        // Edit start destination
        Route::get('/start-des/edit/{id}', [StartController::class, 'edit'])->name('admin.startdestination.edit');
        Route::post('/start-des/update/{id}', [StartController::class, 'update'])->name('admin.startdestination.update');

        // Delete start destination
        Route::delete('/start-des/delete/{id}', [StartController::class, 'delete'])->name('admin.startdestination.delete');

        // Index page of destination
        Route::get('/destination', [DestinationController::class, 'index'])->name('admin.destination.index');
        // Create destination get form
        Route::get('/destination/create', [DestinationController::class, 'create'])->name('admin.destination.create');
        Route::post('/destination/store', [DestinationController::class, 'store'])->name('admin.destination.store');

        // Display all data destination
        Route::get('/get-all-dest', [DestinationController::class, 'getAllRowData']);
        // show detail
        Route::get('/destination/show-detail/{id}', [DestinationController::class, 'detail'])->name('admin.destination.detail');

        // Edit destination
        Route::get('/destination/edit/{id}', [DestinationController::class, 'edit'])->name('admin.destination.edit');
        Route::post('/destination/update/{id}', [DestinationController::class, 'update'])->name('admin.destination.update');

        Route::delete('/destination/delete/{id}', [DestinationController::class, 'delete'])->name('admin.destination.delete');


        Route::get('/schedule', [ScheduleController::class, 'index'])->name('admin.schedule.index');
        // Get form create
        Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('admin.schedule.create');
        Route::post('/schedule/store', [ScheduleController::class, 'store'])->name('admin.schedule.store');
        // Search with autocomplete start destination
        Route::get('/schedule/start-destination', [ScheduleController::class, 'searchStartDestinationByAjax'])->name('admin.startdestination.search');
        // Search with autocomplete destination
        Route::get('/schedule/destination', [ScheduleController::class, 'searchDestinationByAjax'])->name('admin.destination.search');
        // Show detail schedule
        Route::get('/schedule/detail/{id}', [ScheduleController::class, 'details'])->name('admin.shedule.detail');

        // Edit schedule
        Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('admin.schedule.edit');
        Route::post('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('admin.schedule.update');

        // Index page of coupon
        Route::get('/coupon', [CouponController::class , 'index'])->name('admin.coupon.index');
        // Show all data coupon
        Route::get('/get-all-coupon', [CouponController::class, 'getAllRowData']);
        // Create coupon
        Route::post('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
        // Edit coupon
        Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
        Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
        Route::delete('/coupon/delete/{id}', [CouponController::class, 'delete'])->name('admin.coupon.delete');
        
        // index booking
        Route::get('/show-booking',[ShowBookingController::class, 'index'])->name('admin.booking.index');
        Route::get('/get-all-booking',[ShowBookingController::class, 'getAllRowData']);
        Route::get('/update-booking-status-not-pay/{id}',[ShowBookingController::class, 'updateNotPay'])->name('admin.booking.notpay');
        Route::get('/update-booking-status-paid/{id}',[ShowBookingController::class, 'updatePaid'])->name('admin.booking.paid');
    }); 

});