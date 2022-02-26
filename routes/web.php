<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;

Route::get('/', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/templates/{id}/{bodyJson?}', [TemplateController::class, 'show'])->name('template-show');

Route::post('create-template', [TemplateController::class, 'CreateTemplate'])->name('create-template');


Route::get('edit-template/{template}',[TemplateController::class, 'edit'])->name('edit-template');

Route::post('update-template/{id}',[TemplateController::class, 'update'])->name('update-template');

Route::get('template/export/{planilla}',[TemplateController::class, 'export'])->name('template.export');



Route::middleware(['auth'])->group(function () {
    // ! rutas resources de acceso rapido a tablas//
    Route::get('index-template',[TemplateController::class, 'index'])->name('index-template');

});
