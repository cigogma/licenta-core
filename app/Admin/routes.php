<?php

use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\StationController;
use App\Admin\Controllers\StationDeviceController;
use App\Admin\Controllers\UsersController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', [HomeController::class, 'index'])->name('home');
    $router->resource('users', UsersController::class);
    $router->resource('stations', StationController::class);
    $router->resource('station-devices', StationDeviceController::class);
});
