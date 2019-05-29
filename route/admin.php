<?php
/**
 * FileName: admin.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2019-01-10 10:08
 */


Route::group('manage', function () {

    Route::post('info', 'admin/login/info');
    Route::post('login', 'admin/login/login');
    Route::post('logout', 'admin/login/logout');
    Route::post('isLogin', 'admin/login/isLogin');

    Route::group('admin', function () {
        Route::get('info', 'admin/Admin/info');
        Route::get('lists', 'admin/Admin/lists');
        Route::post('add', 'admin/Admin/add');
        Route::post('edit', 'admin/Admin/edit');
        Route::get('del', 'admin/Admin/del');
        Route::post('status', 'admin/Admin/status');
        Route::post('delete', 'admin/Admin/delete');
    });

    Route::group('group', function () {
        Route::get('info', 'admin/AuthGroup/info');
        Route::get('lists', 'admin/AuthGroup/lists');
        Route::post('add', 'admin/AuthGroup/add');
        Route::post('edit', 'admin/AuthGroup/edit');
        Route::post('status', 'admin/AuthGroup/status');
        Route::post('delete', 'admin/AuthGroup/delete');
    });

    Route::group('article', function () {
        Route::get('info', 'admin/Article/info');
        Route::get('lists', 'admin/Article/lists');
        Route::post('add', 'admin/Article/add');
        Route::post('edit', 'admin/Article/edit');
        Route::post('status', 'admin/Article/status');
        Route::post('delete', 'admin/Article/delete');
    });

    Route::group('adposition', function () {
        Route::get('info', 'admin/AdPosition/info');
        Route::get('lists', 'admin/AdPosition/lists');
        Route::post('add', 'admin/AdPosition/add');
        Route::post('edit', 'admin/AdPosition/edit');
        Route::post('status', 'admin/AdPosition/status');
        Route::post('delete', 'admin/AdPosition/delete');
    });

    Route::group('ad', function () {
        Route::get('info', 'admin/Ad/info');
        Route::get('lists', 'admin/Ad/lists');
        Route::post('add', 'admin/Ad/add');
        Route::post('edit', 'admin/Ad/edit');
        Route::post('status', 'admin/Ad/status');
        Route::post('delete', 'admin/Ad/delete');
    });

    Route::group('category', function () {
        Route::get('info', 'admin/Categories/info');
        Route::get('lists', 'admin/Categories/lists');
        Route::post('add', 'admin/Categories/add');
        Route::post('edit', 'admin/Categories/edit');
        Route::post('status', 'admin/Categories/status');
        Route::post('delete', 'admin/Categories/delete');
    });

    Route::group('nav', function () {
        Route::get('info', 'admin/Navs/info');
        Route::get('lists', 'admin/Navs/lists');
        Route::post('add', 'admin/Navs/add');
        Route::post('edit', 'admin/Navs/edit');
        Route::post('status', 'admin/Navs/status');
        Route::post('delete', 'admin/Navs/delete');
    });

    Route::group('navposition', function () {
        Route::get('info', 'admin/NavPositions/info');
        Route::get('lists', 'admin/NavPositions/lists');
        Route::post('add', 'admin/NavPositions/add');
        Route::post('edit', 'admin/NavPositions/edit');
        Route::post('status', 'admin/NavPositions/status');
        Route::post('delete', 'admin/NavPositions/delete');
    });

    Route::group('label', function () {
        Route::get('info', 'admin/Labels/info');
        Route::get('lists', 'admin/Labels/lists');
        Route::post('add', 'admin/Labels/add');
        Route::post('edit', 'admin/Labels/edit');
        Route::post('status', 'admin/Labels/status');
        Route::post('delete', 'admin/Labels/delete');
    });

    Route::group('store', function () {
        Route::get('info', 'admin/Stores/info');
        Route::get('lists', 'admin/Stores/lists');
        Route::post('add', 'admin/Stores/add');
        Route::post('edit', 'admin/Stores/edit');
        Route::post('status', 'admin/Stores/status');
        Route::post('delete', 'admin/Stores/delete');
    });

    Route::group('business', function () {
        Route::get('info', 'admin/Businesses/info');
        Route::get('lists', 'admin/Businesses/lists');
        Route::post('add', 'admin/Businesses/add');
        Route::post('edit', 'admin/Businesses/edit');
        Route::post('status', 'admin/Businesses/status');
        Route::post('delete', 'admin/Businesses/delete');
    });

    Route::group('circle', function () {
        Route::get('info', 'admin/BusinessCircles/info');
        Route::get('lists', 'admin/BusinessCircles/lists');
        Route::post('add', 'admin/BusinessCircles/add');
        Route::post('edit', 'admin/BusinessCircles/edit');
        Route::post('status', 'admin/BusinessCircles/status');
        Route::post('delete', 'admin/BusinessCircles/delete');
    });

    Route::group('card', function () {
        Route::get('info', 'admin/Cards/info');
        Route::get('lists', 'admin/Cards/lists');
        Route::post('add', 'admin/Cards/add');
        Route::post('edit', 'admin/Cards/edit');
        Route::post('status', 'admin/Cards/status');
        Route::post('delete', 'admin/Cards/delete');
    });

    Route::group('comment', function () {
        Route::get('info', 'admin/Comments/info');
        Route::get('lists', 'admin/Comments/lists');
        Route::post('status', 'admin/Comments/status');
    });
    Route::group('order', function () {
        Route::get('info', 'admin/Orders/info');
        Route::get('lists', 'admin/Orders/lists');
        Route::post('status', 'admin/Orders/status');
    });

    Route::group('area', function () {
        Route::get('lists', 'admin/Area/lists');
    });

})->allowCrossDomain();