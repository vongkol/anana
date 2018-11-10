<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use DB;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('view', function ($expression) {
            $role_id = Auth::user()->role_id;
            $q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->select('role_permissions.*')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $expression])
                ->where('role_permissions.list', 1);

            $i = $q->count() > 0;
            if($i)
            {
                return true;
            }
            else{
                return false;
            }
        });

        Blade::if('insert', function ($expression) {
            $role_id = Auth::user()->role_id;
            $q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->select('role_permissions.*')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $expression])
                ->where('role_permissions.insert', 1);

            $i = $q->count() > 0;
            if($i)
            {
                return true;
            }
            else{
                return false;
            }
        });
        Blade::if('update', function ($expression) {
            $role_id = Auth::user()->role_id;
            $q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->select('role_permissions.*')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $expression])
                ->where('role_permissions.update', 1);

            $i = $q->count() > 0;
            if($i)
            {
                return true;
            }
            else{
                return false;
            }
        });
        Blade::if('delete', function ($expression) {
            $role_id = Auth::user()->role_id;
            $q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', 'role_permissions.permission_id')
                ->select('role_permissions.*')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $expression])
                ->where('role_permissions.delete', 1);

            $i = $q->count() > 0;
            if($i)
            {
                return true;
            }
            else{
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
