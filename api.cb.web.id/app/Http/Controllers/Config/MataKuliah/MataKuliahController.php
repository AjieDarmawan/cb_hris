<?php namespace App\Http\Controllers\Config\MataKuliah;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\MataKuliah\MataKuliahModel as MainModel;


class MataKuliahController extends Controller 
{
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: GLOBAL CONFIG
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk setting awal sebelum modul dijalankan
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
    public function __construct(Request $request) 
	{
        $this->middleware('auth:api', ['except' => ['index', 'detail']]);
    }
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: GET LIST DATA [TANPA LOGIN]
	|-------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan list data tanpa login
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function index(Request $request) 
	{
		return json_response('999', '', array());
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: GET DETAIL DATA [TANPA LOGIN]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan detail data tanpa login
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|	- $seolink			array		[parameter terakhir pada url]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function detail(Request $request, $seolink) 
	{
        return json_response('999', '', array());
    }
	
	


	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: GET LIST DATA
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan list data [Harus Login]
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function listdata(Request $request) 
	{
		$aktif = array('0' => 'Tidak', '1' => 'Ya');
		$smester = array('1' => 'Ganjil', '2' => 'Genap');
		
		
		/*--- WHERE ---------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		$tmp_whys = array();
		$tmp_whys[] = $request->input('kode') !== null ? 'a.kodemk=' . $request->input('kode') : '';
		$tmp_whys[] = $request->input('nama') !== null ? 'a.namamk=' . $request->input('nama') : '';
		$tmp_whys[] = $request->input('jurusan') !== null ? 'a.kodejrs=' . $request->input('jurusan') : '';
		$tmp_whys[] = $request->input('semester') !== null ? 'a.semester=' . $request->input('semester') : '';
		$tmp_whys[] = $request->input('is_active') !== null ? 'a.aktif=' . $request->input('is_active') : 'a.aktif=' .  '1';
		
		$use_whys = count($tmp_whys) > 0 ? (' AND '. @implode(' AND ', array_filter($tmp_whys))) : '';
		/*--- END WHERE -----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		
		
		/*--- LIMIT ---------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		if($dattable = $request->only('dataTablesParameters')) {
			$limit = $dattable['dataTablesParameters']['length'] !== null ? (int)$dattable['dataTablesParameters']['length'] : 10;
		} else {
			$limit = $request->input('length') !== null ? $request->input('length') : 10;
		}
		/*--- END LIMIT -----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		
		
		
		/*--- BUAT OPTION SELECT YANG BUTUH ID SAMA VALUE AJA ---------------------------------------------------------------------------------------------------------------------------*/
		if($request->input('type') !== null && $request->input('type') == 'slim') 
		{
			$sSQL = preg_replace('/(\t|\r|\n)+/', ' ', '		
				(
					SELECT a.kodemk, a.namamk, a.kodejrs, a.kurikulum, b.namajrs
					FROM '. MAINDB .'.conf_datamk a
					LEFT JOIN '. MAINDB .'.conf_datajrs b
					ON a.kodejrs = b.kodejrs
					WHERE 1=1
						'. $use_whys .'
				) as a
			');
			$result = DB::table(DB::raw($sSQL))->select('*')->paginate($limit)->toArray();
			
			foreach($result['data'] as $k => $v) 
			{
				$attr = array();
				$attr['cid'] = 'matkul';
				$attr['action'] = 'encrypt';
				$attr['secret'] = sha1(md5('matkullist'));
				$attr['data'] = json_encode(array('kode'=>$v->kodemk, 'nama'=>$v->namamk, 'jurusan'=>$v->kodejrs, 'kurikulum'=>$v->kurikulum));
				$keys = rmcrypt($attr);

				$resdata = array();
				if($request->input('type') !== null && $request->input('type') == 'slim') 
				{	
					$indicator = $request->input('indicator') !== null && $request->input('indicator') == '1' ? ' ['.$v->namajrs.']' : '';
				
					$resdata['id'] = $keys;
					$resdata['name']= $v->kodemk .' - '. $v->namamk . $indicator;
				}
				$result['data'][$k] = $resdata;
			}
			$dtResult = array();
			$dtResult = $result['data'];
			return $this->json_response($dtResult);
		}
		/*--- END BUAT OPTION SELECT YANG BUTUH ID SAMA VALUE AJA -----------------------------------------------------------------------------------------------------------------------*/
		
		
		/*--- BUAT LIST BIASA -----------------------------------------------------------------------------------------------------------------------------------------------------------*/
		if($request->input('type') !== null && $request->input('type') == 'full') 
		{
			$sSQL = preg_replace('/(\t|\r|\n)+/', ' ', '		
				(
					SELECT a.id, a.kodemk, a.namamk, a.kodejrs, a.sks, a.semester, b.namajrs, a.crdt
					FROM '. MAINDB .'.conf_datamk a
					LEFT JOIN '. MAINDB .'.conf_datajrs b
					ON a.kodejrs = b.kodejrs
					WHERE 1=1
						'. $use_whys .'
				) as a
			');
			$result = DB::table(DB::raw($sSQL))->select('*')->paginate($limit)->toArray();
			$no = $result['from'];
			
			foreach($result['data'] as $k => $v) 
			{
				$resdata = array();
				$resdata['no'] = $no;
				$resdata['kode'] = $v->kodemk;
				$resdata['nama']= $v->namamk;
				$resdata['semester']= $v->semester;
				$resdata['jurusan']= $v->kodejrs .' - '. $v->namajrs;
				$resdata['sks']= $v->sks;
				$resdata['seolink'] = sha1($v->id . date('Ymd'));
				$resdata['lastupdate'] = tanggal_indo($v->crdt, 'Y-m-d H:i');
				
				$no++;
				$result['data'][$k] = $resdata;
			}
			$dtResult = array();
			$dtResult['sumdata']['currpage'] = $result['current_page'];
			$dtResult['sumdata']['itempage'] = $result['per_page'];
			$dtResult['sumdata']['totalpage'] = $result['last_page'];
			$dtResult['sumdata']['totalitem'] = $result['total'];
			$dtResult['detaildata'] = $result['data'];
			
			return $this->json_response($dtResult);
		}
		/*--- END BUAT LIST BIASA -------------------------------------------------------------------------------------------------------------------------------------------------------*/
		
		
		/*--- DEFAULT -------------------------*/
		return json_response('999', '', array());
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: GET DETAIL DATA
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menampilkan detail data [Harus Login]
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|	- $seolink			array		[parameter terakhir pada url]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function showdata(Request $request, $seolink) 
	{
		$result = MainModel::where('id', $seolink)->get();
        return response($result);
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: CREATE DATA
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menambah data baru [Harus Login]
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function createdata(Request $request) 
	{
		return $this->json_response($request);
		/*
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
		*/
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: UPDATE DATA
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk mengubah data [Harus Login]
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|	- $seolink			array		[parameter terakhir pada url]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function updatedata(Request $request, $seolink) 
	{
		 $data = MainModel::where('id', $seolink)->first();
        // $data->activity = $request->input('activity');
        // $data->description = $request->input('description');
        $data->save();

        return response()->json([
			'error' => 'Email does not exist.'
		], 400);
	}
	
	
	/*
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	| :: DELETE DATA
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	|	Fungsi :																			
	|	- Untuk menghapus data [Harus Login]
	|
	|	Parameter :
	|	- $request			array		[data request yang dikirimkan]
	|	- $seolink			array		[parameter terakhir pada url]
	|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	*/
	public function removedata(Request $request, $seolink) 
	{
		 $data = MainModel::where('id', $seolink)->first();
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