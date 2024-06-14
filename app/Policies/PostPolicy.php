<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return auth()->check() ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->check() and !$user->is_admin(); // only users creates blogs
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return auth()->check() && $user->posts()->find($post->id) ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if(!auth()->check())return false ;
        if($user->posts()->find($post->id) || $user->is_admin())return true;
        
        $permission = Permission::where('name', 'delete-post')->first() ; 

        return 
        $user->permissions()->find($permission->id)
        or
        $user->roles()->first()->permissions()->find($permission->id)
        ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false ;
    }
}
