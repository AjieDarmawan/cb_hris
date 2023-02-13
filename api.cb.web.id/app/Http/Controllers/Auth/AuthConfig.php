<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthConfig extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;
	
	protected $table =  'absen.acc_master';


	protected $dates = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acc_username', 'acc_img', 'acc_log_tgl', 'acc_log_jam', 'kar_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'acc_password', 'acc_pass_eslip'
    ];
    
	
	public function setDateAttribute( $value ) 
	{
	  $this->attributes['date'] = (new Carbon($value))->format('d/m/y');
	}
	
	public function getCreatedAtColumn() 
	{
		return 'crdt';
	}
	
	public function getUpdatedAtColumn() 
	{
		return 'mddt';
	}
	
	public function getAuthPassword() 
	{
		return app('hash')->make($this->acc_md5);
	}
	
	
	
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
