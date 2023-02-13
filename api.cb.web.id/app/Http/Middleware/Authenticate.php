<?php namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;


class Authenticate 
{

	public function handle($request, Closure $next) 
	{
		try {

			if (! $user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (TokenBlacklistedException $e) {

			return json_response('005', '', array());

		}catch (TokenExpiredException $e) {

			return json_response('003', '', array());

		} catch (TokenInvalidException $e) {

			return json_response('004', '', array());

		} catch (JWTException $e) {

			return json_response('006', '', array());

		}

		return $next($request);
	}
}
