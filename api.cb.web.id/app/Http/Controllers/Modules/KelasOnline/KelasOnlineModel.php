<?php namespace App\Http\Controllers\Modules\KelasOnline;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;


class KelasOnlineModel extends Model
{
	protected $table = MAINDB . '.lms_kelas';
	
	protected $dates = ['crdt', 'mddt'];

	protected $fillable = ['id'];

	protected $hidden = ['crdt', 'mddt'];
	
	
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