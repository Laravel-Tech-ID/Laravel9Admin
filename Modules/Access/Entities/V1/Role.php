<?php

namespace Modules\Access\Entities\V1;

use Illuminate\Database\Eloquent\Model;
use Modules\Access\Entities\V1\Access;
use Arr;

class Role extends Model
{

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public $incrementing = false;

    public function hasAccesses(... $accesses)
    {
        foreach($accesses as $access){
            if($this->accesses->contains('name', $access)){
                return true;
            }
        }
        return false;
    }

    public function hasAccess(... $accesses)
    {
        foreach($accesses as $access){
            if($this->accesses->contains(function($val, $key) use($access){
                return $val->name == $access && $val->status == 'Active';
            }))
            {
                return true;
            }
        }
        return false;
    }

    public function assignAccess(... $accesses)
    {
        $accesses = $this->checkAccesses(Arr::flatten($accesses));
        if($accesses === null){
            return $this;
        }
        return $this->accesses()->saveMany($accesses);
    }

    public function assignAccesses(... $accesses)
    {
        $accesses = $this->checkAccesses(Arr::flatten($accesses));
        if($accesses === null){
            return $this;
        }
        return $this->accesses()->saveMany($accesses);
    }

    public function revokeAccess(... $accesses)
    {
        $accesses = $this->checkAccesses(Arr::flatten($accesses));
        return $this->accesses()->detach($accesses);
    }

    public function revokeAccesses(... $accesses)
    {
        $accesses = $this->checkAccesses(Arr::flatten($accesses));
        return $this->accesses()->detach($accesses);
    }

    public function refreshAccess(... $accesses)
    {
        $this->accesses()->detach();
        return $this->assignAccess($accesses);
    }

    public function refreshAccesses(... $accesses)
    {
        $this->accesses()->detach();
        return $this->assignAccess($accesses);
    }

    protected function checkAccesses(array $accesses)
    {
        return Access::whereIn('name', $accesses)->get();
    }

    public function accesses()
    {
        return $this->belongsToMany('Modules\Access\Entities\V1\Access','roles_accesses');
    }
}
