<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Session\Store;
use Auth;
use Session;
use Laracasts\Flash\Flash;

class AuthMiddleware
{
    protected $session;
    protected $timeout = 30;
     
    public function __construct(Store $session){
        $this->session = $session;
    }
    public function checkSession($request,$next) {
        $isLoggedIn = $request->path() != 'dashboard/logout';
        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'dashboard');
            auth()->logout();
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
    public function handle($request, Closure $next, $guard = null)
    {
        if (Sentinel::check()== FALSE) { 
            return redirect()->route('login'); 
        }
        if(auth_user_role()->slug != 'admin' && isset(auth_user_role()->permissions)) {

            foreach(auth_user_role()->permissions as $access => $val) {
                
                $menu=(format_route(request()->route()->getName())=='help_index')?'help_menu_index': format_route(request()->route()->getName());
                if($menu == format_route($access)) {
                   if($val == 1) {
                        return $this->checkSession($request,$next);
                    }else if( $menu=="dashboard" && $val == 0){
 return $this->checkSession($request,$next);
                    }else {
                        Flash::error('Permission Denied ! Contact your admin');
                        return back();
                    }
                }
            }
        }
        return $this->checkSession($request,$next);
    }
}