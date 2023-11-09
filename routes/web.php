<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/index',[UserController::class,'index']);
Route::any('/index/{shop}',[UserController::class,'indexes'])->name('index');
Route::post('/index',[UserController::class,'data_storage']);
Route::get('/redirect',[UserController::class,'redirect']);

Route::any('/gettoken',[UserController::class,'gettoken']);
Route::any('/showdata',[UserController::class,'showdata']);
 Route::any('/product/{shop}',[UserController::class,'get_product'])->name('product');
 Route::any('/blogs/{shop}',[UserController::class,'get_blogs'])->name('blogs');
 Route::any('/pages/{shop}',[UserController::class,'get_pages'])->name('pages');
//Route::any('/product',[UserController::class,'get_product'])->name('product');
// Route::get('/home',[UserController::class,'home'])->name('home');
// Route::get('/settings/{shop}',[UserController::class,'settings'])->name('settings');
 Route::get('/instructions/{shop}',[UserController::class,'instructions'])->name('instructions');
Route::any('/search/{shop}',[UserController::class,'product_search'])->name('product_search');
// Route::any('/search',[UserController::class,'product_search'])->name('product_search');
//Route::any('/instructions',[UserController::class,'instructions'])->name('instructions');
Route::any("/webhook",[UserController::class,'webhook'])->name('web');
Route::any("/webhookproduct",[UserController::class,'webhook_product_create']);
Route::any("/webhookprod-del",[UserController::class,'webhook_product_del']);
Route::any("/webhookprod-upd",[UserController::class,'webhook_product_upd']);