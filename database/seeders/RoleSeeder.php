<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect(
            [
                [
                    'name' => 'Admin'
                ],
                [
                    'name' => 'Employee'
                ]
            ]
            );
        $roles->each(function($role){
            Role::insert($role);
        });    
    }
}
