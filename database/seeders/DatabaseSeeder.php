<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed companies first
        $this->call(CompanySeeder::class);

        // Get the first company to assign to our test user
        $company = \App\Models\Company::first();

        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test User',
            'email' => 'test@example.com',
            'company_id' => $company->id,
        ]);
    }
}
