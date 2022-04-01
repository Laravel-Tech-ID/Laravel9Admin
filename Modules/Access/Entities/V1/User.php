<?php

namespace Modules\Access\Entities\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Access\Traits\RoleAccess;

class User extends Authenticatable
{

    use RoleAccess;
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

    public function personal()
    {
        return $this->hasOne('Modules\Personal\Entities\V1\Personal');
    }

    public function childs()
    {
        return $this->hasMany('Modules\Personal\Entities\V1\PersonalOrtu');
    }
}
