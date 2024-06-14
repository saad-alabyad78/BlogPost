<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
     /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        //todo: cant delete admin
        //todo: cant delete your self
        
        if(!auth()->check())return false ;

        if(!$user->is_admin())return false;
        
        $permission = Permission::where('name', 'delete-user')->first() ; 
 
        return 
        $user->permissions()->find($permission->id)
        or
        $user->roles()->first()->permissions()->find($permission->id);
    }

}
