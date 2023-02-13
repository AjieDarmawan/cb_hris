<?php

if (!function_exists('json_response')){
	
	function json_response($code, $message = '', $data = null) {
		
		$response = list_response();
		
		if((is_string($code) || is_integer($code)) && isset($response[$code])) {
			
			$resdata = $response[$code];
			$rescode = (int)$resdata['rescode'];
			
			if(is_string ($message) && $message <> '' && strlen($message) > 0) {
				$resdata['message'] = str_replace("_data_", $message, $resdata['message']);
			}
			$resdata['message'] = str_replace("_data_", '', $resdata['message']);
			$resdata['listdata'] = $data;
			
			unset($resdata['rescode']);
			
		} else {
			return response()->json($response['unknow'], 404);
		}
		
		
		if((is_array($resdata['listdata']) && count($resdata['listdata']) <= 0) || (is_String($resdata['listdata']) && strlen($resdata['listdata']) <= 0)) {
			unset($resdata['listdata']);
		}
		
		return response()->json($resdata, $rescode);
	}
}


if (!function_exists('query_response')) {
	
	function query_response($code, $message = '') 
	{
		$response = list_response();
		
		if((is_string($code) || is_integer($code)) && isset($response[$code])) {
			
			$resdata = $response[$code];
			$rescode = (int)$resdata['rescode'];
			
			if(is_string ($message) && $message <> '' && strlen($message) > 0) {
				$resdata['message'] = str_replace("_data_", $message, $resdata['message']);
			}
			$resdata['message'] = str_replace("_data_", '', $resdata['message']);
			
			unset($resdata['rescode']);
			
		} else {
			return response()->json($response['unknow'], 404);
		}
		
		return response()->json($resdata, $rescode);
	}
}


if (!function_exists('list_response')) {
	
	function list_response() 
	{
		return [
		
			/* Sukses */
			'001' => [
				'code' => '001',
				'status' => 'success',
				'rescode' => '200',
				'message' => '_data_.',
				'listdata' => array()
			],
			
			/* Token Expired */
			'002' => [
				'code' => '002',
				'status' => 'token_expired',
				'rescode' => '401',
				'message' => 'Waktu anda sudah habis, silakan login ulang.',
			],
			
			/* Token Refresh */
			'003' => [
				'code' => '003',
				'status' => 'token_expired_and_refreshed',
				'rescode' => '401',
				'message' => 'Akses diperbaharui.',
				'listdata' => array()
			],
			
			/* Token Salah */
			'004' => [
				'code' => '004',
				'status' => 'token_invalid',
				'rescode' => '401',
				'message' => 'Format yangdikirimkan tidak benar.',
			],
			
			/* Token Diblok */
			'005' => [
				'code' => '005',
				'status' => 'token_blacklisted',
				'rescode' => '500',
				'message' => 'Akses diblok.',
			],
			
			/* Token Tidak Ada */
			'006' => [
				'code' => '006',
				'status' => 'token_absent',
				'rescode' => '401',
				'message' => 'Format yangdikirimkan tidak benar.',
			],
			
			
			
			
			
			
			/* Duplikat insert data */
			'1062' => [
				'code' => '002',		
				'status' => 'duplicate',
				'rescode' => '403',
				'message' => '_data_ sudah pernah dibuat',
			],
			
			'unknow' => [
				'code' => '000',
				'status' => 'unknow',
				'message' => 'Error tidak diketahui',
			]
		];
	}
}



