<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Payment;



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

Route::get('/test', function () {
    // $balance = 0;
    // $invoice_balance = Invoice::where('customer_id',1)->sum('total');
    // $payment_balance = Payment::where('customer_id',1)->sum('amount');
    // return $payment_balance-$invoice_balance;
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isApproved'])->group(function () {
    //USER ROUTES
    Route::middleware(['isSuperAdmin'])->group(function () {
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware(['auth','isSuperAdmin']);
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::match(['put', 'patch'],'/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/delete/{user_id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
        //ROLE ROUTES
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
        Route::match(['put', 'patch'],'/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
        // Route::patch('/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
        Route::get('/roles/delete/{role}', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
        Route::put('/roles/{role}/attach/', [App\Http\Controllers\RoleController::class, 'attachPermission'])->name('roles.permissions.attach');
        Route::put('/roles/{role}/detach/', [App\Http\Controllers\RoleController::class, 'detachPermission'])->name('roles.permissions.detach');
    });
    //COMPANY ROUTES
    Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::match(['put', 'patch'],'/companies/{company}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    // Route::patch('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
    Route::get('/companies/delete/{company}', [App\Http\Controllers\CompanyController::class, 'delete'])->name('companies.delete');
    //PRODUCTS ROUTES
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::match(['put', 'patch'],'/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    // Route::patch('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/delete/{product}', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.delete');
    //CUSTOMERS ROUTES
    Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
    Route::match(['put', 'patch'],'/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    // Route::patch('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers/delete/{customer}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customers.delete');
    //INVOICES ROUTES
    Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create/{customer}', [App\Http\Controllers\InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [App\Http\Controllers\InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}/edit', [App\Http\Controllers\InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::match(['put', 'patch'],'/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'update'])->name('invoices.update');
    // Route::patch('/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('/invoices/delete/{invoice}', [App\Http\Controllers\InvoiceController::class, 'delete'])->name('invoices.delete');
    //PAYMENTS ROUTES
    Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create/{customer}', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}/edit', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payments.edit');
    Route::match(['put', 'patch'],'/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
    // Route::patch('/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::get('/payments/delete/{payment}', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payments.delete');
    Route::get('/payments/assign/{customer}', [App\Http\Controllers\PaymentController::class, 'assign'])->name('payments.assign');
    Route::post('/payments/link/{customer}', [App\Http\Controllers\PaymentController::class, 'link'])->name('payments.link');
});

//AUTHENTICATION ROUTES
Auth::routes(['verified'=>true]);
//EMAIL VERIFICATION ROUTES
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
