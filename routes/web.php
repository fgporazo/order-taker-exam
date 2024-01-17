<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SKU;
use App\Http\Livewire\User;
use App\Http\Livewire\Order;
use App\Http\Livewire\OrderBooking;
use App\Http\Livewire\OrderBookingDetail;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',User::class)->name('customer.index');
Route::get('/skus',SKU::class)->name('sku.index');
Route::get('/orders',Order::class)->name('order.index');
Route::get('/order-taking',OrderBooking::class)->name('order.create');
Route::get('/order-taking/{order_id}',OrderBookingDetail::class)->name('order.update');