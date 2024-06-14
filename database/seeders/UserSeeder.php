<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach($users as $user)
        {
            RoleUser::create([
                'user_id' => $user->id ,
                'role_id' => Role::inRandomOrder()->take(1)->first()->id ,
            ]);
        }

        $adminRole = Role::where('name' , Roles::ADMIN)->first() ;

        $admin_read = User::create([
            'name' => 'admin read' , 
            'email' => 'admin-read@gmail.com' ,
            'password' => Hash::make('12345678') ,
        ]);

        $adminRole->users()->save($admin_read) ;


        $admin_delete_user = User::create([
            'name' => 'admin delete user' , 
            'email' => 'admin-delete-user@gmail.com' ,
            'password' => Hash::make('12345678') ,
        ]);
        $adminRole->users()->save($admin_delete_user) ;
        $admin_delete_user->permissions()->save(Permission::where('name' , 'delete-user')->first());


        $admin_delete_post = User::create([
            'name' => 'admin delete post' , 
            'email' => 'admin-delete-post@gmail.com' ,
            'password' => Hash::make('12345678') ,
        ]);
        $adminRole->users()->save($admin_delete_post) ;
        $admin_delete_post->permissions()->save(Permission::where('name' , 'delete-post')->first());
    }
}
