<?php

namespace Modules\Access\Entities\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Access\Traits\RoleAccess;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use RoleAccess, HasApiTokens, Notifiable;
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'api_token',
        'email_verified_at',
        'password',
        'remember_token',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function personal()
    {
        return $this->hasOne('Modules\Personal\Entities\V1\Personal');
    }

    public function childs()
    {
        return $this->hasMany('Modules\Personal\Entities\V1\PersonalOrtu');
    }
}
