<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardUser extends Controller
{
    

    public function dashboard() {
        $isAdminCount = User::where('is_admin', 1)->count();
        $isNotAdminCount = User::where('is_admin', 0)->count();
        $isActiveCount = User::where('is_active', 1)->count();
        $isNotActiveCount = User::where('is_active', 0)->count();
        $users = User::all();



    
        return view('administrator.index', [
            'isAdminCount' => $isAdminCount,
            'isNotAdminCount' => $isNotAdminCount,
            'isActiveCount' => $isActiveCount,
            'isNotActiveCount' => $isNotActiveCount,
            'users' => $users
        ]);
    }
    
}
