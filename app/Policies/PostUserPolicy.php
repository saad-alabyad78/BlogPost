<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PostUser;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;

class PostUserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if(!auth()->check())return false ;

        $permission = Permission::where('name', 'create-post-user')->first() ; 

        return 
        $user->permissions()->find($permission->id)
        or
        $user->roles()->first()->permissions()->find($permission->id)
        ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostUser $postUser): bool
    {
        if(!auth()->check())return false ;

        $permission = Permission::where('name', 'delete-post-user')->first() ; 

        return 
        $user->permissions()->find($permission->id)
        or
        $user->roles()->permissions()->find($permission->id)
        ;
    }
}
