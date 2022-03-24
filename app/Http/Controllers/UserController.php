<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use DataTables;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users  = Sentinel::getUserRepository()->with('roles')->get();
        $roles  = Sentinel::getRoleRepository()->get();

        if ($request->ajax()) {
            $data = Sentinel::getUserRepository()->with('roles')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('masters.user.index', compact('users','roles'));
    }

    public function create(Request $request)
    {
        $roles  = Sentinel::getRoleRepository()->get();
        return view('masters.user.create', compact('roles'));
    }

    public function store(Request $request)
    { 
 
        $rules = [
            'email'     => 'required|unique:users|max:255',
            'role_id'   => 'required',
        ];

        $customMessages = [
            'email.required'    => 'Login Id field is required.',
            'email.unique'      => 'Login Id has already been taken.',
            'role_id.required'  => 'Role name field is required.',
        ];

        $this->validate($request, $rules, $customMessages);

        //  Auth User Details
        // $user  = Sentinel::getUser()->first_name;
    
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => config('auth.password'),
            ];

            // Create User Record
            $user = Sentinel::registerAndActivate($data);
 
            //Attach the user to the role
            $role = Sentinel::findRoleById($request->role_id);
            $role->users()->attach($user);

            Flash::success( __('auth.account_creation_successful'));

        } catch (\Throwable $th) {

            Log::error('User registration email sent failure.');
        }
        return redirect()->route('user.index');
    } 
}
