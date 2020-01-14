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

Route::get('/', function () {
    return view('welcome');
});
//闭包（必填路由）
// Route::get('/goods/{id}', function ($id) {
//     echo "$id";
// });

//id必须为数字
//Route::get('/goods/{id}','IndexController@goods')->where('id','\d+');
//Route::get('/goods/{id}/{name?}','IndexController@getgoods')->where('id','\d+');

    Route::view('/login','admin/login/login');
    Route::post('/dologin','login\LoginController@dologin');
    Route::get('/logout','login\LoginController@logout');
//路由分组 品牌
    Route::prefix('brand')->middleware('checklogin')->group(function(){
        Route::get('create','Admin\BrandController@create');
        Route::post('store','Admin\BrandController@store');

        Route::get('/','Admin\BrandController@index');
        Route::get('/edit/{id}','Admin\BrandController@edit');
        Route::post('/update/{id}','Admin\BrandController@update');
        Route::get('/del/{id}','Admin\BrandController@destroy');
        Route::get('checkOnly','Admin\BrandController@checkOnly');

    });
//分类
    Route::prefix('cate')->group(function(){
        Route::get('create','Admin\CategoryController@create');
        Route::post('store','Admin\CategoryController@store');

        Route::get('/','Admin\CategoryController@index');
        Route::get('/edit/{id}','Admin\CategoryController@edit');
        Route::post('/update/{id}','Admin\CategoryController@update');
        Route::get('/del/{id}','Admin\CategoryController@destroy');

    });

//路由分组 商品
Route::prefix('goods')->group(function(){
    Route::get('create','Admin\GoodsController@create');
    Route::post('store','Admin\GoodsController@store');

    Route::get('/','Admin\GoodsController@index');
    Route::get('/edit/{id}','Admin\GoodsController@edit');
    Route::post('/update/{id}','Admin\GoodsController@update');
    Route::get('/del/{id}','Admin\GoodsController@destroy');
    Route::get('checkOnly','Admin\GoodsController@checkOnly');
    Route::get('/show/{id}','Admin\GoodsController@show');
    Route::post('/addcart','Admin\GoodsController@addcart');

});


route::get('/send','Admin\BrandController@sendemail');


//    Route::get('/brand/create','Admin\BrandController@create');
//    Route::post('/brand/store','Admin\BrandController@store');
//
//    Route::get('/brand','Admin\BrandController@index');
//    Route::get('/brand/edit/{id}','Admin\BrandController@edit');
//    Route::post('/brand/update/{id}','Admin\BrandController@update');
//    Route::get('/brand/del/{id}','Admin\BrandController@destroy');


//文章
//        Route::get('/member/create','ok\MemberController@create');
//        Route::post('/member/store','ok\MemberController@store');
//
//        Route::get('/member','ok\MemberController@index');
//        Route::get('/member/edit/{id}','ok\MemberController@edit');
//       // Route::post('/member/update/{id}','ok\MemberController@update');
////第一种ajax删除
//      //  Route::post('/member/del/{id}','ok\MemberController@destroy');
//        Route::get('/member/del/{id}','ok\MemberController@destroy');




//新闻
    Route::prefix('news')->group(function(){
        Route::get('/create','test\NewsController@create');
        Route::post('/store','test\NewsController@store');
        Route::get('/','test\NewsController@index');
        Route::get('/edit/{id}','test\NewsController@edit');
        Route::post('/update/{id}','test\NewsController@update');
        Route::get('/del/{id}','test\NewsController@destroy');

    });



//楼房

Route::get('/house/create','ok\HouseController@create');
Route::post('/member/store','ok\MemberController@store');

Route::get('/member','ok\MemberController@index');
Route::get('/member/edit/{id}','ok\MemberController@edit');
// Route::post('/member/update/{id}','ok\MemberController@update');
//第一种ajax删除
//  Route::post('/member/del/{id}','ok\MemberController@destroy');
Route::get('/member/del/{id}','ok\MemberController@destroy');






//将cookie添加到响应上
 route::get('/set',function(){
    return response('hello')->cookie('name','张三',5);
});
route::get('/get',function(){
    return request()->cookie('name');
});
//第二种添加cookie
        route::get('/set2',function(){
              Illuminate\Support\Facades\Cookie::queue('name','lisi',1);
            echo  request()->cookie('name');
        });


   