<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Test route to verify database update functionality
Route::get('/test-db-update', function() {
    try {
        // Get current user
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Not authenticated']);
        }

        // Test database connection
        $dbTest = DB::select('SELECT 1 as test');
        
        // Test user table access
        $userCheck = DB::table('users')->where('id', $user->id)->first();
        
        // Test update operation
        $testUpdate = DB::table('users')
            ->where('id', $user->id)
            ->update(['updated_at' => now()]);

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'db_connection' => $dbTest,
            'user_exists' => $userCheck ? true : false,
            'update_test' => $testUpdate,
            'current_user_data' => $userCheck
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});
