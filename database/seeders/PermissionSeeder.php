<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing 'users' permissions
        // Permission::where('name', 'like', '%.users')->delete();

        $permissions = [
            // 'view.roles',
            // 'create.roles',
            // 'edit.roles',
            // 'delete.roles',
            
            // 'view.students',
            // 'create.students',
            // 'edit.students',
            // 'delete.students',

            // 'view.schools',
            // 'create.schools',
            // 'edit.schools',
            // 'delete.schools',

            // 'view.programs',
            // 'create.programs',
            // 'edit.programs',
            // 'delete.programs',

            // 'view.departments',
            // 'create.departments',
            // 'edit.departments',
            // 'delete.departments',

            // 'view.staffs',
            // 'create.staffs',
            // 'edit.staffs',
            // 'delete.staffs',

            // 'view.student.account',
            // 'edit.student.account',
            // 'delete.student.account',

            // 'view.structures',
            // 'create.structures',
            // 'edit.structures',
            // 'delete.structures',

            // 'view.items',
            // 'create.items',
            // 'edit.items',
            // 'delete.items',

            // 'view.idc',
            // 'create.idc',
            // 'edit.idc',
            // 'delete.idc',
            // 'pay.idc',
            
            // 'view.transcript',
            // 'create.transcript',
            // 'edit.transcript',
            // 'delete.transcript',

            // 'pay.transcript',

            // 'view.settings',
            // 'create.settings',
            // 'edit.settings',
            // 'delete.settings',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
