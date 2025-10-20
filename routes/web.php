<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

// Public routes - Redirect to login for direct access to the functional system
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'realTimeStats'])->name('dashboard.stats');
    Route::post('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');

    // Farmers Management
    Route::resource('farmers', FarmerController::class);
    Route::post('/farmers/{farmer}/verify', [FarmerController::class, 'verify'])->name('farmers.verify');
    Route::get('/farmers/{farmer}/transactions', [FarmerController::class, 'transactions'])->name('farmers.transactions');

    // Transactions Management
    Route::resource('transactions', TransactionController::class);
    Route::post('/transactions/{transaction}/complete', [TransactionController::class, 'complete'])->name('transactions.complete');
    Route::post('/transactions/{transaction}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::get('/farmers/{farmer}/quick-transaction', [TransactionController::class, 'quickCreate'])->name('transactions.quick-create');

    // Payments Management
    Route::resource('payments', PaymentController::class)->except(['edit', 'update']);
    Route::post('/payments/{payment}/process', [PaymentController::class, 'process'])->name('payments.process');
    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
    Route::post('/payments/{payment}/retry', [PaymentController::class, 'retry'])->name('payments.retry');
    Route::get('/payments-dashboard', [PaymentController::class, 'dashboard'])->name('payments.dashboard');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/transaction-summary', [ReportController::class, 'transactionSummary'])->name('reports.transaction-summary');
    Route::get('/reports/farmer-analytics', [ReportController::class, 'farmerAnalytics'])->name('reports.farmer-analytics');
    Route::get('/reports/payment-reconciliation', [ReportController::class, 'paymentReconciliation'])->name('reports.payment-reconciliation');
    Route::get('/reports/depot-performance', [ReportController::class, 'depotPerformance'])->name('reports.depot-performance');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    // Profile Management
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::patch('/profile', function () {
        return redirect()->route('profile.edit');
    })->name('profile.update');

});