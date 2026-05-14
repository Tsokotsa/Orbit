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
use App\Http\Controllers\AdminController;


// Route::get('/', function () {
//     return view('sign-in')->name('login');
// });

//Route::get('/', [DefaultController::class, 'login'])->name('login');
Route::get('/', [DefaultController::class, 'login']);

// General Midleware for Auth
Route::middleware('auth')->group(function () {
    Route::get('land', [DefaultController::class, 'land'])->name('default')->name("dashboard.view");


    // SMS Routes
    Route::get('/sms/list', [SmsController::class, "index"])->name("sms.view");
    Route::post('/send-test-sms', [SmsController::class, "send_test"])->name('sms.send');
    Route::post('/soap-request', [SmsController::class, "makeSoapRequest"])->name('sms.soap-request');

    // TEST
    Route::get('/test', [SmsController::class, "test"]);

    // Test Telegram 
    Route::get('/telegram/list', [TelegramController::class, "index"])->name('telegram.view');
    Route::post('/send-test-telegram', [TelegramController::class, "send_test"])->name('telegram.send');
    //Route::get('/getall-telegram', [TelegramController::class, "getSubscribers"])->name('telegram-subscribers');

    // USERS
    // Index View
    Route::get('/users/list', [UserController::class, 'index'])->name('user.view');
    // List Users
    Route::get('/users/getAll', [UserController::class, 'getUsers'])->name("user.getall");
    // Add
    Route::post('/user/add', [UserController::class, 'add_user'])->name('user.add');
    // Edit 
    Route::get('/user/{uid}/edit', [UserController::class, 'edit_user'])->name('user.edit');
    // Update Email
    Route::post('/user/update-email', [UserController::class, 'updateEmail'])->name('user.update-email');
    // Update Password
    Route::post('/user/update-passwd', [UserController::class, 'updatePasswd'])->name('user.update-password');
    // Update Details
    Route::post('/user/update-details', [UserController::class, 'updateDetails'])->name('user.update-details');

    Route::post('/user/update-role', [UserController::class, 'updateRole'])->name('user.update-role');

    Route::get('/user/profile', [UserController::class, 'view_profile'])->name('user.profile');

    Route::get('/users/{user}/roles', [UserController::class, 'getUserRoles'])->name('users.roles');

    Route::post('/users/update-role', [UserController::class, 'updateRole'])->name('users.update.role');

    Route::prefix('admin/users')->middleware(['auth'])->group(function () {

        Route::get('{user}/permissions', [UserController::class, 'permissions'])
            ->name('admin.users.permissions');

        Route::post('{user}/permissions/assign', [UserController::class, 'assignPermission'])
            ->name('admin.users.permissions.assign')->middleware('permission:admin.users.permissions.assign');

        Route::delete('{user}/permissions/remove', [UserController::class, 'removePermission'])
            ->name('admin.users.permissions.remove');

    });




    // EMAIL 

    Route::get('/email/list', [EmailController::class, "listEmails"])->name('email.list');
    Route::post('/send-test-email', [EmailController::class, "send_test_Email"])->name('email.send-test');

    Route::get('/email/{emailid}/compose-email', [EmailController::class, 'index'])->name('email.email-compose');

    // Schedule Email 
    Route::post('/email/schedule', [EmailController::class, 'scheduleEmail'])->name('email.Schedule-Email');

    // Set Settings Email
    Route::post('/email/set-settings', [EmailController::class, "setSettings"])->name('email.set-settings');

    // CAMPAIGN 

    Route::post('/create-campaign', [DefaultController::class, "create_Campaign"])->name('campaign.create');
    Route::post('/campaign/cancel', [DefaultController::class, "cancelCampaign"])->name('campaign.cancel');

    // CONTACTS
    // List
    Route::get('/contacts/list', [ContactsController::class, 'index'])->name('contact.view');
    // Add Contact
    Route::post('/contact/add', [ContactsController::class, 'add'])->name('contact.add');
    //Add bulk Contacts
    Route::get('/contact/addbulk', [ContactsController::class, 'addbulk'])->name('contact.add-bulk');
    // Import from CSV
    Route::post('/contact/import', [ContactsController::class, 'import'])->name('contact.import');
    // Download the template
    Route::get('/contacts/templatedownload', [ContactsController::class, 'downloadTemplate'])->name('contact.download-template');
    // Tagify the contacts List 
    Route::get('/contacts/get-all', [ContactsController::class, 'getAll'])->name('contact.tagify-get-all');

    // END CONTACTS ROUTES 



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
    Route::get('/services/list', [ServiceController::class, 'search'])->name('services.search');


    Route::post('/admin/permissions/cache-reset', [AdminController::class, 'resetPermissionCache'])
        ->middleware(['auth', 'role:Super Admin']);


    Route::get('admin/edit_role/{role}', [RolesPermissionController::class, 'view_role'])->name('role.view');

    Route::post('admin/roles/unlink-permission', [RolesPermissionController::class, 'unlinkPermission'])->name('admin.permission-unlink');
    Route::get('admin/roles/{role}/available-permissions', [RolesPermissionController::class, 'availablePermissions'])->name("admin.get-permissions");
    Route::post('admin/roles/assign-permissions', [RolesPermissionController::class, 'assignPermissions'])->name('admin.permissions-assign');
    Route::post('admin/roles/store', [RolesPermissionController::class, 'update'])->name('admin.role-update');
    // Roles and Permissions
    Route::get('/roles-perm', [RolesPermissionController::class, 'list_roles_perms'])->name('admin.view-role-perm');
    Route::get('/list/permissions', [RolesPermissionController::class, 'list_perms'])->name('admin.permissions-list');
    Route::post('/permission/add', [RolesPermissionController::class, 'add_permission'])->name('admin.permission-add');
    Route::post('permission/{perm_id}/update', [RolesPermissionController::class, 'perm_update'])->name('admin.permission-update');

    // Add Role
    Route::post('/role/add', [RolesPermissionController::class, 'add_role'])->name('admin.role-add');

}); // END OF AUTH GROUP

require __DIR__ . '/starlink.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/clients.php';
require __DIR__ . '/assets.php';
require __DIR__ . '/calix.php';
require __DIR__ . '/odoo.php';
require __DIR__ . '/recargaki.php';

