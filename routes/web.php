<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Clear all cache
    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->back()->with(['msg' => 'Cache Cleared', 'type' => 'success']);
    });

    // Items
    Route::get('items', [\App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
    Route::get('items/create', [\App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
    Route::post('items', [\App\Http\Controllers\ItemController::class, 'store'])->name('items.store');
    Route::get('items/{id}/edit', [\App\Http\Controllers\ItemController::class, 'edit'])->name('items.edit');
    Route::put('items/{id}', [\App\Http\Controllers\ItemController::class, 'update'])->name('items.update');
    Route::delete('items/{id}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('items.destroy');

    // Suppliers
    Route::get('suppliers', [\App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [\App\Http\Controllers\SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers', [\App\Http\Controllers\SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{id}/edit', [\App\Http\Controllers\SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{id}', [\App\Http\Controllers\SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{id}', [\App\Http\Controllers\SupplierController::class, 'destroy'])->name('suppliers.destroy');


    // Excel file process
    Route::get('excelProcess', [\App\Http\Controllers\ExcelController::class, 'start'])->name('excelProcess.start');

    // Update items
    Route::get('run', [\App\Http\Controllers\API\UpdateItemController::class, 'run'])->name('updateItem.run');
    Route::get('importSKUsfromSkuVault', [\App\Http\Controllers\API\UpdateItemController::class, 'importSKUsfromSkuVault']);
    Route::get('importSKUsfromAmazon', [\App\Http\Controllers\API\UpdateItemController::class, 'importSKUsfromAmazon']);
    Route::get('importSkuVaultSuppliers', [\App\Http\Controllers\API\UpdateItemController::class, 'importSkuVaultSuppliers']);
    Route::get('addASINsfromAmazon', [\App\Http\Controllers\API\UpdateItemController::class, 'addASINsfromAmazon']);
    Route::get('check', [\App\Http\Controllers\API\UpdateItemController::class, 'check'])->name('check');
    Route::get('finalCheck', [\App\Http\Controllers\API\UpdateItemController::class, 'finalCheck']);
    Route::get('poCheck', [\App\Http\Controllers\API\UpdateItemController::class, 'poCheck']);


    Route::get('/updateItemsTaskStart', function () {
        //Run this job in the background and continue
        \App\Jobs\UpdateItems::dispatch( Auth::user() );
        //Artisan::call('queue:listen --timeout=0');
        //After job is started/Queued return view
        return redirect()->route('items.index')->with(['msg' => 'Task will run in the background very soon', 'type' => 'success']);
    })->name('updateItemsTaskStart');


    Route::post('/markAsRead', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('markAsRead');

});
