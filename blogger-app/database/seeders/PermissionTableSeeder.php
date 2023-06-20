<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'main-dashboard',
            'read-posts',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'show-posts',

            'read-users',
            'create-users',
            'edit-users',
            'delete-users',
            'show-users',

            'read-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',
            'show-categories',

            'read-tags',
            'create-tags',
            'edit-tags',
            'delete-tags',
            'show-tags',

            'read-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'show-roles',

            'read-comments',
            'create-comments',
            'edit-comments',
            'delete-comments',
            'show-comments',

        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
