<?php namespace App\Http\Controllers\Config\JadwalKuliah;

use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\JadwalKuliah\JadwalKuliahModel as MainModel;


class JadwalKuliahController extends Controller 
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
		// $tmp_whys[] = $request->input('kode') !== null ? 'a.kodemk=' . $request->input('kode') : '';
		// $tmp_whys[] = $request->input('nama') !== null ? 'a.namamk=' . $request->input('nama') : '';
		// $tmp_whys[] = $request->input('jurusan') !== null ? 'a.kodejrs=' . $request->input('jurusan') : '';
		// $tmp_whys[] = $request->input('semester') !== null ? 'a.semester=' . $request->input('semester') : '';
		// $tmp_whys[] = $request->input('is_active') !== null ? 'a.status=' . $request->input('status') : 'a.status=' .  '1';
		$tmp_whys[] = 'a.smtthnakd = (SELECT smtthnakd FROM '. MAINDB .'.conf_smtthnakd WHERE aktif=1)';
		
		$use_whys = count($tmp_whys) > 0 ? (' AND '. @implode(' AND ', array_filter($tmp_whys))) : '';
		/*--- END WHERE -----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		
		
		/*--- LIMIT ---------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		if($dattable = $request->only('dataTablesParameters')) 
		{
			$limit = $dattable['dataTablesParameters']['length'] !== null ? (int)$dattable['dataTablesParameters']['length'] : 10;
		} else {
			$limit = $request->input('length') !== null ? $request->input('length') : 10;
		}
		/*--- END LIMIT -----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		
		
		
		/*--- BUAT OPTION SELECT YANG BUTUH ID SAMA VALUE AJA ---------------------------------------------------------------------------------------------------------------------------*/
		if($request->input('type') !== null && $request->input('type') == 'slim') 
		{
			$select = 'a.kodemk, a.kodedosen';
			$sSQL = preg_replace('/(\t|\r|\n)+/', ' ', '		
				(
					SELECT '.$select.'
					FROM '. MAINDB .'.conf_datajadwal a
					WHERE 1=1
						AND smtthnakd = (SELECT smtthnakd FROM conf_smtthnakd WHERE aktif=1)
						'. $use_whys .'
				) as a
			');
			
			rmprint($sSQL);
			$result = DB::table(DB::raw($sSQL))->select('*')->paginate($limit)->toArray();
			
			foreach($result['data'] as $k => $v) 
			{
				$attr = array();
				$attr['cid'] = 'matkul';
				$attr['action'] = 'encrypt';
				$attr['secret'] = sha1(md5('matkullist'));
				$attr['data'] = json_encode(array('kode'=>$v->kodemk, 'nama'=>$v->namamk));
				$keys = rmcrypt($attr);

				$resdata = array();
				if($request->input('type') !== null && $request->input('type') == 'slim') 
				{	
					$resdata['id'] = $keys;
					$resdata['name']= $v->namamk;
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
					SELECT a.*, c.namalengkap, c.gelar_dpn, c.gelar_blkng, d.namamk, b.namajrs, c.pict
					FROM 
					(
						SELECT a.id, a.kodemk, a.kodejrs, a.kodedosen, a.kelas, a.ruang, a.hari, a.jam_mulai, a.jam_akhir, a.crdt, a.kodepk
						FROM '. MAINDB .'.conf_datajadwal a
						WHERE 1=1
							'. $use_whys .'
					) as a
					LEFT JOIN '. MAINDB .'.conf_datajrs b
					ON a.kodejrs = b.kodejrs
					LEFT JOIN '. MAINDB .'.userdata_dsn c
					ON a.kodedosen = c.kode
					LEFT JOIN '. MAINDB .'.conf_datamk d
					ON a.kodemk = d.kodemk
					WHERE 1=1
				) as a
			');
			$result = DB::table(DB::raw($sSQL))->select('*')->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC')->orderBy('kodedosen', 'ASC')->paginate($limit)->toArray();
			$no = $result['from'];
			
			foreach($result['data'] as $k => $v) 
			{
				$tmpdosen = array();
				$tmpdosen[] = $v->gelar_dpn;
				$tmpdosen[] = ucwords(strtolower($v->namalengkap));
				$tmpdosen[] = $v->gelar_blkng;
				$namadosen = @implode(" ", array_filter($tmpdosen));
				
				$resdata = array();
				$resdata['no'] = $no;
				$resdata['hari'] = $v->hari;
				$resdata['jam']= $v->jam_mulai .' - '. $v->jam_akhir;
				$resdata['program']= $v->kodepk;
				$resdata['jurusan']= $v->kodejrs .' - '. $v->namajrs;
				$resdata['matakuliah']= $v->kodemk .' - '. $v->namamk;
				$resdata['kelas']= $v->kelas;
				$resdata['dosen']= $namadosen;
				$resdata['ruang']= $v->ruang;
				$resdata['peserta']= 11;				
				$resdata['seolink'] = sha1($v->id . date('Ymd'));
				$resdata['dosenImg'] = env('FILE_URL') . 'profile/' . 'xs-' . $v->pict;
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
		$result = MainModel::select('jam_mulai', 'jam_akhir', 'hari', 'ruang', 'kelas')->whereRaw('sha1(CONCAT(id, DATE_FORMAT(NOW(), "%Y%m%d"))) = "'.$seolink.'"', )->get();
		return json_response('001', '', $result);
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
		/*-- DECODE MATKUL --*/
		$attr = array();
		$attr['cid'] = 'matkul';
		$attr['action'] = 'decrypt';
		$attr['secret'] = sha1(md5('matkullist'));
		$attr['data'] = $request->matakuliah;
		$datamatkul = json_decode(rmcrypt($attr), true);
		/*-- END DECODE MATKUL --*/
		
		/*-- DECODE DOSEN --*/
		$attr = array();
		$attr['cid'] = 'dosen';
		$attr['action'] = 'decrypt';
		$attr['secret'] = sha1(md5('dosenlist'));
		$attr['data'] = $request->dosen;
		$datadosen = json_decode(rmcrypt($attr), true);
		/*-- END DECODE DOSEN --*/
		
		
		$req = $request->input();
		$cusrsmt = $this->semester_aktif();
		$unikkey = $cusrsmt->smtthnakd . $req['kelas'] . $req['hari'] . $req['start'] . $datadosen['kode'] . $datamatkul['kode'];
		
		try 
		{ 
			$data = new MainModel();
			// $data->kodepk = $request->input('program');
			$data->kodedosen = $datadosen['kode'];
			$data->kodemk = $datamatkul['kode'];
			$data->kodejrs = $datamatkul['jurusan'];
			$data->kelas = $request->input('kelas');
			$data->ruang = $request->input('ruang');
			$data->hari = $request->input('hari');
			$data->jam_mulai = $request->input('start');
			$data->jam_akhir = $request->input('end');
			$data->smtthnakd = $cusrsmt->smtthnakd;
			$data->kurikulum = $datamatkul['kurikulum'];
			$data->status = 1;
			$data->crur = $this->userinfo('kode');
			$data->uniqkey = sha1($unikkey);
			$data->save();

			return json_response('001', 'Data berhasil disimpan', '');
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			$message = Str::of($ex->errorInfo[2])->after('for key');
			$message = Str::of($message)->replace("'", '');
			$message = ucfirst(trim($message));
			$message = 'Data';
			return query_response($ex->errorInfo[1], strval($message));
		}
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