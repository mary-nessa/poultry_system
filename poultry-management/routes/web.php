<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HenStockController;
use App\Http\Controllers\EggSaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\EggCollectionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard: Redirect users based on their role

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
});


// ✅ Admin Routes (Full Access)
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('branches', BranchController::class);
});

// ✅ Expenses Routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});

Route::middleware(['auth', RoleMiddleware::class . ':manager|worker|admin'])->group(function () {
    Route::resource('expenses', ExpenseController::class)->except(['destroy']);
});


Route::middleware(['auth', RoleMiddleware::class . ':admin|manager|worker'])->group(function () {
    Route::resource('henstocks', HenStockController::class)->except(['destroy']);
});



Route::middleware(['auth', RoleMiddleware::class . ':admin|manager|worker'])->group(function () {
    Route::resource('eggcollections', EggCollectionController::class)->except(['destroy']);
});


Route::middleware(['auth', RoleMiddleware::class . ':admin|manager|worker'])->group(function () {
    Route::resource('eggsales', EggSaleController::class)->except(['destroy']);
    Route::get('/eggsales/report', [EggSaleController::class, 'report'])->name('eggsales.report');
});



// ✅ Expense Reports (Main Page & Graphs)
Route::middleware(['auth', RoleMiddleware::class . ':admin|manager|worker'])->group(function () {
    Route::get('/expense-reports', [ExpenseReportController::class, 'index'])->name('expense-reports.index'); // ✅ Main Reports Page
    Route::get('/expense-reports/graphs', [ExpenseReportController::class, 'showGraphs'])->name('expense-reports.graphs'); // ✅ Graphs
    Route::get('/expense-reports/export/excel', [ExpenseReportController::class, 'exportExcel'])->name('expense-reports.export.excel');
    Route::get('/expense-reports/export/pdf', [ExpenseReportController::class, 'exportPdf'])->name('expense-reports.export.pdf');
});

// ✅ Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Authentication Routes
require __DIR__.'/auth.php';

// ✅ Logout Route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');
