<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\VendorLoginController;
use App\Http\Controllers\Api\V1\Auth\VendorPasswordResetController;
use App\Http\Controllers\Api\V1\Vendor\VendorController;
use App\Http\Controllers\Api\V1\Vendor\ItemController;
use App\Http\Controllers\Api\V1\Vendor\OrderController;
use App\Http\Controllers\Api\V1\Vendor\CategoryController;
use App\Http\Controllers\Api\V1\Vendor\POSController;

/*
|--------------------------------------------------------------------------
| POS API Routes
|--------------------------------------------------------------------------
|
| Here are the API routes for the POS (Point of Sale) application.
| These routes are specifically designed for vendor/restaurant operations.
|
*/

Route::group(['prefix' => 'pos'], function () {
    
    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'auth'], function () {
        
        // Vendor Login
        Route::post('vendor/login', [VendorLoginController::class, 'login']);
        
        // Vendor Registration
        Route::post('vendor/register', [VendorLoginController::class, 'register']);
        
        // Password Reset Routes
        Route::post('vendor/forgot-password', [VendorPasswordResetController::class, 'reset_password_request']);
        Route::post('vendor/verify-token', [VendorPasswordResetController::class, 'verify_token']);
        Route::put('vendor/reset-password', [VendorPasswordResetController::class, 'reset_password_submit']);
        
        // Test route
        Route::get('test', function () {
            return response()->json([
                'message' => 'POS API is working',
                'timestamp' => now(),
                'version' => '1.0.0'
            ]);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Protected Vendor Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'vendor', 'middleware' => ['vendor.api']], function () {
        
        // Vendor Profile
        Route::get('profile', [VendorController::class, 'get_profile']);
        Route::put('profile', [VendorController::class, 'update_profile']);
        
        // Vendor Status
        Route::post('update-active-status', [VendorController::class, 'active_status']);
        
        // Notifications
        Route::get('notifications', [VendorController::class, 'get_notifications']);
        
        // FCM Token
        Route::put('update-fcm-token', [VendorController::class, 'update_fcm_token']);
        
        /*
        |--------------------------------------------------------------------------
        | Order Management
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'orders'], function () {
            
            // Get Orders by Status (using existing methods)
            Route::get('current', [VendorController::class, 'get_current_orders']);
            Route::get('completed', [VendorController::class, 'get_completed_orders']);
            Route::get('canceled', [VendorController::class, 'get_canceled_orders']);
            Route::get('all', [VendorController::class, 'get_all_orders']);
            
            // Order Details (using existing methods)
            Route::get('details', [VendorController::class, 'get_order_details']);
            Route::get('order', [VendorController::class, 'get_order']);
            
            // Order Status Management (using existing methods)
            Route::put('update-status', [VendorController::class, 'update_order_status']);
            Route::put('update-amount', [VendorController::class, 'edit_order_amount']);
            Route::put('send-otp', [VendorController::class, 'send_order_otp']);
        });

        /*
        |--------------------------------------------------------------------------
        | Item Management
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'items'], function () {
            
            // Get Items
            Route::get('list', [VendorController::class, 'get_items']);
            Route::get('search', [ItemController::class, 'search']);
            Route::get('reviews', [ItemController::class, 'reviews']);
            Route::get('organic', [ItemController::class, 'organic']);
            Route::get('recommended', [ItemController::class, 'recommended']);
            Route::get('pending', [ItemController::class, 'pending_item_list']);
            Route::get('stock-limit', [ItemController::class, 'stock_limit_list']);
            
            // Item Details
            Route::get('details/{id}', [ItemController::class, 'get_item']);
            Route::get('requested/{id}', [ItemController::class, 'requested_item_view']);
            
            // Item CRUD Operations
            Route::post('store', [ItemController::class, 'store']);
            Route::put('update', [ItemController::class, 'update']);
            Route::delete('delete', [ItemController::class, 'delete']);
            Route::put('status', [ItemController::class, 'status']);
            
            // Item Management
            Route::put('stock-update', [ItemController::class, 'stock_update']);
            Route::put('reply-update', [ItemController::class, 'update_reply']);
        });

        /*
        |--------------------------------------------------------------------------
        | Financial Management
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'financial'], function () {
            Route::get('earning-info', [VendorController::class, 'get_earning_data']);
            Route::get('withdraw-list', [VendorController::class, 'withdraw_list']);
            Route::post('request-withdraw', [VendorController::class, 'request_withdraw']);
            Route::put('update-bank-info', [VendorController::class, 'update_bank_info']);
        });

        /*
        |--------------------------------------------------------------------------
        | Wallet Management
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'wallet'], function () {
            Route::post('make-wallet-adjustment', [VendorController::class, 'make_wallet_adjustment']);
            Route::get('payment-list', [VendorController::class, 'wallet_payment_list']);
        });
    });
});
