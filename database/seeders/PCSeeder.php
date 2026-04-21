<?php

namespace Database\Seeders;

use App\Models\PC;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PC::create([
            'pc_name' => 'PC-001',
            'status' => 'ready',
        ]);
    }
}
