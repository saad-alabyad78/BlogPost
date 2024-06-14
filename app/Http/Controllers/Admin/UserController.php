<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Roles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $role = Role::where('name' , Roles::USER)->first();
        $users = $role->users()->get() ;
        return view('admin.users.index', ['users' =>$users]);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
