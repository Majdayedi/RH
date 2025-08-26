<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->count(10)->create([
            'is_active' => true, // Set all companies to active by default
        ]);
        
        // Optionally, you can create some inactive companies for testing
        Company::factory()->count(5)->create([
            'is_active' => false, // Set some companies to inactive
        ]);
    }
}
