<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\Amenities;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageAgentController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\PropertyTypeController;

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



//user front-end all routs
Route::get('/', [UserController::class, 'index']);

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
    Route::get('/property/{id}/multiimg/delete/{multiId}', [PropertyController::class, 'deleteMultiImage'])->name('property.multiimg.delete');
    Route::post('/store/new/multiimage', [PropertyController::class, 'StoreNewMultiimage'])->name('store.new.multiimage');
    Route::post('/update/property/facilities', [PropertyController::class, 'UpdatePropertyFacilities'])->name('update.property.facilities');
    Route::post('/inactive/property', [PropertyController::class, 'InactiveProperty'])->name('property.inactive');
    Route::post('/active/property', [PropertyController::class, 'ActiveProperty'])->name('property.active');

    //Manage Agent from Admin
    Route::resource('manage_agent', ManageAgentController::class);
    Route::get('/changeStatus', [ManageAgentController::class,'changeStatus']);


});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);




//Agent Admin Middelware
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

    Route::get('/buy/package', [AgentPropertyController::class,'BuyPackage'])->name('buy.package');

});
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');






require __DIR__ . '/auth.php';
