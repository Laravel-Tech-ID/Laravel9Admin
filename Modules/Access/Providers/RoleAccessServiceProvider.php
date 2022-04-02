<?php

namespace Modules\Access\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Access\Entities\V1\Access;
use Gate;
use Blade;

class RoleAccessServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function boot()
    {
        //----------------------------------------//
        //=== COMMENT THIS BEFORE INSTALLATION ===//
        //----------------------------------------//
        Access::get()->map(function($access){
            Gate::define($access->name, function($user) use ($access){
                return $user->hasAccess($access);
            });
        });
        //----------------------------------------//
        //= END COMMENT THIS BEFORE INSTALLATION =//
        //----------------------------------------//

        Blade::directive('role', function(... $roles){
            $roles = implode(',',$roles);
            return "<?php if(auth()->check() && auth()->user()->hasRole({$roles})): ?>";
        });

        Blade::directive('endrole', function(){
            return "<?php endif ?>";
        });

        Blade::directive('access', function(... $accesses){
            $accesses = implode(',',$accesses);
            return "<?php if(auth()->check() && auth()->user()->hasAccess({$accesses})): ?>";
        });

        Blade::directive('endaccess', function(){
            return "<?php endif ?>";
        });
    }

}
