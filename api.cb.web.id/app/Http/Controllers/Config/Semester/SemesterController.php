<?php namespace App\Http\Controllers\Modules\Config\Semester;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Modules\Config\Semester\SemesterModel as MainModel; // Modelnya


class SemesterController extends Controller 
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
        $this->middleware('auth:api', ['except' => ['index', 'detail']]);
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
	public function index(Request $request) 
	{
		return json_response('999', '', array());
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: GET DETAIL DATA [TANPA LOGIN]
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan detail data tanpa login
	|
	|	Parameter :
	|	- $seolink			array		[parameter terakhir pada url]
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function detail(Request $request, $seolink) 
	{
        return json_response('999', '', array());
    }
	
	

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: GET LIST DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan list data
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function listdata(Request $request) 
	{
		if($dattable = $request->only('dataTablesParameters')) {
			$limit = $dattable['dataTablesParameters']['length'] !== null ? (int)$dattable['dataTablesParameters']['length'] : 10;
		} else {
			$limit = $request->input('length') !== null ? $request->input('length') : 10;
		}
		$result = MainModel::select('id', 'str_smtthnakd', 'smt', 'thnakd', 'aktif')->paginate($limit)->toArray();
		
		
		$no = $result['from'];
		$aktif = array('0' => 'Tidak', '1' => 'Ya');
		$smester = array('1' => 'Ganjil', '2' => 'Genap');
		
		foreach($result['data'] as $k => $v) {		
			@reset($aktif);
			@reset($smester);
		
			$resdata = array();
			$resdata['no'] = $no;
			$resdata['label'] = $v['str_smtthnakd'];
			$resdata['semester'] = $smester[$v['smt']];
			$resdata['tahun'] = $v['thnakd'];
			$resdata['is_aktif'] = $aktif[$v['aktif']];
			$resdata['cid'] = sha1(md5($v['id'] . date('Ymd')));
			
			$no++;
			$result['data'][$k] = $resdata;
		}
		
		
		$dtResult = array();
		$dtResult['draw'] = $request->input('draw');
		$dtResult['recordsTotal'] = $result['total'];
		$dtResult['recordsFiltered'] = $result['total'];
		$dtResult['lastPage'] = $result['last_page'];
		$dtResult['data'] = $result['data'];
		
		return $this->json_response($dtResult);
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: GET DETAIL DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan detail data
	|
	|	Parameter :
	|	- $seolink			array		[parameter terakhir pada url]
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function showdata($seolink) 
	{
		$result = MainModel::where('id', $id)->get();
        return response($result);
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: CREATE DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menambah data baru
	|
	|	Parameter :
	|	- $post				array		[data post yang dibutuhkan seperti data perusahaan atau data lowker]
	|	- $encode			boolean		[apakah return di encode atau tidak, default tidak]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function createdata(Request $request) 
	{
		
		try { 

			$credentials['password'] = app('hash')->make(md5($credentials['password']));
			$user = AuthConfig::create($credentials);
			$token = JWTAuth::fromUser($user);

			return json_response('001', '', $token);

		} catch(\Illuminate\Database\QueryException $ex){ 

			$message = Str::of($ex->errorInfo[2])->after('for key');
			$message = Str::of($message)->replace("'", '');
			$message = ucfirst(trim($message));

			return query_response($ex->errorInfo[1], strval($message));
		}
		
		
		
		
		
		
		$data = new MainModel();
        // $data->activity = $request->input('activity');
        // $data->description = $request->input('description');
        $data->save();

        return response('Berhasil Tambah Data');
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: UPDATE DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk mengubah data
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function updatedata(Request $request) 
	{
		 $data = MainModel::where('id', $id)->first();
        // $data->activity = $request->input('activity');
        // $data->description = $request->input('description');
        $data->save();

        return response()->json([
			'error' => 'Email does not exist.'
		], 400);
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| :: DELETE DATA
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk mengambil data donation yang diperlukan
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------
	*/
	public function removedata(Request $request) 
	{
		 $data = MainModel::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Data');
	}
	
	
	

	
	public function import(Request $request) 
	{
		
	}
	
	public function export(Request $request) 
	{
		$formatfile = $request->only('format');
		$domTemplate = view('master_semester',['maindata'=>MainModel::all()]);
		
		if(isset($formatfile['format'])) {
			
			switch($formatfile['format']) {
			
				case "pdf":
				
					return PDF::loadHTML(view('dosen/data_dosen_pdf',['pegawai'=>$pegawai]))->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
					
				break;
				case "word":
				
					$phpWord =  new Word();
					$section = $phpWord->addSection();
					
					WordHtml::addHtml($section, $domTemplate, false, false);
					$objWriter = WordIOFactory::createWriter($phpWord, 'Word2007');

					try {
						$objWriter->save(public_path('helloWorld.docx'));
					} catch (Exception $e) {}
					
					return response()->download(public_path('helloWorld.docx'));
					
				break;
				case "excel":
				
					$pdf = PDF::loadHTML(view('dosen/data_dosen_pdf',['pegawai'=>$pegawai]))->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
					return $pdf->download('laporan-pegawai-pdf.pdf');	
					
				break;
			}
		}
		
		return false;
	}
	
	public function syncronize(Request $request) 
	{
		
	}
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*--- END ------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

}