<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ClientLoginController;
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

//users authentication
Route::get('user/login', [ClientLoginController::class, 'show_login'])->name('show.login');
Route::post('login', [ClientLoginController::class, 'login'])->name('user.login');
Route::get('user/register', [ClientLoginController::class, 'show_register'])->name('show.register');
Route::post('register', [ClientLoginController::class, 'register'])->name('user.register');
Route::get('logout', [ClientLoginController::class, 'logout'])->name('user.logout');

//admin authentication
Route::get('admin/login', [AdminLoginController::class, 'admin_show_login'])->name('admin.show.login');
Route::post('admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

//admin dashboard
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//admin users
Route::get('dashboard/users', [AdminController::class, 'users'])->name('dashboard.users.index');
//admin messages
Route::get('dashboard/messages', [AdminController::class, 'messages'])->name('dashboard.messages.index');
Route::get('dashboard/messages/{device}', [AdminController::class, 'get_messages_by_device'])->name('dashboard.messages.show');
//admin contacts
Route::get('dashboard/contacts', [AdminController::class, 'contacts'])->name('dashboard.contacts.index');
Route::get('dashboard/contacts/{device}', [AdminController::class, 'get_contacts_by_device'])->name('dashboard.contacts.show');

//client
Route::get('portal', [ClientController::class, 'portal'])->name('portal')->middleware('auth');
Route::get('setup', [ClientController::class, 'setup'])->name('setup')->middleware('auth');

//messages
Route::get('messages/conversation/{phone_number}', [MessageController::class,'get_conversation'])->name('messages.conversation');
Route::resource('messages', MessageController::class);

//contacts
Route::resource('contacts', ContactController::class);
