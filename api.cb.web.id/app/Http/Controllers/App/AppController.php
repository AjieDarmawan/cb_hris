<?php namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller 
{
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: GET GLOBAL DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk setting awal sebelum modul dijalankan
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
    public function __construct(Request $request) 
	{
        $this->middleware('auth:api', ['except' => ['index']]);
    }
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: GET LIST DATA [TANPA LOGIN]
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan list data tanpa login
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function index() 
	{
		$key = sha1(date('YmdHis'));
		$key1 = substr($key, 0, 20);
		$key2 = substr($key, -20);
		$appinfo = @explode("=", base64_encode(json_encode(APPINFO)));

		return count(APPINFO) > 0 ? response()->json($key2 . @implode("", $appinfo) . $key1, 200) : response()->json(null, 200);
	}
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*--- END ------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
}