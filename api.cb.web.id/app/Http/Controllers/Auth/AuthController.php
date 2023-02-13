<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthConfig;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login','register']]);
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|string',
		]);

		if($validator->fails()){
			return response()->json($validator->errors()->toJson(), 400);
		}
		$credentials = $request->only('username', 'password');
		$credentials['acc_username'] = $credentials['username'];
		$credentials['password'] = md5($credentials['password']);
		unset($credentials['username']);
	
		try {
			
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => 'invalid_credentials'], 401);
			}
			
		} catch (JWTException $e) {dd($e);
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
		
		return response()->json($token);
	}
	
	public function logout()
    {
        auth()->logout(true);

        return response()->json(['message' => 'Successfully logged out']);
    }

	public function profile(Request $request)
	{
		return response()->json(['code' => '001', 'status' => 'success', 'listdata' => auth()->user()], 200);
	}
}