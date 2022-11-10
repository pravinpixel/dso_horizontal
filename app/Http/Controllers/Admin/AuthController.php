<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Laracasts\Flash\Flash;
class AuthController extends Controller
{
    public function index()
    {
        if(Sentinel::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = [
            'email'     => $request->user_login_id,
            'password'  => config('auth.password'),
        ];

        try {
            if($user = Sentinel::authenticate($credentials , $request->get('remember', false))) {
                Flash::success( __('auth.login_successful'));
                securityLog('login');
                return redirect(route('dashboard'));
            } else {
                Flash::error( __('auth.incorrect_email_id_and_password'));
                return redirect(route('login'));
            }
        } catch (ThrottlingException $ex) {

            Flash::error(__('auth.login_timeout'));
            return redirect()->route('login');
            
        } catch (NotActivatedException $ex) {
            Flash::error(__('auth.login_unsuccessful_not_active')); 
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        try {
            securityLog('logout');
        } catch (\Throwable $th) {
             
        }
        Sentinel::logout(null, true);
        Flash::success(__('auth.logout_successful'));
        return redirect(route('login'));
    }
}