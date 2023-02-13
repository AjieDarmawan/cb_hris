<?php namespace App\Http\Controllers\Modules\Config\Semester;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class SemesterModel extends Model
{

	protected $table = MAINAPP . ".conf_smtthnakd";
	
	protected $dates = ['crdt', 'mddt', 'syndate'];

	protected $fillable = ['id','smt','thnakd'];

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