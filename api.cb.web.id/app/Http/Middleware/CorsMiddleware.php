<?php namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
   
    public function handle($request, Closure $next)
    {
		$pathconf = app()->getConfigurationPath();
		
		
		/*--- CEK ORIGIN ------------------------------*/
		if($client = app('request')->server('HTTP_ORIGIN')) 
		{
			/*--- KALO ADA ORIGINNYA -------------------------*/
			$client = @explode(".", str_replace("www.", "", parse_url($client, PHP_URL_HOST)));
			$client_conf = @json_decode(file_get_contents($pathconf . DIRECTORY_SEPARATOR . 'conf_app.json'), true);
			
			if(count($client_conf) > 0 && isset($client_conf['app']['is_active']) && ($client_conf['app']['is_active'])) 
			{	
				/*--- LANJUT KALO ADA ----------------*/
			} 
			else 
			{
				return json_response('999', '', array());
			}
		} 
		else 
		{
			/*--- KALO GA ADA ORIGINNYA CEK IPNYA -------------------------*/
			$userip = preg_replace("/[^0-9.]/", "", app('request')->ip());
			$allowedip = @json_decode(file_get_contents($pathconf . DIRECTORY_SEPARATOR . 'conf_acc.json'), true);
		
			if(isset($userip, $allowedip)) 
			{
				/*--- KALO IPNYA DI ALLOW CEK PARAMETER DEFAULT -----------------------*/
				// if(app('request')->input('cid') !== null && app('request')->input('ccid') !== null) 
				// {
					/*--- KALO ADA PARAMETER WAJIBNYA -----------------------*/
					$client_conf = @json_decode(file_get_contents($pathconf . DIRECTORY_SEPARATOR . 'conf_app.json'), true);
					
					if(is_array($client_conf) && count($client_conf) > 0 && isset($client_conf['app']['is_active']) && ($client_conf['app']['is_active'])) 
					{
						/*--- LANJUT KALO ADA ----------------*/ 
					}
					else
					{
						return json_response('999', '', array());
					}
				// } 
				// else
				// {
					/*--- KALO GA ADA PARAMETER WAJIBNYA -----------------------*/
					// return json_response('999', '', array());
				// }
			}
			else
			{
				/*--- KALO IPNYA GA DI ALLOW -----------------------*/
				return json_response('999', '', array());
			}
		}
		
		
		
		$headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }
		
        return $response;
    }
}