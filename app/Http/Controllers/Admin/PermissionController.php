<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class PermissionController extends Controller
{
    public function index()
    {
        $user = Sentinel::findById(7);
        $user->addPermission('user.create');
        $user->addPermission('user.update');

        $user->save(); 
    }
}
