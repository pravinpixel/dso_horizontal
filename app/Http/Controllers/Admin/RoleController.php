<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use DataTables;
use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
    {
        if($request->ajax()) {
             
            $data = Sentinel::getRoleRepository()->select([
                'id',
                'slug',
                'name',
                'created_at',
                'updated_at',
            ])->whereNotIn('slug',['admin','superadmin']);
                return DataTables::eloquent($data)
                ->addColumn('action', function ($data) {
                    $action = '
                        <div class="btn-group border">
                            <a href="'.route('role.edit', $data->id).'" class="btn btn-sm border-top-0  border-start-0 border-bottom-0 border" title="Edit"> <i class="bi bi-pencil-square"></i> </a>
                            <form method="post" action="'.route('role.delete', $data->id).'"> 
                                    '.csrf_field().'
                                <button id="confirmDelete" type="submit" class="btn btn-sm text-danger border-0" title="Delete"><i class="bi bi-trash"></i> </button>
                            </form>
                        </div>
                    ';
                    return $action;
                })
                
            ->make(true);
        }
        return view('masters.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $permissions = config('permission');
        return view('masters.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $rules = [
            'name'     => 'required|unique:roles|max:255', 
        ];

        $customMessages = [
            'name.required'    => trans('auth.role_name_required'),
            'name.unique'      => trans('auth.role_already_exists'),
        ];
        

        $this->validate($request, $rules, $customMessages);
        
        $permissions  = [];

        $permissions_data = $request->input();

        unset($permissions_data['name']);
        unset($permissions_data['_token']);

        foreach ($permissions_data as $key => $value) { 
            $status = $value[1] ?? 0;
            $permissions[$key] = (boolean) $status;
        }
   
       
        Sentinel::getRoleRepository()->createModel()->create([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);
  
        Flash::success(__('auth.role_creation_successful'));
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(getRoutes());
        $role   = Sentinel::findRoleById($id);  
        return view('masters.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Sentinel::findRoleById($id);
        
        if (empty($role)) {
            Flash::error( __('global.denied')); 
            return redirect()->back();
        }
        $permissions  = [];

        $permissions_data = $request->input();

        unset($permissions_data['name']);
        unset($permissions_data['_token']);
        unset($permissions_data['_method']);

        foreach ($permissions_data as $key => $value) { 
            $status = $value[1] ?? 0;
            $permissions[$key] = (boolean) $status;
        }
 
        $role->update([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);
       
        Flash::success( __('auth.role_update_successful'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDb = Sentinel::getUser();
        $dataDb = Sentinel::findRoleById($id);

        if (empty($dataDb)) {
            Flash::error(__('global.not_found'));

            return redirect()->route('role.index');
        }

        $dataDb->users()->detach($userDb);
        $dataDb->delete();

        Flash::success(__('auth.role_delete_successful'));

        return redirect()->route('role.index');
    } 
}
