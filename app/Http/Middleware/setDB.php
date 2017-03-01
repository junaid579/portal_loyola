<?php

namespace App\Http\Middleware;
use Cookie;
use Config;
use Closure;
use DB;
use App\User;
use Auth;
use Session;
class SetDB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

                Config::set('database.connections.newsql', array(
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'port' => '3306',
                    'database' =>'loyola_2016_2017',
                    'username' => 'root',
                    'password' => 'Admin123*',
                    'charset' => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix' => '',
                ));
                DB::reconnect('mysql');
            
    }
}

