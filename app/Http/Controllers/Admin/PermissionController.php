<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
 

class PermissionController extends Controller
{
     

    public function store(Request $request)
    {
      
        $user = Sentinel::findById($request->user_id);
   
        if($request->user_view_withdrawal == 'true') {
            $user->addPermission('user.view.withdrawal');
        }
        if($request->user_add_withdrawal == 'true') {
            $user->addPermission('user.add.withdrawal');
        }
        if($request->user_edit_withdrawal == 'true') {
            $user->addPermission('user.edit.withdrawal');
        }
        if($request->user_delete_withdrawal == 'true') {
            $user->addPermission('user.delete.withdrawal');
        }
        $user->save(); 
        return redirect()->back();
    }
}
