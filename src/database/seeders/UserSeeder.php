<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Navigation as ModelsNavigation;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** 
         * ================================================================
         * CLEAR CACHE PERMISSIONS
         * ================================================================
         */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        /** 
         * ================================================================
         * GENERATE PERMISSIONS FROM NAVIGATION SLUG
         * ================================================================
         */
        $navSlug = ModelsNavigation::pluck('slug')->toArray();
        $this->generatePermissions($navSlug);

        /** 
         * ================================================================
         * GET PERMISSION FOR EACH ROLE
         * ================================================================
         */
        $allPermissions = Permission::all();

        /** 
         * ================================================================
         * CREATE ROLES
         * ================================================================
         */
        $developerRole = Role::create(['name' => RoleEnum::DEVELOPER->value]);
        $superadmin = Role::create(['name' => RoleEnum::SUPERADMIN->value]);
        $admin = Role::create(['name' => RoleEnum::ADMIN->value]);
        $user = Role::create(['name' => RoleEnum::USER->value]);

        /** 
         * ================================================================
         * ASSIGN PERMISSIONS TO ROLES
         * ================================================================
         */
        $developerRole->syncPermissions($allPermissions);

        /** 
         * ================================================================
         * CREATE USERS AND ASSIGN ROLES
         * ================================================================
         */
        $developerAccount = User::factory()->create([
            'name' => 'Laravel Base Developer',
            'email' => 'developerlaravelbase@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $developerAccount->assignRole($developerRole);
    }
    
    /** 
     * ================================================================
     * FUNCTION FOR GENERATE PERMISSIONS FROM NAVIGATION SLUG
     * ================================================================
     */
    public function generatePermissions($permissions)
    {
        $permissionsList = [];
        foreach ($permissions as $permission) {
            $permissionsList[] = ['name' => $permission . '.read', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $permission . '.create', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $permission . '.update', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $permission . '.delete', 'guard_name' => 'web'];
        }
        return Permission::insert($permissionsList);
    }

    /** 
     * =======================================================================
     * FUNCTIONS FOR GET LIST PERMISSIONS FOR ROLE EXCEPT 'developer'
     * You can add functions here to get specific permissions for other roles
     * ========================================================================
     */
}
