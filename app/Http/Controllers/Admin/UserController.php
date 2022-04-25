<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Masters\Departments;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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
            return FacadesDataTables::eloquent($data)

            ->addColumn('role', function ($data) {
                return $data->roles()->first()->name;
            })
            ->addColumn('department', function ($data) {
                return Departments::find($data->department)->name ?? '-';
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
        $roleDb         = Sentinel::getRoleRepository()->whereNotIn('slug',['admin','superadmin'])->pluck('name','id');
        $departmentDb   = Departments::latest()->pluck('name','id');
        $userRole       = null;
        $userDepartment = null;
        return view('masters.user.create', compact('roleDb','userRole', 'departmentDb', 'userDepartment'));
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
  
        try {
 
            //  Create a User Record
            $user   =  User::create([
                'full_name'  => $request->full_name,
                'alias_name' => $request->alias_name,
                'department' => $request->department,
                'email'      => $request->email,
                'password'   => Hash::make(config('auth.password')),
            ]);

            // find a Users
            $user_activation = Sentinel::findById($user->id);

            //  Create Activation Record for User 
            $activation      = Activation::create($user_activation);

            // To Complete a Activation 
            Activation::complete($user_activation, $activation->code);
 
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

        $departmentDb   = Departments::latest()->pluck('name','id');
        $userRole       = null;
        $userDepartment = $user->department;
        
        $userRole = $user->roles[0]->id ?? null;
            
        return view('masters.user.edit', compact('user','roleDb','userRole','departmentDb','userDepartment'));
    }

    public function update(Request $request , $id)
    {
        $user = User::find($id);
       
        if (empty($user)) {
            Flash::error( __('global.not_found'));
            return redirect()->route('user.index');
        }
        
        try {
       
            //  Create a User Record
            $updated_user = $user->update([
                'full_name'  => $request->full_name,
                'alias_name' => $request->alias_name,
                'department' => $request->department,
                'email'      => $request->email,
                'password'   => Hash::make(config('auth.password')),
            ]);

            // find a Users
            $user_activation = Sentinel::findById($updated_user->id);

            //  Create Activation Record for User 
            $activation      = Activation::create($user_activation);

            // To Complete a Activation 
            Activation::complete($user_activation, $activation->code);
 
            //Attach the user to the role
            $role = Sentinel::findRoleById($request->role_id);
            $role->users()->attach($updated_user);
            
            
            Flash::success( __('auth.update_successful'));
            return redirect()->route('user.index');

        } catch (\Throwable $th) {
            return redirect()->route('user.index');
        }
    }
} 