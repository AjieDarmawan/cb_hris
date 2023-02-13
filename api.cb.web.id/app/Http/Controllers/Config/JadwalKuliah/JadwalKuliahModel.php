<?php namespace App\Http\Controllers\Config\JadwalKuliah;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class JadwalKuliahModel extends Model
{

	protected $table = MAINDB . ".conf_datajadwal";
	
	protected $dates = ['crdt', 'mddt', 'syndate'];

	protected $fillable = [];

	protected $hidden = ['crdt', 'mddt', 'syndate'];
	
	
	public function setDateAttribute( $value ) {
		$this->attributes['date'] = (new Carbon($value))->format('Y-m-d H:i:s');
	}

	public function getCreatedAtColumn() {
		return 'crdt';
	}

	public function getUpdatedAtColumn() {
		return 'mddt';
	}
}