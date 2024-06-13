<?php

namespace Database\Seeders;

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
            'create post' , 
            'update post' ,
        ] ;

        $permissions = array_map(function($name){
            return  ['name' => $name] ;
        } , $permissions) ;
        
        Permission::insert($permissions) ;
    }
}
