<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'sales']);
        Role::create(['name' => 'customer']);

        // Assign roles to users
        $admin = User::find(1);
        $admin->assignRole('admin');

        $sales = User::find(2);
        $sales->assignRole('sales');

        $customer = User::find(3);
        $customer->assignRole('customer');

    }
}
