<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
// Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password', 'AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update', 'AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

//Categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@store')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@Deletecategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@Editcategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@Updatecategory');

//Brand
Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\BrandController@store')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\BrandController@Deletebrand');
Route::get('edit/brand/{id}', 'Admin\Category\BrandController@Editbrand');
Route::post('update/brand/{id}', 'Admin\Category\BrandController@Updatebrand');

//subcategories
Route::get('admin/subcategory', 'Admin\Category\SubcategoryController@subcategory')->name('sub.categories');
Route::post('admin/store/subcategory', 'Admin\Category\SubcategoryController@store')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\SubcategoryController@Deletesubcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\SubcategoryController@Editsubcategory');
Route::post('update/subcategory/{id}', 'Admin\Category\SubcategoryController@Updatesubcategory');

//Coupons
Route::get('admin/coupon', 'Admin\Category\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\Category\CouponController@store')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\Category\CouponController@Deletecoupon');
Route::get('edit/coupon/{id}', 'Admin\Category\CouponController@Editcoupon');
Route::post('update/coupon/{id}', 'Admin\Category\CouponController@Updatesubcoupon');

//Newsletter
Route::get('admin/newsletter', 'Admin\Category\NewsletterController@newsletter')->name('admin.newsletter');
Route::post('admin/store/newsletter', 'Admin\Category\NewsletterController@store')->name('store.newsletter');
Route::get('delete/newsletter/{id}', 'Admin\Category\NewsletterController@Delete');

//Products
Route::get('admin/products', 'Admin\ProductController@product')->name('all.products');
Route::get('admin/products/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product', 'Admin\ProductController@store')->name('store.product');
Route::post('admin/status/update/{id}', 'Admin\ProductController@status')->name('product.status.update');
Route::get('delete/product/{id}', 'Admin\ProductController@delete');
Route::get('view/product/{id}', 'Admin\ProductController@show');
Route::get('edit/product/{id}', 'Admin\ProductController@edit');
Route::post('update/product/{id}', 'Admin\ProductController@update');

//Getting subacategory using ajax
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getsubcategory');

//Blog category
Route::get('admin/blog/category', 'Admin\BlogController@index')->name('blog.category');
Route::post('admin/blog/category/store', 'Admin\BlogController@store')->name('store.blogcategory');
Route::get('delete/blog/{id}', 'Admin\BlogController@delete');
Route::get('edit/blog/{id}', 'Admin\BlogController@edit');
Route::post('update/blog/{id}', 'Admin\BlogController@update');

//Post
Route::get('admin/post', 'Admin\PostController@post')->name('all.post');
Route::get('admin/post/create', 'Admin\PostController@create')->name('add.post');
Route::post('admin/post/create', 'Admin\PostController@store')->name('store.post');
Route::get('delete/post/{id}', 'Admin\PostController@delete');
Route::get('edit/post/{id}', 'Admin\PostController@edit');
Route::post('update/post/{id}', 'Admin\PostController@update');

//wishlist
Route::get('add/wishlist/{id}', 'WishlistController@wishlist');

//add to cart
Route::get('add/to/cart/{id}', 'CartController@cart');
Route::get('check', 'CartController@check');
Route::get('show/cart', 'CartController@show')->name('show.cart');
Route::get('remove/cart/{id}', 'CartController@remove');
Route::post('update/cart', 'CartController@update')->name('update.quantity');
Route::get('/cart/product/view/{id}', 'CartController@view');
Route::post('insert/cart', 'CartController@insert')->name('insert.into.cart');
Route::get('user/checkout', 'CartController@checkout')->name('user.checkout');
Route::get('user/wishlist', 'CartController@wishlist')->name('user.wishlist');
Route::post('user/coupon', 'CartController@coupon')->name('apply.coupon');
Route::get('remove/coupon', 'CartController@couponremove')->name('coupon.remove');
//product details
Route::get('product/details/{id}/{product_name}', 'ProductController@index');
Route::post('add/cart/{rowId}', 'ProductController@store');

//blog post route
Route::get('blog/post', 'BlogController@blog')->name('blog.post');
Route::get('language/english', 'BlogController@english')->name('language.english');
Route::get('language/hindi', 'BlogController@hindi')->name('language.hindi');
Route::get('blog/single/{id}', 'BlogController@view');

//Payment
Route::get('payment', 'PaymentController@index')->name('user.payment');
Route::post('payment/process', 'PaymentController@payment')->name('payment.process');
Route::post('transaction', 'PaymentController@transaction')->name('stripe.charge');

//category click
Route::get('products/{id}', 'ProductController@subcatview');
Route::get('allcategory/{id}', 'ProductController@categoryview');


// Admin order details
Route::get('orders', 'Admin\OrderController@index')->name('admin.neworder');
Route::get('admin/view/order/{id}', 'Admin\OrderController@view');
Route::get('user/view/order/{id}', 'HomeController@view');
Route::get('admin/payment/accept/{id}', 'Admin\OrderController@PaymentAccept');
Route::get('admin/payment/cancel/{id}', 'Admin\OrderController@PaymentCancel');

Route::get('admin/accept/payment', 'Admin\OrderController@AcceptPayment')->name('admin.accept.payment');

Route::get('admin/cancel/order', 'Admin\OrderController@CancelOrder')->name('admin.cancel.order');

Route::get('admin/process/payment', 'Admin\OrderController@ProcessPayment')->name('admin.process.payment');
Route::get('admin/success/payment', 'Admin\OrderController@SuccessPayment')->name('admin.success.payment');

Route::get('admin/delevery/process/{id}', 'Admin\OrderController@DeleveryProcess');
Route::get('admin/delevery/done/{id}', 'Admin\OrderController@DeleveryDone');

//seo
Route::get('admin/seo', 'Admin\SeoController@seo')->name('admin.seo');
Route::post('admin/seo/update', 'Admin\SeoController@update')->name('update.seo');


//order tracking
Route::post('order/tracking', 'OrderTrackingController@index')->name('order.tracking');


//report
Route::get('today/order', 'Admin\ReportController@todayorder')->name('today.order');
Route::get('today/deliever', 'Admin\ReportController@todaydeliever')->name('today.delievery');
Route::get('this/month', 'Admin\ReportController@month')->name('this.month');
Route::get('this/year', 'Admin\ReportController@year')->name('this.year');
Route::get('search/report', 'Admin\ReportController@search')->name('search.report');
Route::post('search/report/date', 'Admin\ReportController@searchbydate')->name('search.by.date');
Route::post('search/report/month', 'Admin\ReportController@searchbymonth')->name('search.by.month');
Route::post('search/report/year', 'Admin\ReportController@searchbyyear')->name('search.by.year');


//Admin Role Route
Route::get('admin/all/user', 'Admin\UserRoleController@adminusers')->name('admin.all.user');
Route::get('admin/create', 'Admin\UserRoleController@createadmin')->name('create.admin');
Route::post('store/admin/users', 'Admin\UserRoleController@storeadmin')->name('store.admin');
Route::get('edit/admin/{id}', 'Admin\UserRoleController@edit');
Route::get('delete/admin/{id}', 'Admin\UserRoleController@delete');
Route::post('update/admin', 'Admin\UserRoleController@update')->name('update.admin');

//site setting
Route::get('admin/site/setting', 'Admin\Sitecontroller@site')->name('site.setting');
Route::post('update/site/setting', 'Admin\Sitecontroller@update')->name('update.sitesetting');


//Return order
Route::get('success/orderlist', 'OrderTrackingController@success')->name('success.orderlist');
Route::get('request/return/{id}', 'OrderTrackingController@return');

//Admin return order
Route::get('Admin/Return/Order','Admin\ReturnController@return')->name('admin.return.request');
Route::get('admin/approve/return/{id}','Admin\ReturnController@approve');
Route::get('Admin/all/return/order','Admin\ReturnController@allreturn')->name('admin.all.return.request');

//stock
Route::get('admin/stock','Admin\StockController@stock')->name('admin.product.stock');

//contact
Route::get('contact/page','ContactController@contact')->name('contact.page');
Route::post('contact/form','ContactController@form')->name('contact.form');

Route::get('all/messsage','ContactController@allmessage')->name('admin.all.contact');

//product search
Route::post('product/search','CartController@search')->name('product.search');

//socila login
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
