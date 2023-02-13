<?php namespace App\Http\Controllers\Config\MataKuliah;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class MataKuliahModel extends Model
{

	protected $table = MAINDB . ".conf_datamk";
	
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