<?php

namespace Modules\Access\Entities\V1;

use Illuminate\Database\Eloquent\Model;
use Modules\Access\Entities\V1\Role;

class Access extends Model
{
    protected $table = 'accesses';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function roles()
    {
        return $this->belongsToMany('Modules\Access\Entities\V1\Role','roles_accesses');
    }
}
