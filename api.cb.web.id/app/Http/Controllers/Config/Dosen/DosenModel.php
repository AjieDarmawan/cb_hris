<?php namespace App\Http\Controllers\Config\Dosen;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class DosenModel extends Model
{

	protected $table = MAINDB . ".userdata_dsn";
	
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