<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('sign-in');
});

// General Midleware for Auth
Route::middleware('auth')->group(function () {
    Route::get('land', [DefaultController::class, 'land'])->name('default');


    // SMS Routes
    Route::get('/sms/list', [SmsController::class, "index"])->name('list-sms');
    Route::post('/send-test-sms', [SmsController::class, "send_test"])->name('send-test-sms');
    Route::post('/soap-request', [SmsController::class, "makeSoapRequest"])->name('soap-request');

    // TEST
    Route::get('/test', [SmsController::class, "test"]);

    // Test Telegram 
    Route::get('/telegram/list', [TelegramController::class, "index"])->name('list-telegram');
    Route::post('/send-test-telegram', [TelegramController::class, "send_test"])->name('send-test-telegram');
    //Route::get('/getall-telegram', [TelegramController::class, "getSubscribers"])->name('telegram-subscribers');

    // Roles and Permissions
    Route::get('/roles-perm', [RolesPermissionController::class, 'list_roles_perms'])->name('list-role-perm');

    // Add Role
    Route::post('/role/add', [RolesPermissionController::class, 'add_role'])->name('add-role');

    // USERS
    // Index View
    Route::get('/users/list', [UserController::class, 'index'])->name('list-users');
    // List Users
    Route::get('/users/getAll', [UserController::class, 'getUsers']);
    // Add
    Route::post('/user/add', [UserController::class, 'add_user'])->name('add-user');
    // Edit 
    Route::get('/user/{uid}/edit', [UserController::class, 'edit_user'])->name('edit-user');

    // EMAIL 

    Route::get('/email/list', [EmailController::class, "listEmails"])->name('list-email');
    Route::post('/send-test-email', [EmailController::class, "send_test_Email"])->name('send-test-email');
    // Update Email
    Route::post('/user/update-email', [UserController::class, 'updateEmail'])->name('update-email');
    // Update Password
    Route::post('/user/update-passwd', [UserController::class, 'updatePasswd'])->name('update-user-password');
    // Update Details
    Route::post('/user/update-details', [UserController::class, 'updateDetails'])->name('update-user-details');

    Route::get('/email/{emailid}/compose-email', [EmailController::class, 'index'])->name('email-compose');

    // Schedule Email 
    Route::post('/email/schedule', [EmailController::class, 'scheduleEmail'])->name('Schedule-Email');

    // Set Settings Email
    Route::post('/email/set-settings', [EmailController::class, "setSettings"])->name('email-set-settings');

    // CAMPAIGN 

    Route::post('/create-campaign', [DefaultController::class, "create_Campaign"])->name('create-campaign');
    Route::post('/campaign/cancel', [DefaultController::class, "cancelCampaign"])->name('cancel-campaign');

    // CONTACTS
    // List
    Route::get('/contacts/list', [ContactsController::class, 'index'])->name('list-contacts');
    // Add Contact
    Route::post('/contact/add', [ContactsController::class, 'add'])->name('add-contact');
    //Add bulk Contacts
    Route::get('/contact/addbulk', [ContactsController::class, 'addbulk'])->name('add-bulk-contact');
    // Import from CSV
    Route::post('/contact/import', [ContactsController::class, 'import'])->name('contacts-import');
    // Download the template
    Route::get('/contacts/templatedownload', [ContactsController::class, 'downloadTemplate'])->name('download-contacts-template');
    // Tagify the contacts List 
    Route::get('/contacts/get-all', [ContactsController::class, 'getAll'])->name('tagify-get-all');


    // END CONTACTS ROUTES 

}); // END OF AUTH GROUP

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test/prepaid-billing', [
    \App\Http\Controllers\PrepaidBillingController::class,
    'run'
]);


// Services Routes No dedicated file yet
Route::get('/services/list', [ServiceController::class, 'search']);


require __DIR__ . '/starlink.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/clients.php';
require __DIR__ . '/assets.php';
require __DIR__ . '/calix.php';
require __DIR__ . '/odoo.php';
require __DIR__ . '/recargaki.php';
