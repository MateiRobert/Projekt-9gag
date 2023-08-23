<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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



    public function deleteUser($id) {
        \Log::info("Deleting user with ID: " . $id);
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
    }


    public function updateUser(Request $request, $id) {
        \Log::info("Updating user with ID: " . $id . " and data: " . json_encode($request->all()));

        $user = User::find($id);
        if ($user) {
            $user->username = $request->input('username');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->created_at = $request->input('created_at');
            $user->is_active = $request->input('is_active') === 'Active' ? 1 : 0;
            $user->is_admin = $request->input('is_admin') === 'Admin' ? 1 : 0;
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'User updated successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
    }
    

    
    public function search(Request $request) {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%{$query}%")
                     ->orWhere('email', 'LIKE', "%{$query}%")
                     ->orWhere('username', 'LIKE', "%{$query}%")
                     ->get();
        return response()->json($users);
    }
    


}
