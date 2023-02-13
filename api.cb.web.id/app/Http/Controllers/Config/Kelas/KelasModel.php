<?php namespace App\Http\Controllers\Config\Kelas;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class KelasModel extends Model
{

	protected $table = MAINDB . ".conf_kelas";
	
	protected $dates = [];

	protected $fillable = [];

	protected $hidden = [];
	
	
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