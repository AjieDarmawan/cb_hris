<?php
/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------
| Config Routes
|---------------------------------------------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|---------------------------------------------------------------------------------------------------------------------------------------------------------
*/
$prefix = 'unknow';
$modpath = 'unknow';

$path = app()->getConfigurationPath();
$xuri = @explode("?", $_SERVER['REQUEST_URI']);
$keys = @implode("/", array_slice( @explode("/", $xuri[0]) , 1, 2));
$route_conf = @json_decode(file_get_contents($path . DIRECTORY_SEPARATOR . 'app.json'), true);

if(isset($route_conf[$keys])) {
	$prefix = $keys;
	$modpath = @implode('\\', $route_conf[$keys]);
}
// rmprint($modpath);
define("PREFIX", $prefix);
define("MODPATH", $modpath);
/*--------------------------------------------------------------------------------------------------------------------------------------------------------*/



/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------
| Auth Routes
|---------------------------------------------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|---------------------------------------------------------------------------------------------------------------------------------------------------------
*/
$router->group(['prefix' => 'auth'], function () use ($router) 
{
	$router->post('login', 'Auth\AuthController@login');
	$router->group(['middleware' => 'auth'], function() use($router)
	{
		$router->get('menu', 'App\AppController@appmenu');
		
		$router->get('profile', 'Auth\AuthController@profile');
		$router->post('logout', 'Auth\AuthController@logout');
	});
});
/*--------------------------------------------------------------------------------------------------------------------------------------------------------*/



/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------
| Application Routes
|---------------------------------------------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|---------------------------------------------------------------------------------------------------------------------------------------------------------
*/
$router->group(['prefix'=> PREFIX], function() use($router)
{
	/* BUAT DARI FRONTEND TANPA LOGIN */
	$router->get('/', MODPATH . '@index');
	$router->get('/detail', MODPATH . '@detail');
	
	/* BUAT DARI BACKEND HARUS LOGIN */
	$router->group(['middleware' => 'auth'], function() use($router)
	{
		$router->get('/ls', MODPATH . '@listdata');
		
		$router->get('/sh/{seolink}', MODPATH . '@showdata');
		$router->post('/cr', MODPATH . '@createdata');
		$router->put('/up/{seolink}', MODPATH . '@updatedata');
		$router->delete('/rm/{seolink}', MODPATH . '@removedata');
		
		$router->get('/download', MODPATH . '@export');
	});
});
/*--------------------------------------------------------------------------------------------------------------------------------------------------------*/

$router->get('appinfo', 'App\AppController@index');