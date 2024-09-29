<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    // Route::get('permissions/index',[PermissionController::class,'indexs'])->name('permissions.indexs');
    Route::get('permission/list',[PermissionController::class,'index'])->name('permission.list');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::Post('/permission/store',[PermissionController::class,'store'])->name('permission.store');
    Route::get('/permissionsedit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::Post('permissionupdate/{id}',[PermissionController::class,'update'])->name('permission.update');
    Route::get('permissiondelete/{id}',[PermissionController::class,'destroy'])->name('permission.delete');

    //role routes
        Route::get('role/index',[RoleController::class,'index'])->name('role.list');   
       Route::get('role/create',[RoleController::class,'create'])->name('role.create');
       Route::post('role/store',[RoleController::class,'store'])->name('role.store');
       Route::get('/roleedit/{id}', [RoleController::class, 'edit'])->name('role.edit');
       Route::Post('/roleupdate/{id}',[RoleController::class,'update'])->name('role.update');
      Route::get('roledelete/{id}',[RoleController::class,'destroy'])->name("role.delete");
     
      // article
     
        Route::get('create/art',[ArticleController::class,'create'])->name('create.art');
        Route::post('art/store',[ArticleController::class,'store'])->name('art.store');
        Route::get('art/index',[ArticleController::class,'index'])->name('art.index');
        Route::get('artedit/{id}',[ArticleController::class,'edit'])->name('art.edit');
        Route::Post('artupdate/{id}',[ArticleController::class,'update'])->name('art.update');
        Route::get('artdelete/{id}',[ArticleController::class,'destroy'])->name(('art.destroy'));
//user

        Route::get('user/index',[UserController::class,'index'])->name('user.index');
        Route::get('useredit/{id}',[UserController::class,'edit'])->name('user.edit');
        Route::get('create/user',[UserController::class,'create'])->name('create.user');
        Route::Post('user/store',[UserController::class,'store'])->name('user.store');
        Route::Post('userupdate/{id}',[UserController::class,'update'])->name('user.update');
        Route::get('userdelete/{id}',[UserController::class,'delete'])->name('user.delete');
 });

require __DIR__.'/auth.php';
