<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FarmersController;
use App\Http\Controllers\ResourceAllocationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Farmer\AnnounceController;
Route::get('/', [LandingController::class, 'index']);

// Registration and login routes
// Role = user and Admin
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// admin
use App\Http\Controllers\AdminNotificationController;
Route::get('/admin/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
Route::post('/admin/notifications/send', [AdminNotificationController::class, 'send'])->name('admin.notifications.send');
Route::post('/send-notification', [AdminNotificationController::class, 'sendNotification']);
Route::get('/admin/send-notification', [AdminNotificationController::class, 'showForm'])->name('admin.showForm');

// Route to handle the notification sending
Route::post('/admin/send-notification', [AdminNotificationController::class, 'sendNotification'])->name('admin.sendNotification');
// Route to show the notification form
Route::get('/admin/send-notification', [AdminNotificationController::class, 'showForm'])->name('admin.showForm');
Route::get('/admin/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
//second
Route::get('/admin/send-notification', [AdminNotificationController::class, 'create'])->name('admin.createNotification');
Route::post('/admin/send-notification', [AdminNotificationController::class, 'sendNotification'])->name('admin.sendNotification');

// Admin part cannot go from user routes to admin routes
Route::prefix('panel')->group(function () {
    Route::get('/farmers', [FarmersController::class, 'index'])->name('farmers.index');
    Route::get('/farmers/create', [FarmersController::class, 'create'])->name('farmers.create');
    Route::post('/farmers', [FarmersController::class, 'store'])->name('farmers.store');
    Route::get('/farmers/{id}/edit', [FarmersController::class, 'edit'])->name('farmers.edit'); // Route to show edit form
Route::put('/farmers/{id}', [FarmersController::class, 'update'])->name('farmers.update'); 
    Route::delete('/farmers/{id}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
    Route::get('/farmers/search', [FarmersController::class, 'search'])->name('farmers.search');
    Route::get('farmers/search', [FarmersController::class, 'search'])->name('farmers.search');
    Route::put('/farmers/{id}', [FarmersController::class, 'update'])->name('farmers.update');

});
Route::delete('farmers/{farmer}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
Route::resource('farmers', FarmersController::class);


//registration user only 
use App\Http\Controllers\UserRegistrationController;
Route::get('/user/register', [UserRegistrationController::class, 'create'])->name('user.register');
Route::post('/user/store', [UserRegistrationController::class, 'store'])->name('user.store');
Route::get('/panel/user_registered', [UserRegistrationController::class, 'ftr'])->name('panel.user_registered');
Route::get('/panel/user_registered', [UserRegistrationController::class, 'index'])->name('panel.user_registered');
Route::get('/panel/user_registered', [UserRegistrationController::class, 'tregistered'])->name('panel.user_registered');
Route::get('/panel/user_registered/{id}/edit', [UserRegistrationController::class, 'edit'])->name('panel.user_registered.edit');
Route::put('/panel/user_registered/{id}', [UserRegistrationController::class, 'update'])->name('panel.user_registered.update');
Route::delete('/panel/user_registered/{id}', [UserRegistrationController::class, 'destroy'])->name('panel.user_registered.destroy');
Route::get('/panel/farmers/add/{id}', [FarmersController::class, 'addFarmer'])->name('panel.farmers.add');





// Resources Route that admin can browse the routes
Route::get('/panel/resources', [ResourceAllocationController::class, 'resources'])->name('resources');
Route::prefix('panel')->group(function () {
    // Route to display the resources page
    Route::get('/resources', [ResourceAllocationController::class, 'index'])->name('panel.resources');
    Route::post('/resources', [ResourceAllocationController::class, 'store'])->name('panel.resources.store');
    Route::delete('/resources/{id}', [ResourceAllocationController::class, 'destroy'])->name('panel.resources.destroy');
    Route::get('/resources/graph-data', [ResourceAllocationController::class, 'getGraphData'])->name('panel.resources.graph-data');
    Route::get('/resources/{id}/edit', [ResourceAllocationController::class, 'edit'])->name('panel.resources.edit');
Route::put('/resources/{id}', [ResourceAllocationController::class, 'update'])->name('panel.resources.update');
Route::get('/resources/inventory/{resource}', [ResourceAllocationController::class, 'getInventoryQuantity'])->name('panel.resources.inventory');
Route::post('/resources/store', [ResourceAllocationController::class, 'store'])->name('panel.resources.store');
Route::post('/inventory/quantity', [ResourceAllocationController::class, 'getAvailableQuantity'])->name('inventory.quantity');
});



// Admin can browse the route
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements.index');

});

// user/farmer Route can browse the routes
Route::prefix('farmer')->name('farmer.')->group(function () {
    Route::get('announcements/index', [AnnounceController::class, 'index'])->name('announcements.index');
    Route::get('announcements/{announcement}', [AnnounceController::class, 'show'])->name('announcements.show');
    Route::get('/announcements/index', [AnnounceController::class, 'index'])->name('farmer.announcements.index');
});

//email announcement
use App\Http\Controllers\AnnouncementControllers;
Route::get('/send-announcement', [AnnouncementControllers::class, 'announce'])->name('send-announcement');
Route::post('/send-announcement', [AnnouncementControllers::class, 'sendAnnouncement'])->name('send.announcement');

use App\Http\Controllers\InventoryResourceController;

Route::prefix('panel')->group(function () {
    Route::get('/inventory', [InventoryResourceController::class, 'inventory'])->name('inventory');
    Route::get('/inventory', [InventoryResourceController::class, 'index'])->name('panel.inventory');
    Route::post('/inventory/store', [InventoryResourceController::class, 'store'])->name('panel.inventory.store');
    Route::put('/inventory/update/{id}', [InventoryResourceController::class, 'update'])->name('panel.inventory.update');
    Route::delete('/inventory/destroy/{id}', [InventoryResourceController::class, 'destroy'])->name('panel.inventory.destroy');
});

// Logout route
use Illuminate\Support\Facades\Auth;
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

