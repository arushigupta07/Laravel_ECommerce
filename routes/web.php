<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeValuesController;
use App\Http\Controllers\Admin\FrontController;

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
    return view('auth/login');
    //return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::get('/', [HomeController::class, 'index']);       
Route::get('/category/{id}', [HomeController::class, 'category']); 
Route::get('/product/{id}', [HomeController::class, 'product']);  

Route::middleware(['auth', 'user-access:user'])->group(function () { 
    Route::get('/home', [HomeController::class, 'index'])->name('home'); 
});
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');


Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/category/manage_category',[CategoryController::class,'manageCategory']);
Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manageCategory']);
Route::post('admin/category/manage_category_process',[CategoryController::class,'manageCategoryProcess'])->name('category.manageCategoryProcess');
Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);

Route::get('admin/attribute',[ProductAttributeController::class,'index']);
Route::get('admin/attribute/manage_attribute',[ProductAttributeController::class,'manageAttribute']);
Route::get('admin/attribute/manage_attribute/{id}',[ProductAttributeController::class,'manageAttribute']);
Route::post('admin/attribute/manage_attribute_process',[ProductAttributeController::class,'manageAttributeProcess'])->name('attribute.manageAttributeProcess');
Route::get('admin/attribute/delete/{id}',[ProductAttributeController::class,'delete']);
Route::get('admin/attribute/status/{status}/{id}',[ProductAttributeController::class,'status']);

   
Route::get('admin/product',[ProductController::class,'index']);
Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);

//Route::get('admin/attribute_values',[AttributeValuesController::class,'index']);
Route::get('admin/attribute_values', function () {
    $result= \DB::table('attribute_values')->get();
    return view('admin/attribute_values', compact('result'));
});
Route::get('admin/attribute_values/manage_attribute_values',[AttributeValuesController::class,'manage_attribute_values']);
Route::get('admin/attribute_values/manage_attribute_values/{id}',[AttributeValuesController::class,'manage_attribute_values']);
Route::post('admin/attribute_values/manage_attribute_values_process',[AttributeValuesController::class,'manage_attribute_values_process'])->name('attribute_values.manage_attribute_values_process');
Route::get('admin/attribute_values/delete/{id}',[AttributeValuesController::class,'delete']);
Route::get('admin/attribute_values/status/{status}/{id}',[AttributeValuesController::class,'status']);
Route::get('admin/attribute_values/attribute_values_attr_delete/{paid}/{pid}',[AttributeValuesController::class,'attribute_values_attr_delete']);
});
