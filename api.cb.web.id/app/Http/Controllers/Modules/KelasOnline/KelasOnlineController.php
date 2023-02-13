<?php namespace App\Http\Controllers\Modules\KelasOnline;

use DB; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Modules\KelasOnline\KelasOnlineModel as MainModel; // Modelnya


class KelasOnlineController extends Controller 
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
		if($dattable = $request->only('dataTablesParameters')) {
			$limit = $dattable['dataTablesParameters']['length'] !== null ? (int)$dattable['dataTablesParameters']['length'] : 10;
		} else {
			$limit = $request->input('length') !== null ? $request->input('length') : 10;
		}
		
		
		$tmp_whys = array();
		$use_whys = count($tmp_whys) > 0 ? (' AND '. @implode(' AND ', $tmp_whys)) : '';
		
		$sSQL = preg_replace('/(\t|\r|\n)+/', ' ', '		
			(
				SELECT * FROM 
				(
					SELECT a.*, b.namalengkap as namadosen, b.pict, c.namamk
					FROM
					(
						SELECT id,kodemk,kodedosen,judultopik, tglmulai, tglberakhir, maxtugas,pertemuan,statuskls
						FROM '. MAINDB .'.lms_kelas
						WHERE 1=1
							AND DATE_FORMAT(now(),"%Y-%m-%d") BETWEEN tglmulai AND tglberakhir 
							AND statuskls = "1"
							'. $use_whys .'
					) as a
					LEFT JOIN '. MAINDB .'.userdata_dsn as b
					ON a.kodedosen = b.kode
					LEFT JOIN '. MAINDB .'.conf_datamk as c
					ON a.kodemk = c.kodemk
				) as a
				GROUP BY a.id
				ORDER BY a.tglmulai DESC, a.pertemuan DESC
			) as a
		');
		$result = DB::table(DB::raw($sSQL))->select('*')->paginate($limit)->toArray();
		
		$no = $result['from'];
		$aktif = array('0' => 'Tidak', '1' => 'Ya');
		$smester = array('1' => 'Ganjil', '2' => 'Genap');
		
		foreach($result['data'] as $k => $v) {		
			@reset($aktif);
			@reset($smester);
		
			$resdata = array();
			$resdata['no'] = $no;
			$resdata['matkul']= $v->namamk;
			$resdata['pertemuan']= $v->pertemuan;
			$resdata['dari']= tanggal_indo($v->tglmulai, 'd M H:i');
			$resdata['hingga']= tanggal_indo($v->tglberakhir, 'd M H:i');
			$resdata['sisa']= selisih_waktu(date('Y-m-d'), $v->tglberakhir, 'd');
			
			$resdata['namadosen'] = ucwords(strtolower($v->namadosen));
			$resdata['dosenImg'] = env('FILE_URL') . 'profile/' . 'xs-' . $v->pict;
			$resdata['seolink'] = urlencode($v->namamk .'-pertemuan-'. $v->pertemuan.'-'.$resdata['dari'].'sd'.$resdata['hingga'].'-'.$resdata['namadosen'].'-'.sha1($v->id . date('Ymd')));
			
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
		
		$tmp_whys = array();
		$use_whys = count($tmp_whys) > 0 ? (' AND '. @implode(' AND ', $tmp_whys)) : '';
		
		$sSQL = preg_replace('/(\t|\r|\n)+/', ' ', '		
			(
				SELECT * FROM 
				(
					SELECT a.*, b.namalengkap as namadosen, b.pict, c.namamk
					FROM
					(
						SELECT id,kodemk,kodedosen,judultopik, tglmulai, tglberakhir, maxtugas,pertemuan,labelkelas,statuskls,totalmhs,modul,tugas,kuis,soalonline,konferens
						FROM '. MAINDB .'.lms_kelas
						WHERE 1=1
							'. $use_whys .'
					) as a
					LEFT JOIN '. MAINDB .'.userdata_dsn as b
					ON a.kodedosen = b.kode
					LEFT JOIN '. MAINDB .'.conf_datamk as c
					ON a.kodemk = c.kodemk
				) as a
				GROUP BY a.id
				ORDER BY a.tglmulai DESC, a.pertemuan DESC
			) as a
		');
		$result = DB::table(DB::raw($sSQL))->select('*')->paginate($limit)->toArray();
		
		$no = $result['from'];
		$aktif = array('0' => 'Tidak', '1' => 'Ya');
		$smester = array('1' => 'Ganjil', '2' => 'Genap');
		
		foreach($result['data'] as $k => $v) {		
			@reset($aktif);
			@reset($smester);
		
			$resdata = array();
			$resdata['no'] = $no;
			$resdata['kode'] = $v->kodemk;
			$resdata['matkul']= $v->namamk;
			$resdata['pertemuan']= $v->pertemuan;
			$resdata['topik']= $v->judultopik;
			$resdata['dari']= tanggal_indo($v->tglmulai, 'Y-m-d H:i');
			$resdata['hingga']= tanggal_indo($v->tglberakhir, 'Y-m-d H:i');
			$resdata['maxtugas']= tanggal_indo($v->maxtugas, 'Y-m-d H:i');
			$resdata['status']= $v->statuskls;
			
			$resdata['konferens'] = $v->konferens;
			$resdata['kodedosen']= $v->kodedosen;
			$resdata['namadosen'] = ucwords(strtolower($v->namadosen));
			$resdata['dosenImg'] = env('FILE_URL') . 'profile/' . 'xs-' . $v->pict;
			$resdata['seolink'] = sha1($v->id . date('Ymd'));
			
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