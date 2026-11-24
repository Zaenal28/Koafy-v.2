<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

// =========================================================================
// 1. AUTENTIKASI JWT (CUSTOMER & ADMIN GMAIL)
// =========================================================================
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/auth/me', [AuthController::class, 'me']);

// =========================================================================
// 2. DATA USER & DATA ALAMAT CUSTOMER
// =========================================================================
Route::put('/customer/profile', [AuthController::class, 'updateProfile']);
Route::get('/customer/addresses', [AuthController::class, 'getAddresses']);
Route::post('/customer/addresses', [AuthController::class, 'storeAddress']);
Route::put('/customer/addresses/{id}', [AuthController::class, 'updateAddress']);
Route::delete('/customer/addresses/{id}', [AuthController::class, 'deleteAddress']);

// =========================================================================
// 3. DATABASE DATA BARANG & VARIAN SHADE
// =========================================================================
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::put('/admin/products/{id}', [ProductController::class, 'update']);
Route::patch('/admin/products/{id}/toggle-status', [ProductController::class, 'toggleStatus']);
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);

// =========================================================================
// 4. DATABASE TRANSAKSI, DETAIL TRANSAKSI, SLIP RESI & PENGIRIMAN MANUAL
// =========================================================================
Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::post('/transactions/{idOrInvoice}/upload-proof', [TransactionController::class, 'uploadTransferProof']);

Route::put('/admin/transactions/{id}/payment-status', [TransactionController::class, 'updatePaymentStatus']);
Route::put('/admin/transactions/{id}/shipment', [TransactionController::class, 'updateShipment']);
Route::post('/admin/transactions/notifications/read', [TransactionController::class, 'markNotificationRead']);
Route::get('/admin/customers', [TransactionController::class, 'customers']);
