<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $admin_role = Role::create(['name' => 'admin']);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('11223344')
        ]);
        $admin->assignRole($admin_role);

        $client_role = Role::create(['name' => 'client']);
        $client = User::create([
            'name' => 'Client',
            'email' => 'client@client.com',
            'password' => bcrypt('password')
        ]);
        $client->assignRole($client_role);
    }
}
