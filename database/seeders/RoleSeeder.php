<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            [
                'id' => 1,
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'proprietaire',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'id' => 3,
                'name' => 'joueur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ];
        foreach($roles as $role){
            Role::create($role);
        }
    }
}
