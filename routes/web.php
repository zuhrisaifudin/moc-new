<?php

use App\Http\Controllers\Central\Authentication\ModuleController;
use App\Http\Controllers\Central\Authentication\UserController;
use App\Http\Controllers\Central\Authentication\PermissionController;
use App\Http\Controllers\Central\Authentication\RoleController;
use App\Http\Controllers\Central\Master\StagesController;
use App\Http\Controllers\Central\Master\CriteriaController;
use App\Http\Controllers\Central\Master\DescriptionChangeController;
use App\Http\Controllers\Central\Master\RegionsController; 
use App\Http\Controllers\Central\Master\DistrictController;
use App\Http\Controllers\Central\Transaction\MocRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
Route::get('index/{locale}',[App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/districts-by-region/{region}', [MocRequestController::class, 'byRegion']);



Route::get('/maps', function () {
    return view('maps');
})->name('maps.index');


Route::middleware(['auth', 'is_active'])->group(function (){

    Route::prefix('permohonan')->group(function () {
        Route::get('/', [MocRequestController::class, 'index'])->name('central-moc-request-index');
        Route::post('/ajax/get-moc-request', [MocRequestController::class,'getAllMocRequest'])->name('central-get-moc-request-ajax');
        Route::get('/create', [MocRequestController::class, 'create'])->name('central-moc-request-create-pages');
        Route::post('/tambah', [MocRequestController::class, 'store'])->name('central-moc-request-add');
        Route::get('/show/{id}', [MocRequestController::class, 'getById'])->name('central-moc-request-edit-pages');
        Route::get('/ajax/delete-moc-request/{id}', [MocRequestController::class, 'onDeleteMocRequest'])->name('central-delete-moc-request-ajax');

        Route::get('/ajax/detail-user/{id}', [MocRequestController::class, 'onDetailMapsMocRequest'])->name('central-detail-maps-moc-request-ajax');
    });



    Route::prefix('/authentication')->group(function() {

        Route::prefix('/user')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('central-user-page');
            Route::post('/ajax/get-user', [UserController::class,'getAllUser'])->name('central-get-user-ajax');
            Route::get('/ajax/detail-user/{id}', [UserController::class, 'onDetailUser'])->name('central-detail-user-ajax');
            Route::post('/ajax/edit-user/{id}', [UserController::class, 'updateUser'])->name('central-edit-user-ajax');
            Route::get('/ajax/delete-user/{id}', [UserController::class, 'onDeleteUser'])->name('central-delete-user-ajax');
            Route::prefix('/detail')->group(function() {
                Route::get('/{id}', [UserController::class, 'indexDetailUser'])->name('central-edit-user-page');
                Route::post('/detach-permission/{role_id}',[UserController::class, 'detachPermission'])->name('central-permission-user-detach');
                Route::post('/attach-permission/{role_id}', [UserController::class, 'attachPermission'])->name('central-permission-user-attach');
            });
            Route::prefix('/role')->group(function() {
                Route::get('/ajax/add-role-user/{id}', [UserController::class, 'onDetailUserRole'])->name('central-detail-user-role--ajax');
                Route::post('/user/attach-role/{user_id}', [UserController::class, 'attachRole'])->name('central-role-user-attach');
                Route::post('/user/detach-role/{user_id}', [UserController::class, 'detachRole'])->name('central-role-user-detach');            
            });
        });

        Route::prefix('/module')->group(function() {
            Route::get('/', [ModuleController::class, 'index'])->name('central-module-page');
            Route::post('/ajax/get-module', [ModuleController::class,'getAllModule'])->name('central-get-module-ajax');
            Route::get('/ajax/detail-module/{id}', [ModuleController::class, 'onDetailModule'])->name('central-detail-module-ajax');
            Route::get('/ajax/show-module/{id}', [ModuleController::class, 'onShowModule'])->name('central-show-module-ajax');
            Route::post('/ajax/edit-module/{id}', [ModuleController::class, 'onEditModule'])->name('central-edit-module-ajax');
        });

        Route::prefix('/permission')->group(function() {
            Route::get('/', [PermissionController::class, 'index'])->name('central-permission-page');
            Route::post('/ajax/get-permission', [PermissionController::class,'getAllPermission'])->name('central-get-permission-ajax');
            Route::post('/ajax/add-permission', [PermissionController::class, 'addPermission'])->name('central-add-permission-ajax');
            Route::get('/ajax/detail-permission/{id}', [PermissionController::class, 'onDetailPermission'])->name('central-detail-permission-ajax');
            Route::post('/ajax/edit-permission/{id}', [PermissionController::class, 'updatePermission'])->name('central-edit-permission-ajax');
            Route::get('/ajax/delete-permission/{id}', [PermissionController::class, 'onDeletePermission'])->name('central-delete-permission-ajax');
        });

        Route::prefix('/role')->group(function() {
            Route::get('/', [RoleController::class, 'index'])->name('central-role-page');
            Route::post('/ajax/get-role', [RoleController::class,'getAllRole'])->name('central-get-role-ajax');
            Route::post('/ajax/add-role', [RoleController::class, 'addRole'])->name('central-add-role-ajax');
            Route::get('/ajax/detail-role/{id}', [RoleController::class, 'onDetailRole'])->name('central-detail-role-ajax');
            Route::post('/ajax/edit-role/{id}', [RoleController::class, 'updateRole'])->name('central-edit-role-ajax');
            Route::get('/ajax/delete-role/{id}', [RoleController::class, 'onDeleteRole'])->name('central-delete-role-ajax');
            Route::prefix('/detail')->group(function() {
                Route::get('/{id}', [RoleController::class, 'indexDetailRole'])->name('central-edit-role-page');
                Route::post('/detach-permission/{role_id}',[RoleController::class, 'detachPermission'])->name('central-permission-detach');
                Route::post('/attach-permission/{role_id}', [RoleController::class, 'attachPermission'])->name('central-permission-attach');
            });
        });

    });

    Route::prefix('/master')->group(function() {

        Route::prefix('/tahapan-perubahan')->group(function() {
            Route::get('/', [StagesController::class, 'index'])->name('central-stages-page');
            Route::post('/ajax/get-stages', [StagesController::class,'getAllStages'])->name('central-get-stages-ajax');
            Route::post('/ajax/add-stages', [StagesController::class, 'addStages'])->name('central-add-stages-ajax');
            Route::get('/ajax/detail-stages/{id}', [StagesController::class, 'onDetailStages'])->name('central-detail-stages-ajax');
            Route::post('/ajax/edit-stages/{id}', [StagesController::class, 'updateStages'])->name('central-edit-stages-ajax');
            Route::get('/ajax/delete-stages/{id}', [StagesController::class, 'onDeleteStages'])->name('central-delete-stages-ajax');
        });

        Route::prefix('/kriteria-perubahan')->group(function() {
            Route::get('/', [CriteriaController::class, 'index'])->name('central-criteria-page');
            Route::post('/ajax/get-criteria', [CriteriaController::class,'getAllCriteria'])->name('central-get-criteria-ajax');
            Route::post('/ajax/add-criteria', [CriteriaController::class, 'addCriteria'])->name('central-add-criteria-ajax');
            Route::get('/ajax/detail-criteria/{id}', [CriteriaController::class, 'onDetailCriteria'])->name('central-detail-criteria-ajax');
            Route::post('/ajax/edit-criteria/{id}', [CriteriaController::class, 'updateCriteria'])->name('central-edit-criteria-ajax');
            Route::get('/ajax/delete-criteria/{id}', [CriteriaController::class, 'onDeleteCriteria'])->name('central-delete-criteria-ajax');
        });

        Route::prefix('/deskripsi-perubahan')->group(function() {
            Route::get('/', [DescriptionChangeController::class, 'index'])->name('central-description-change-page');
            Route::post('/ajax/get-description-change', [DescriptionChangeController::class,'getAllDescriptionChange'])->name('central-get-description-change-ajax');
            Route::post('/ajax/add-description-change', [DescriptionChangeController::class, 'addDescriptionChange'])->name('central-add-description-change-ajax');
            Route::get('/ajax/detail-description-change/{id}', [DescriptionChangeController::class, 'onDetailDescriptionChange'])->name('central-detail-description-change-ajax');
            Route::post('/ajax/edit-description-change/{id}', [DescriptionChangeController::class, 'updateDescriptionChange'])->name('central-edit-description-change-ajax');
            Route::get('/ajax/delete-description-change/{id}', [DescriptionChangeController::class, 'onDeleteDescriptionChange'])->name('central-delete-description-change-ajax');
        });

        Route::prefix('/wilayah')->group(function() {
            Route::get('/', [RegionsController::class, 'index'])->name('central-region-page');
            Route::post('/ajax/get-region', [RegionsController::class,'getAllRegion'])->name('central-get-region-ajax');
            Route::post('/ajax/add-region', [RegionsController::class, 'addRegion'])->name('central-add-region-ajax');
            Route::get('/ajax/detail-region/{id}', [RegionsController::class, 'onDetailRegion'])->name('central-detail-region-ajax');
            Route::post('/ajax/edit-region/{id}', [RegionsController::class, 'updateRegion'])->name('central-edit-region-ajax');
            Route::get('/ajax/delete-region/{id}', [RegionsController::class, 'onDeleteRegion'])->name('central-delete-region-ajax');
        });

        Route::prefix('/area')->group(function() {
            Route::get('/', [DistrictController::class, 'index'])->name('central-district-page');
            Route::post('/ajax/get-district', [DistrictController::class,'getAllDistrict'])->name('central-get-district-ajax');
            Route::post('/ajax/add-district', [DistrictController::class, 'addDistrict'])->name('central-add-district-ajax');
            Route::get('/ajax/detail-district/{id}', [DistrictController::class, 'onDetailDistrict'])->name('central-detail-district-ajax');
            Route::post('/ajax/edit-district/{id}', [DistrictController::class, 'updateDistrict'])->name('central-edit-district-ajax');
            Route::get('/ajax/delete-district/{id}', [DistrictController::class, 'onDeleteDistrict'])->name('central-delete-district-ajax');
        });

    });

});
