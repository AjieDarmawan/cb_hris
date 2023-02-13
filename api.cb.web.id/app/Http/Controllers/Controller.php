<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;

use PhpOffice\PhpWord\PhpWord as Word;
use PhpOffice\PhpWord\Shared\Html as WordHtml;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;


class Controller extends BaseController
{
	public function json_response($param = array()) 
	{
		return $param;
	}
	
	public function userinfo($key) 
	{
		$userinfo = auth()->user();
		return isset($userinfo[$key]) ? $userinfo[$key] : null;
	}
}
