<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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
            $data = Sentinel::getUserRepository()->with('roles', 'activations')
                                                ->whereHas('roles',function($q){
                                                    $q->whereNotIn('slug',['admin','superadmin']);
                                                });
            return Datatables::eloquent($data)

            ->addColumn('role', function ($data) {
                return $data->roles()->first()->name;
            })
            ->addColumn('status', function($data){
                $status = 'Active';
                return $status;
            })

            ->addColumn('action', function($data){
                $action = '
                    <div class="btn-group border">
                        <a href="'.route('user.edit', $data->id).'" class="btn btn-sm border-top-0  border-start-0 border-bottom-0 border" title="Edit"> <i class="bi bi-pencil-square"></i> </a>
                        <form method="post" action="'.route('user.delete', $data->id).'"> 
                                '.csrf_field().'
                            <button id="confirmDelete" type="submit" class="btn btn-sm text-danger border-0" title="Delete"><i class="bi bi-trash"></i> </button>
                        </form>
                    </div>
                ';
                return $action;
            })
            ->rawColumns(array(
                'status',
                'action'
            ))
            ->make(true);
        }

        return view('masters.user.index', compact('users','roles'));
    }

    public function create(Request $request)
    {
        $roleDb = Sentinel::getRoleRepository()->whereNotIn('slug',['admin','superadmin'])->pluck('name','id');
        $userRole = null;
        return view('masters.user.create', compact('roleDb','userRole'));
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
            'role_id.required'  => trans('auth.role_name_required'),
        ];

        $this->validate($request, $rules, $customMessages);

        //  Auth User Details
        // $user  = Sentinel::getUser()->first_name;
    
        try {
            $credentials = [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => config('auth.password'),
            ];

            // Create User Record
            $user = Sentinel::registerAndActivate($credentials);
 
            //Attach the user to the role
            $role = Sentinel::findRoleById($request->role_id);
            $role->users()->attach($user);

            Flash::success( __('auth.account_creation_successful'));

        } catch (\Throwable $th) {

            Log::error('User registration email sent failure.');
        }
        return redirect()->route('user.index');
    } 

    public function destroy(Request $request , $id)
    {
        $data = Sentinel::findById($id);

        if (empty($data)) {
           Flash::error( __('global.not_found'));

            return redirect()->route('user.index');
        }

        $data->delete();

       Flash::success( __('auth.delete_account'));

        return redirect()->route('user.index');
    }

    public function edit(Request $request , $id)
    {
        $user = Sentinel::findUserById($id);

        if (empty($user)) {
           Flash::error( __('global.not_found'));
            return redirect()->route('user.index');
        }

        $roleDb = Sentinel::getRoleRepository()->whereNotIn('slug',['admin','superadmin'])->pluck('name','id');

        $userRole = $user->roles[0]->id ?? null;
            
        return view('masters.user.edit', compact('user','roleDb','userRole'));
    }

    public function update(Request $request , $id)
    {
        $user = Sentinel::findById($id);
       
        if (empty($user)) {
            Flash::error( __('global.not_found'));
            return redirect()->route('user.index');
        }
        
        try {
       
            $oldRole = Sentinel::findRoleById($user->roles[0]->id ?? null);
           
            $credentials = [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => config('auth.password'),
            ];

            if ($oldRole) {
                //Remove a user from a role.
                $oldRole->users()->detach($user);
            }

            //Valid User For Update
            $role = Sentinel::findRoleById($request->role_id);

            //Assign a user to a role.
            $role->users()->attach($user);

            //Update User
            Sentinel::update($user, $credentials);
            
            Flash::success( __('auth.update_successful'));
            return redirect()->route('user.index');

        } catch (\Throwable $th) {
            return redirect()->route('user.index');
        }
    }
} 