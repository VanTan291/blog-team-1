<?php
/**
 * This is auth middleware using for authentication user
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;

class AuthenticateUser
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
        $authenticated = Auth::guard('api');

        if (!$authenticated->check()) {
            return abort(Response::HTTP_UNAUTHORIZED);
        }

        if ($authenticated->user()->status != UserStatus::ACTIVE) {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => __('auth.not_active'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
