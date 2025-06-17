<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Livewire\counterComponent;



Auth::routes();


 
Route::get('/counter', counterComponent::class);

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}',[ShopController::class,'product_details'])->name("shop.product.details");


Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add',[CartController::class,'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-qunatity/{rowId}',[CartController::class,'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-qunatity/{rowId}',[CartController::class,'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove/{rowId}',[CartController::class,'remove_item'])->name('cart.item.remove');
Route::delete('/cart/clear',[CartController::class,'empty_cart'])->name('cart.empty');


Route::post('/cart/apply-coupon',[CartController::class,'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('/cart/remove-coupon',[CartController::class,'remove_coupon_code'])->name('cart.coupon.remove');

Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/place-order',[CartController::class,'place_order'])->name('cart.place.order');
Route::get('/order-confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');

Route::get('/contact-us',[HomeController::class, 'contact'])->name('home.contact');
Route::post('/contact/store',[HomeController::class, 'contact_store'])->name('home.contact.store');

// Route::get('/shipping-address/edit', [ShippingAddressController::class, 'edit'])->name('shipping.address.edit');
// Route::put('/shipping-address/update', [ShippingAddressController::class, 'update'])->name('shipping.address.update');
// Route::delete('/shipping-address/delete', [ShippingAddressController::class, 'destroy'])->name('shipping.address.delete');

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');



Route::get('/about', [HomeController::class, 'about'])->name('home.about');







// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', action: [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions');
    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/admin/permissions/create', action: [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/admin/permissions', action: [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/admin/permissions/{id}/edit', action: [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::post('/admin/permissions/{id}', action: [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/admin/permissions', action: [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

    //Roles Route
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/create', action: [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles', action: [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/admin/roles/{id}/edit', action: [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/admin/roles/{id}', action: [RoleController::class, 'update'])->name('admin.roles.update');
    // Route::delete('/admin/roles', action: [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    
    //Users Routes

    
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    Route::get('/admin/users/create', action: [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', action: [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', action: [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users/{id}', action: [UserController::class, 'update'])->name('admin.users.update');
    // Route::delete('/roles', action: [RoleController::class, 'destroy'])->name('roles.destroy');







    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');

    Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
    Route::get('/admin/brand/add',[AdminController::class,'add_brand'])->name('admin.brand.add');
    Route::post('/admin/brand/store',[AdminController::class,'add_brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [AdminController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update',[AdminController::class,'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete',[AdminController::class,'delete_brand'])->name('admin.brand.delete');

    Route::get('/admin/categories',[AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/category/add',[AdminController::class,'add_category'])->name('admin.category.add');
    Route::get('admin/category/products', [AdminController::class, 'index'])->name('admin.category.products');
    Route::post('/admin/category/store',[AdminController::class,'add_category_store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit',[AdminController::class,'edit_category'])->name('admin.category.edit');
    Route::put('/admin/category/update',[AdminController::class,'update_category'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete',[AdminController::class,'delete_category'])->name('admin.category.delete');

    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add',[AdminController::class,'add_product'])->name('admin.product.add');
    Route::post('/admin/product/store',[AdminController::class,'product_store'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit',[AdminController::class,'edit_product'])->name('admin.product.edit');
    Route::put('/admin/product/update',[AdminController::class,'update_product'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[AdminController::class,'delete_product'])->name('admin.product.delete');

    Route::get('/admin/coupons',[AdminController::class,'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add',[AdminController::class,'add_coupon'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store',[AdminController::class,'add_coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/coupon/{id}/edit',[AdminController::class,'edit_coupon'])->name('admin.coupon.edit');
    Route::put('/admin/coupon/update',[AdminController::class,'update_coupon'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/{id}/delete',[AdminController::class,'delete_coupon'])->name('admin.coupon.delete');

    Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order/items', [AdminController::class, 'items'])->name('admin.order.items');
    Route::get('/admin/order/items/{order_id}',[AdminController::class,'order_items'])->name('admin.order.items');
    Route::put('/admin/order/update-status',[AdminController::class,'update_order_status'])->name('admin.order.status.update');

    Route::get('/admin/contact',[AdminController::class,'contacts'])->name('admin.contacts');
    Route::delete('/admin/contact/{id}/delete',[AdminController::class,'contact_delete'])->name('admin.contact.delete');



});

require __DIR__.'/auth.php';
