<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use DataTables;
use App\Models\Roles;
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
        
        $permissions = [
             
            // Withdrawal 
            'user.view.withdrawal'    =>  $request -> user_view_withdrawal   == 'true' ? true : false,
            'user.add.withdrawal'     =>  $request -> user_add_withdrawal    == 'true' ? true : false,
            'user.edit.withdrawal'    =>  $request -> user_edit_withdrawal   == 'true' ? true : false,
            'user.delete.withdrawal'  =>  $request -> user_delete_withdrawal == 'true' ? true : false,

            // Search or Add 
            'user.view.search_or_add'    =>  $request -> user_view_search_or_add   == 'true' ? true : false,
            'user.add.search_or_add'     =>  $request -> user_add_search_or_add   == 'true' ? true : false,
            'user.edit.search_or_add'    =>  $request -> user_edit_search_or_add   == 'true' ? true : false,
            'user.delete.search_or_add'  =>  $request -> user_delete_search_or_add   == 'true' ? true : false,

            // Threshold Qty 
            'user.view.threshold_qty'    =>  $request -> user_view_threshold_qty   == 'true' ? true : false,
            'user.add.threshold_qty'     =>  $request -> user_add_threshold_qty   == 'true' ? true : false,
            'user.edit.threshold_qty'    =>  $request -> user_edit_threshold_qty   == 'true' ? true : false,
            'user.delete.threshold_qty'  =>  $request -> user_delete_threshold_qty   == 'true' ? true : false,

            // Near Expiry/Expired
            'user.view.near_expiry_and_expired'   =>  $request -> user_view_near_expiry_and_expired   == 'true' ? true : false,
            'user.add.near_expiry_and_expired'    =>  $request -> user_add_near_expiry_and_expired   == 'true' ? true : false,
            'user.edit.near_expiry_and_expired'   =>  $request -> user_edit_near_expiry_and_expired   == 'true' ? true : false,
            'user.delete.near_expiry_and_expired' =>  $request -> user_delete_near_expiry_and_expired   == 'true' ? true : false,

            // Early Disposal
            'user.view.early_disposal'    =>  $request -> user_view_early_disposal   == 'true' ? true : false,
            'user.add.early_disposal'     =>  $request -> user_add_early_disposal   == 'true' ? true : false,
            'user.edit.early_disposal'    =>  $request -> user_edit_early_disposal   == 'true' ? true : false,
            'user.delete.early_disposal'  =>  $request -> user_delete_early_disposal   == 'true' ? true : false,

            // Extend Expiry
            'user.view.extend_expiry'    =>  $request -> user_view_extend_expiry   == 'true' ? true : false,
            'user.add.extend_expiry'     =>  $request -> user_add_extend_expiry   == 'true' ? true : false,
            'user.edit.extend_expiry'    =>  $request -> user_edit_extend_expiry   == 'true' ? true : false,
            'user.delete.extend_expiry'  =>  $request -> user_delete_extend_expiry   == 'true' ? true : false,

            // Report
            'user.view.report'    =>  $request -> user_view_report   == 'true' ? true : false,
            'user.add.report'     =>  $request -> user_add_report   == 'true' ? true : false,
            'user.edit.report'    =>  $request -> user_edit_report   == 'true' ? true : false,
            'user.delete.report'  =>  $request -> user_delete_report   == 'true' ? true : false,

            // Print Barcode
            'user.view.print_barcode'    =>  $request -> user_view_print_barcode   == 'true' ? true : false,
            'user.add.print_barcode'     =>  $request -> user_add_print_barcode   == 'true' ? true : false,
            'user.edit.print_barcode'    =>  $request -> user_edit_print_barcode   == 'true' ? true : false,
            'user.delete.print_barcode'  =>  $request -> user_delete_print_barcode   == 'true' ? true : false,

            // Reconciliation
            'user.view.reconciliation'    =>  $request -> user_view_reconciliation   == 'true' ? true : false,
            'user.add.reconciliation'     =>  $request -> user_add_reconciliation   == 'true' ? true : false,
            'user.edit.reconciliation'    =>  $request -> user_edit_reconciliation   == 'true' ? true : false,
            'user.delete.reconciliation'  =>  $request -> user_delete_reconciliation   == 'true' ? true : false,
        ];

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
        $role           = Sentinel::findRoleById($id);
        $permissions    = $role->permissions ?? config('permission');
        return view('masters.role.edit', compact('role', 'permissions'));
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
        $dataDb = Sentinel::findRoleById($id);
        
        if (empty($dataDb)) {
            Flash::error( __('global.denied')); 
            return redirect()->back();
        }
 

        $permissions = [
             
            // Withdrawal 
            'user.view.withdrawal'    =>  $request -> user_view_withdrawal   == 'true' ? true : false,
            'user.add.withdrawal'     =>  $request -> user_add_withdrawal    == 'true' ? true : false,
            'user.edit.withdrawal'    =>  $request -> user_edit_withdrawal   == 'true' ? true : false,
            'user.delete.withdrawal'  =>  $request -> user_delete_withdrawal == 'true' ? true : false,

            // Search or Add 
            'user.view.search_or_add'    =>  $request -> user_view_search_or_add   == 'true' ? true : false,
            'user.add.search_or_add'     =>  $request -> user_add_search_or_add   == 'true' ? true : false,
            'user.edit.search_or_add'    =>  $request -> user_edit_search_or_add   == 'true' ? true : false,
            'user.delete.search_or_add'  =>  $request -> user_delete_search_or_add   == 'true' ? true : false,

            // Threshold Qty 
            'user.view.threshold_qty'    =>  $request -> user_view_threshold_qty   == 'true' ? true : false,
            'user.add.threshold_qty'     =>  $request -> user_add_threshold_qty   == 'true' ? true : false,
            'user.edit.threshold_qty'    =>  $request -> user_edit_threshold_qty   == 'true' ? true : false,
            'user.delete.threshold_qty'  =>  $request -> user_delete_threshold_qty   == 'true' ? true : false,

            // Near Expiry/Expired
            'user.view.near_expiry_and_expired'   =>  $request -> user_view_near_expiry_and_expired   == 'true' ? true : false,
            'user.add.near_expiry_and_expired'    =>  $request -> user_add_near_expiry_and_expired   == 'true' ? true : false,
            'user.edit.near_expiry_and_expired'   =>  $request -> user_edit_near_expiry_and_expired   == 'true' ? true : false,
            'user.delete.near_expiry_and_expired' =>  $request -> user_delete_near_expiry_and_expired   == 'true' ? true : false,

            // Early Disposal
            'user.view.early_disposal'    =>  $request -> user_view_early_disposal   == 'true' ? true : false,
            'user.add.early_disposal'     =>  $request -> user_add_early_disposal   == 'true' ? true : false,
            'user.edit.early_disposal'    =>  $request -> user_edit_early_disposal   == 'true' ? true : false,
            'user.delete.early_disposal'  =>  $request -> user_delete_early_disposal   == 'true' ? true : false,

            // Extend Expiry
            'user.view.extend_expiry'    =>  $request -> user_view_extend_expiry   == 'true' ? true : false,
            'user.add.extend_expiry'     =>  $request -> user_add_extend_expiry   == 'true' ? true : false,
            'user.edit.extend_expiry'    =>  $request -> user_edit_extend_expiry   == 'true' ? true : false,
            'user.delete.extend_expiry'  =>  $request -> user_delete_extend_expiry   == 'true' ? true : false,

            // Report
            'user.view.report'    =>  $request -> user_view_report   == 'true' ? true : false,
            'user.add.report'     =>  $request -> user_add_report   == 'true' ? true : false,
            'user.edit.report'    =>  $request -> user_edit_report   == 'true' ? true : false,
            'user.delete.report'  =>  $request -> user_delete_report   == 'true' ? true : false,

            // Print Barcode
            'user.view.print_barcode'    =>  $request -> user_view_print_barcode   == 'true' ? true : false,
            'user.add.print_barcode'     =>  $request -> user_add_print_barcode   == 'true' ? true : false,
            'user.edit.print_barcode'    =>  $request -> user_edit_print_barcode   == 'true' ? true : false,
            'user.delete.print_barcode'  =>  $request -> user_delete_print_barcode   == 'true' ? true : false,

            // Reconciliation
            'user.view.reconciliation'    =>  $request -> user_view_reconciliation   == 'true' ? true : false,
            'user.add.reconciliation'     =>  $request -> user_add_reconciliation   == 'true' ? true : false,
            'user.edit.reconciliation'    =>  $request -> user_edit_reconciliation   == 'true' ? true : false,
            'user.delete.reconciliation'  =>  $request -> user_delete_reconciliation   == 'true' ? true : false,
        ];

        Sentinel::findRoleById($id)->update(['permissions'  =>  null]);

        Sentinel::findRoleById($id)->update([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);
       
        Flash::success( __('auth.role_update_successful'));

        return redirect()->route('role.index');
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
