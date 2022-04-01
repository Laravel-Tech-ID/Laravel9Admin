<?php

namespace Modules\Access\Traits;
use Modules\Access\Entities\V1\Role;
use Modules\Access\Entities\V1\Access;
use Arr;

trait RoleAccess
{
    public function hasRole(... $roles)
    {
        foreach($roles as $role){
            if($this->roles->contains(function($val,$key) use($role){
                    return $val->name == $role && $val->status == 'Active';
            }))
            {
                return true;
            }
        }
        return false;
    }

    public function hasRoles(... $roles)
    {
        foreach($roles as $role){
            if($this->roles->contains(function($val,$key) use($role){
                return $val->name == $role && $val->status == 'Active';
            }))
            {
                return true;
            }
        }
        return false;
    }

    public function assignRole(... $roles)
    {
        $roles = $this->checkRoles(Arr::flatten($roles));
        if($roles === null){
            return $this;
        }
        return $this->roles()->saveMany($roles);
    }

    public function assignRoles(... $roles)
    {
        $roles = $this->checkRoles(Arr::flatten($roles));
        if($roles === null){
            return $this;
        }
        return $this->roles()->saveMany($roles);
    }

    public function revokeRole(... $roles)
    {
        $roles = $this->checkRoles(Arr::flatten($roles));
        return $this->roles()->detach($roles);
    }

    public function revokeRoles(... $roles)
    {
        $roles = $this->checkRoles(Arr::flatten($roles));
        return $this->roles()->detach($roles);
    }

    public function refreshRole(... $roles)
    {
        $this->roles()->detach();
        return $this->assignRole($roles);
    }

    public function refreshRoles(... $roles)
    {
        $this->roles()->detach();
        return $this->assignRole($roles);
    }

    protected function checkRoles(array $roles)
    {
        return Role::whereIn('name', $roles)->get();
    }

    public function hasAccess(... $accesses)
    {
        return $this->hasAccessTo(Arr::flatten($accesses)) || $this->hasRoleAccess(Arr::flatten($accesses));
    }

    public function hasAccesses(... $accesses)
    {
        return $this->hasAccessTo(Arr::flatten($accesses)) || $this->hasRoleAccess(Arr::flatten($accesses));
    }

    public function hasAccessTo(array $accesses)
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

    public function hasRoleAccess(array $accesses)
    {
        foreach($this->roles as $role){
            foreach($accesses as $access){
                if($role->accesses->contains(function($val, $key) use($access){
                    return $val->name == $access && $val->status == 'Active';
                }))
                {
                    return true;
                }
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

    public function roles()
    {
        return $this->belongsToMany('Modules\Access\Entities\V1\Role','users_roles');
    }
    

    public function accesses()
    {
        return $this->belongsToMany('Modules\Access\Entities\V1\Access','users_accesses');
    }
}