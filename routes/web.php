<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\Amenities;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\ManageAgentController;
use App\Http\Controllers\HomePropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Agent\PackageController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Agent\AgentMessageController;
use App\Http\Controllers\Frontend\WhishlistController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Frontend\AgentDEtailsController;
use App\Http\Controllers\Frontend\StateDetailsController;
use App\Http\Controllers\Frontend\SearchPropertyController;
use App\Http\Controllers\Frontend\AgentPropertyTypeController;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.password.update');
});






//Group Admin Middelware
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    Route::resource('propertyType', PropertyTypeController::class);
    Route::resource('amenities', AmenitiesController::class);

    Route::resource('property', PropertyController::class);
    Route::get('/admin/property/{id}/multiimg/delete/{multiId}', [PropertyController::class, 'deleteMultiImage'])->name('admin.multiImg.delete');

    Route::post('/store/new/multiimage', [PropertyController::class, 'StoreNewMultiimage'])->name('store.new.multiimage');
    Route::post('/update/property/facilities', [PropertyController::class, 'UpdatePropertyFacilities'])->name('update.property.facilities');
    Route::post('/inactive/property', [PropertyController::class, 'InactiveProperty'])->name('property.inactive');
    Route::post('/active/property', [PropertyController::class, 'ActiveProperty'])->name('property.active');

    //Manage Agent from Admin
    Route::resource('manage_agent', ManageAgentController::class);
    Route::get('/changeStatus', [ManageAgentController::class, 'changeStatus']);

    Route::get('/admin/package/history', [AdminPackageController::class, 'AdminPackageHistory'])->name('admin.package.history');
    Route::get('admin/package/invoice/{id}', [AdminPackageController::class, 'AdminPackageInvoice'])->name('admin.package.invoice');

    Route::get('/admin/property/message/', [MessageController::class, 'AdminPropertyMessage'])->name('admin.property.message');

    Route::resource('state', StateController::class);
    Route::resource('testimonial', TestimonialController::class);
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);




//Agent  Middelware
Route::middleware('auth', 'role:agent')->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
    Route::resource('agent_property', AgentPropertyController::class);

    Route::get('/property/{id}/multiimg/delete/{multiId}', [AgentPropertyController::class, 'AgentPropertyDeleteMultiImage'])->name('agent.property.multiimg.delete');
    Route::post('/agent/store/new/multiimage', [AgentPropertyController::class, 'AgentPropertyStoreNewMultiimage'])->name('agent.store.new.multiimage');
    Route::post('/agent/update/property/facilities', [AgentPropertyController::class, 'AgentUpdatePropertyFacilities'])->name('agent.update.property.facilities');

    Route::get('/buy/package', [PackageController::class, 'BuyPackage'])->name('buy.package');
    Route::get('/buy/business/plan', [PackageController::class, 'BuyBusinessPlan'])->name('buy.business.plan');
    Route::post('/store/business/plan', [PackageController::class, 'StoreBusinessPlan'])->name('store.business.plan');
    Route::get('/buy/professional/plan', [PackageController::class, 'BuyProfessionalPlan'])->name('buy.professional.plan');
    Route::post('/store/professional/plan', [PackageController::class, 'StoreProfessionalPlan'])->name('store.professional.plan');
    Route::get('/package/history', [PackageController::class, 'PackageHistory'])->name('package.history');
    Route::get('/agent/package/invoice/{id}', [PackageController::class, 'AgentPackageInvoice'])->name('agent.package.invoice');


    Route::get('/agent/property/message/', [AgentMessageController::class, 'AgentPropertyMessage'])->name('agent.property.message');
    Route::get('/agent/message/details/page/{id}', [AgentMessageController::class, 'AgentMessageDetails'])->name('agent.message.details');
});
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');



//user front-end all routs
Route::get('/', [UserController::class, 'index']);

Route::get('/property/details/{id}/{slug}', [HomePropertyController::class, 'PropertyDetails']);
Route::post('/property/message', [HomePropertyController::class, 'PropertyMessage'])->name('property.message');


Route::post('/add-to-wishList/{property_id}', [WhishlistController::class, 'AddToWishList']);
Route::get('/user/wishlist', [WhishlistController::class, 'UserWishlist'])->name('user.wishlist');
Route::get('/get-wishlist-property', [WhishlistController::class, 'GetWishlistProperty']);
Route::get('/wishlist-remove/{id}', [WhishlistController::class, 'WishlistRemove']);


Route::post('/add-to-compare/{property_id}', [CompareController::class, 'AddToCompare']);
Route::get('/user/compare', [CompareController::class, 'UserCompare'])->name('user.compare');
Route::get('/get-compare-property', [CompareController::class, 'GetCompareProperty']);
Route::get('/compare-remove/{id}', [CompareController::class, 'CompareRemove']);

Route::get('/agent/details/{id}', [AgentDEtailsController::class, 'AgentDetails'])->name('agent.details');
Route::post('/agent/details/message', [AgentDEtailsController::class, 'AgentDetailsMessage'])->name('agent.details.message');
//get all rent property
Route::get('/rent/property', [AgentDEtailsController::class, 'RentProperty'])->name('rent.property');
Route::get('/buy/property', [AgentDEtailsController::class, 'BuyProperty'])->name('buy.property');
Route::get('/property/type/{id}', [AgentPropertyTypeController::class, 'PropertyType'])->name('property.type');

Route::get('/state/details/{id}', [StateDetailsController::class, 'StateDetails'])->name('state.details');

Route::post('/buy/property/search', [SearchPropertyController::class, 'BuyPropertySeach'])->name('buy.property.search');
Route::post('/rent/property/search', [SearchPropertyController::class, 'RentPropertySeach'])->name('rent.property.search');

//filter rent page
Route::post('/all/property/search', [SearchPropertyController::class, 'AllPropertySeach'])->name('all.property.search');



require __DIR__ . '/auth.php';
