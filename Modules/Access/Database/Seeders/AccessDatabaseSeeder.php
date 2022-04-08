<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Access\Entities\V1\User;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Route;
use Modules\Access\Entities\V1\Access;
use Modules\Setting\Entities\V1\Setting;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;

class AccessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //CREATE ROLE
        $role = Role::create(
            [
                'id' => Uuid::uuid6(),
                'name' => 'Administrator',
                'status' => 'Active',
                'desc' => ''
            ]
        );
        //CREATE USER
        $user = User::create([
            'id' => Uuid::uuid6(),
            'code' => '0000000001',
            'name' => 'Administrator',
            'phone' => '12345678910',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'status' => 'Active',
            'blocked' => 0,
            'blocked_reason' => '',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $user->assignRole([$role->name]);
        //CREATE ACCESS
        $routeCollection = Route::getRoutes();
        $accesses = [];
        foreach ($routeCollection as $value){
            if($value->getName() !== null){
                $middle = $value->getAction('middleware');
                $check = Access::where('name',$value->getName())->where('guard_name',$middle[0])->first();
                if(!$check && ($middle[0] == 'web' || $middle[0] == 'api')){
                    $access = Access::create(
                        [
                            'id' => Uuid::uuid6(),
                            'name' => $value->getName(),
                            'guard_name' => $middle[0],
                            'status' => 'Active',
                        ]
                    );     
                    //CREATE ROLE ACCESS
                    if(!$role->hasAccess($access->name)){
                        $role->assignAccess($access->name);
                    }    
                }    
            }
        }
        //CREATE SETTING
        Setting::create(
            [
                'id' => Uuid::uuid6(),
                'initial' => 'Laravel 9 Admin',
                'name' => 'Laravel 9 Admin',
                'description' => 'Laravel 9 Admin',
                'icon' => 'laravel.png',
                'logo' => 'laravel.png',
                'login_image' => 'laravel.png',
            ]
        );
        // $this->call("OthersTableSeeder");
    }
}
