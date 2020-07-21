<?php

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


Route::get('/', function (\Illuminate\Http\Request $request) {
    if (!file_exists('./install.block')){
        return redirect('/install/welcome');
    }
});
Route::get('/2', function (\Illuminate\Http\Request $request) {
    $startTime = strtotime('2020-07-15 12:12:12');
    $endTime = strtotime('2020-08-15 12:12:12');

     $arr = [
           'product_id' => 35,
           'stock'=>10,
           'start'=>$startTime,
           'end'=>$endTime,
           'poster'=>'',
     ];
     $activity = \App\Entity\Activity::find(1);
     $activity->activity_name = "flash_sale";
     $activity->status = 1;
     $activity->activity_data = serialize($arr);
     $activity->save();
     return "true";

});

/**
 *活动路由组
 */
Route::group(['prefix'=>'activity'],function (){
    Route::get('/get_activity/by_name','Service\ActivityController@getActivityByName');
});

/*****************************商城安装路由组***********************************/
Route::group(['prefix'=>'install'],function (){
    Route::get('welcome','Install\ViewController@welcome');
    Route::get('step1','Install\ViewController@step1');
    Route::get('step2','Install\ViewController@step2');
    Route::get('step3','Install\ViewController@step3');
    Route::get('step4','Install\ViewController@step4');
    Route::get('step5','Install\ViewController@step5');
    Route::get('db_validate','Install\ViewController@dbValidate');
    Route::post('data_submit','Install\ViewController@dataSubmit');
    Route::post('install_db','Install\ViewController@installDB');
});
/**
 * 回调路由组
 */
Route::group(['prefix'=>'notify'],function (){
    Route::any('/max_wechat','Service\NotifyController@wechatNotify');
});


// TODO 逻辑路由组
Route::group(["prefix" => "service"], function () {
    Route::post('/admin/login', 'Service\IndexController@adminLogin');
    //用户
    Route::get('/get_user_by_id', 'Service\UserController@getUserByID');
    Route::get('/get_users', 'Service\UserController@getUsers');
    Route::post('/new_user', 'Service\UserController@newUser');
    //产品
    Route::post('/product_add', 'Service\ProductController@productAdd');
    Route::get('/products', 'Service\ProductController@getProducts');
    Route::post('/product/change_status', 'Service\ProductController@changeStatus');
    Route::post('/product_edit', 'Service\ProductController@productEdit');
    Route::post('/product/delete', 'Service\ProductController@deleteProduct');
    Route::get('/product/{id}', 'Service\ProductController@getProductByID');
    //分类
    Route::post('/category_add', 'Service\CategoryController@categoryAdd');
    Route::post('/category_edit/{category_id}', 'Service\CategoryController@categoryEdit');
    Route::post('/category/delete', 'Service\CategoryController@categoryDelete');
    Route::get('/category', 'Service\CategoryController@getCategories');
    //快递
    Route::post('/shipping/add', 'Service\ShippingController@shippingAdd');
    //支付设置
    Route::post('/payment/add', 'Service\PaymentController@paymentAdd');
    Route::post('/payment/update', 'Service\PaymentController@paymentUpdate');
    //上传
    Route::post('/upload/{type}', 'Service\UploadController@upload');
    Route::post('/web_upload/', 'Service\UploadController@WebUpload');
});

//后台视图路由

Route::group(["prefix" => "admin"], function () {
    Route::get('/login','Admin\IndexController@toLogin');
    Route::group(["middleware" => "check_admin"],function (){
        Route::get('/', 'Admin\IndexController@toWelcome');

        //用户
        Route::get('/user-list', 'Admin\UserViewController@toUserList');
        Route::get('/edit-user/{user_id}', 'Admin\UserViewController@toEditUser');
        Route::get('/add-user', 'Admin\UserViewController@toAddUser');
        Route::post('/add_user_submit', 'Admin\UserViewController@addUserSubmit');
        Route::post('/edit_user_submit/{user_id}', 'Admin\UserViewController@editUserSubmit');
        //产品
        Route::get('/product-list', 'Admin\ProductViewController@toProductList');
        Route::get('/product-add', 'Admin\ProductViewController@toProductAdd');
        Route::get('/edit-product/{product_id}', 'Admin\ProductViewController@toEditProduct');
        //分类
        Route::get('/category-list', 'Admin\CategoryViewController@toCategoryList');
        Route::get('/category-add', 'Admin\CategoryViewController@toCategoryAdd');
        Route::get('/edit-category/{category_id}', 'Admin\CategoryViewController@toCategoryEdit');
        //媒体管理
        Route::get('/media/management/{page}', 'Admin\MediaViewController@toMediaView');

        //设置--快递
        Route::get('/shipping', 'Admin\ShippingViewController@toIndex');
        Route::get('/shipping-edit', 'Admin\ShippingViewController@toShippingEdit');
        Route::get('/shipping-add', 'Admin\ShippingViewController@toShippingAdd');
        //设置--支付
        Route::get('/payment', 'Admin\PaymentViewController@toPayment');
    });

});


Route::group(["prefix" => "miniprogram"], function () {
    //小程序登陆路由
    Route::get('/login', 'MiniProgram\MiniProgramController@login');
    Route::get('/logout', 'MiniProgram\MiniProgramController@logout');
});
//商店数据路由
Route::group(["prefix" => "store", "middleware" => "max_token"], function () {
    //商店首页信息
    Route::get('/info', 'Service\StoreController@getShopInfo');
    //产品
    Route::get('/products', 'Service\ProductController@getProducts');
    Route::get('/product/{id}', 'Service\ProductController@getProductByID');

    //分类
    Route::get('/category', 'Service\CategoryController@getCategories');

    //购物车
    Route::post('/cart/add', 'Service\CartController@addToCart');
    Route::post('/cart/update_with_count', 'Service\CartController@updateCartWithCount');
    Route::post('/cart/reduce', 'Service\CartController@reduceCart');
    Route::get('/cart', 'Service\CartController@getCart');

    //订单
    Route::post('/order/create', 'Service\OrderController@orderCreate');
    Route::get('/order/get', 'Service\OrderController@orderGet');


    //快递

    //支付网关
    Route::get('/payment/get', 'Service\PaymentController@getPayment');


});


