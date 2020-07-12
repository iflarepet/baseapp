<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\Role;
use App\Model\UserRole;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'name' => 'SU', 
            'description' => 'Super User',
            'is_active' => 'Y',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM'
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin', 
            'description' => 'Admin',
            'is_active' => 'Y',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM'
        ]);

        DB::table('roles')->insert([
            'name' => 'Member', 
            'description' => 'Member',
            'is_active' => 'Y',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM'
        ]);



        DB::table('users')->insert([
            'name' => 'superuser',
            'email' => 'superuser@demo.com',
            'password' => Hash::make("12345678"),
 			'username' => 'superuser',
 			'is_active' => 'Y',
 			'locked' => 'N',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
            ]); 
        DB::table('user_role')->insert([
            'user_id' => 1,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         
         DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@demo.com',
            'password' => Hash::make("12345678"),
 			'username' => 'admin',
 			'is_active' => 'Y',
 			'locked' => 'N',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
        ]); 
        DB::table('user_role')->insert([
            'user_id' => 2,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         
         DB::table('menus')->insert([
            'name' => 'Administrator',
 			'description' => 'Administrator',
 			'url' => '#', 
 			'icon_id' => 'fa-th',
 			'order_number' => '1',
 			'is_active' => 'Y',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]); 
         
         DB::table('menus')->insert([
            'name' => 'Profile',
 			'description' => 'Profile',
 			'url' => 'profile', 
 			'icon_id' => 'fa-user',
 			'order_number' => '2',
 			'is_active' => 'Y',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);


         DB::table('menus')->insert([
            'parent_id' => '1',
            'name' => 'User',
 			'description' => 'User',
 			'url' => 'admin/user', 
 			'order_number' => '1',
 			'is_active' => 'Y',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menus')->insert([
            'parent_id' => '1',
            'name' => 'Role',
 			'description' => 'Role',
 			'url' => 'admin/role', 
 			'order_number' => '2',
 			'is_active' => 'Y',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menus')->insert([
            'parent_id' => '1',
            'name' => 'Menu',
 			'description' => 'Menu',
 			'url' => 'admin/menu', 
 			'order_number' => '3',
 			'is_active' => 'Y',
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]); 

         DB::table('menu_role')->insert([
            'menu_id' => 1,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menu_role')->insert([
            'menu_id' => 2,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menu_role')->insert([
            'menu_id' => 3,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menu_role')->insert([
            'menu_id' => 4,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menu_role')->insert([
            'menu_id' => 5,
 			'role_id' => 2,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);
         DB::table('menu_role')->insert([
            'menu_id' => 2,
 			'role_id' => 3,
 			'created_by' => 'SYSTEM',
 			'updated_by' => 'SYSTEM'
         ]);

    }

}
