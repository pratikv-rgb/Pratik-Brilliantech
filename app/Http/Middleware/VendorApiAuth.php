<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorEmployee;

class VendorApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'errors' => [
                    ['code' => 'auth-001', 'message' => 'Token not provided']
                ]
            ], 401);
        }

        // Check for vendor owner
        $vendor = Vendor::where('auth_token', $token)->first();
        if ($vendor) {
            // Set the authenticated vendor in the request
            $request->merge(['authenticated_vendor' => $vendor]);
            $request->merge(['vendor_type' => 'owner']);
            return $next($request);
        }

        // Check for vendor employee
        $vendorEmployee = VendorEmployee::where('auth_token', $token)->first();
        if ($vendorEmployee) {
            // Set the authenticated vendor employee in the request
            $request->merge(['authenticated_vendor' => $vendorEmployee]);
            $request->merge(['vendor_type' => 'employee']);
            return $next($request);
        }

        return response()->json([
            'errors' => [
                ['code' => 'auth-001', 'message' => 'Invalid token']
            ]
        ], 401);
    }
}
