<?php


use App\Models\Product;
use App\Models\Catelogue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TestMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CatelogueController;

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


Route::get('/', function () {
   $products = Product::query()->latest('id')->limit(8)->get();
   // $cate = Catelogue::where('is_acvite', 1)->get();
   return view('client.index', compact('products'));
  
})->name('index');

// Auth::routes();
Route::get('auth/login', [LoginController::class,'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class,'login']);
Route::post('auth/logout', [LoginController::class,'logout'])->name('logout');

Route::get('auth/register', [RegisterController::class,'showFormRegister'])->name('register');
Route::post('auth/register', [RegisterController::class,'register']);

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('product/{slug}', [ProductController::class, 'detail'])->name('product.detail');

// Mua bán hàng
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');

// Route::get('/catelogue/{id}', [CatelogueController::class, 'show'])->name('catelogue.show');









