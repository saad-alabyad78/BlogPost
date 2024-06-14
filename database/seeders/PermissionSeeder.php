<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = 
        [
            'create-post' , 
            'update-post' ,
            'delete-post' ,
            
            'delete-user' ,

            'create-post-user' ,
            'delete-post-user' ,
        ] ;

        $permissions = array_map(function($name){
            return  ['name' => $name] ;
        } , $permissions) ;
        
        Permission::insert($permissions) ;

        $adminRole = Role::where('name' , Roles::ADMIN)->first() ;

        $adminRole->permissions()->saveMany([
            Permission::where('name' , 'delete-user')->first() ,
            Permission::where('name' , 'create-post-user')->first() ,
            Permission::where('name' , 'delete-post-user')->first() ,
        ]) ;
    }
}
