<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();

        } catch (TokenExpiredException $e) {

            if ($request->is('api/refresh')) {
                return $next($request);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'Token expired'
            ], 401);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => 'error',
                'message' => 'Token invalid'
            ], 401);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => 'error',
                'message' => 'Token not provided'
            ], 401);
        }

        return $next($request);
    }
}
