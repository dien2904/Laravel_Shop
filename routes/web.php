<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authmiddleware;
use App\Http\Middleware\Loginmiddleware;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;


Route::get('admin/signin', [AuthController::class, 'index'])->name('auth.signin')->middleware(Loginmiddleware::class);
Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('admin/signup', [AuthController::class, 'showregister'])->name('auth.signup');
Route::post('admin/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('admin/logout', [AuthController::class ,'logout'])->name('auth.logout') ;

Route::get('admin/dashboard', [DashboardController::class ,'index'])->name('auth.dashboard') ->middleware(Authmiddleware::class) ;

Route::get('admin/user', [UserController::class ,'index'])->name('auth.user') ->middleware(Authmiddleware::class) ;
Route::get('admin/user/create', [UserController::class ,'create'])->name('auth.create') ->middleware(Authmiddleware::class) ;
Route::post('admin/user/create', [UserController::class ,'CreatedUser'])->name('user.create') ->middleware(Authmiddleware::class) ;

Route::get('admin/user/{id}/edit', [UserController::class ,'edit'])->name('user.edit') ->middleware(Authmiddleware::class) ;
Route::put('admin/user/{id}/edit', [UserController::class ,'edit'])->name('user.edit') ->middleware(Authmiddleware::class) ;
Route::put('admin/user/{id}/edit', [UserController::class ,'update'])->name('user.update') ->middleware(Authmiddleware::class) ;
Route::get('admin/user/{id}/delete', [UserController::class ,'destroy'])->name('user.delete') ->middleware(Authmiddleware::class) ;
Route::delete('admin/user/{id}/delete', [UserController::class ,'destroy'])->name('user.delete') ->middleware(Authmiddleware::class) ;


Route::get('/', [ShopController::class, 'index']);

Route::get('/hello', [HomeController::class, 'xinchao']);
Route::get('/users', [HomeController::class, 'getUsers']);
Route::get('/product', [ProductController::class, 'productview']);
Route::get('/product/search', [ProductController::class, 'productSearch']);
Route::get('/product/{id}', [ProductController::class, 'productdetail'])->name('product.detail'); 
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/{id}', [ShopController::class, 'shopchitiet']);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware(Authmiddleware::class) ;
Route::put('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware(Authmiddleware::class) ;
Route::put('/categories/{id}/edit', [CategoryController::class, 'update'])->name('categories.update')->middleware(Authmiddleware::class) ;
Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete')->middleware(Authmiddleware::class) ;
Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete')->middleware(Authmiddleware::class) ;

Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware(Authmiddleware::class) ;
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware(Authmiddleware::class) ;
Route::put('/product/{id}/edit', [ProductController::class, 'update'])->name('product.update')->middleware(Authmiddleware::class) ;
Route::get('/product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy')->middleware(Authmiddleware::class) ;
Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy')->middleware(Authmiddleware::class) ;

Route::get('/order', [OrderController::class, 'index'])->name('order.index')->middleware(Authmiddleware::class) ;
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit')->middleware(Authmiddleware::class) ;
Route::put('/order/{id}/edit', [OrderController::class, 'update'])->name('order.update')->middleware(Authmiddleware::class) ;
Route::get('/order/{id}/detail', [OrderController::class, 'index'])->name('order.detail')->middleware(Authmiddleware::class) ;

Route::get('/order/{id}/delete', [OrderController::class, 'destroy'])->name('order.destroy')->middleware(Authmiddleware::class) ;
Route::delete('/order/{id}/delete', [OrderController::class, 'destroy'])->name('order.destroy')->middleware(Authmiddleware::class) ;


Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');


//cong thanh toan vnpay
Route::get('/vnpay_payment',[PaymentController::class , 'vnpay_payment'])->name('vnpay_payment');
Route::post('/vnpay_payment',[PaymentController::class , 'vnpay_payment'])->name('vnpay_payment');




Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('cart', CartController::class);
Route::get('checkout', [CheckoutController::class, 'index'])->middleware("auth");
Route::post('checkout', [CheckoutController::class, 'checkout'])->name("checkoutPost");
Route::get('checkout/success', [CheckoutController::class, 'checkoutTK']);
Route::get('/dashboard', function () {
    return view('dashboard.home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('havandien2004@gmail.com')
            ->subject('Test Email');
    });
    return 'Email sent successfully';
})->middleware(CheckPermission::class);
require __DIR__ . '/auth.php';
