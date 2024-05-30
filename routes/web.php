<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobController;
use App\Http\Controllers\kpiController;
use App\Http\Controllers\cabangController;
use App\Http\Controllers\relateController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\FunctionsController;
use App\Http\Controllers\reviewJobController;
use App\Http\Controllers\LogSessionController;
use App\Http\Controllers\Admin\{adminController,dashboardController};

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

require __DIR__.'/auth.php';

Route::get('error-page', [dashboardController::class,'error'])->name('error');

Route::group(['middleware' => 'auth', 'PreventBackHistory'], function () {

    // dashboard
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/profile/{encryptedId}/edit' ,[profileController::class, 'index'])->name('profile.index');
    Route::put('/profile/password-update' ,[profileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::put('/profile/{id}' ,[profileController::class, 'update'])->name('profile.update');
    Route::patch('/review/{id}/job', [reviewJobController::class, 'saveReviewByJobIDREST']);
    Route::patch('/review/{id}/related', [reviewJobController::class, 'saveReviewByRelatedJobIDREST']);

    Route::middleware(['cekLevel'])->group( function(){

        // crud admin
        Route::resource('/admin', adminController::class);
        // crud cabang
        Route::resource('cabang', cabangController::class);
        //crud jabatan
        Route::resource('/jabatan', jabatanController::class);
        // log
        Route::resource('log', LogSessionController::class);
        //KPI
        Route::resource('kpi', kpiController::class);

    });

    // job
    Route::resource('job', jobController::class);
    Route::patch('/job/{id}/approval', [jobController::class, 'approvalByJobIDREST']);

    // relate
    Route::resource('relate', relateController::class);

    // Functions
    Route::resource('functions', FunctionsController::class);

    Route::get('/article/admin/{id}/related', [relateController::class, 'getDetailRelatedJobIDArticle'])->name('article.admin.related.getAdminDetailRelatedJobIDArticle');
    Route::get('/article/admin/related', [relateController::class, 'getAdminRelatedJobIdArticle'])->name('article.admin.related.getAdminRelatedJobIdArticle');

    Route::get('/article/job', [jobController::class, 'getJobByAdmin'])->name('job.getJobByAdmin');
    Route::get('/article/{id}/job', [jobController::class, 'getJobDetailIDByAdmin'])->name('job.getJobDetailIDByAdmin');
    Route::get('/article/job/position', [jobController::class, 'getJobByPosition'])->name('job.getJobByPosition');
    Route::get('/article/job/{id}/position', [jobController::class, 'getJobIDByPosition'])->name('job.getJobIDByPosition');

    Route::get('/article/related/position', [relateController::class, 'getPositionRelatedJobIDArticle'])->name('article.position.related.getPositionRelatedJobIDArticle');
    Route::get('/article/related/{id}/position', [relateController::class, 'getDetailPositionRelatedJobIDArticle'])->name('article.position.related.getDetailPositionRelatedJobIDArticle');

});

