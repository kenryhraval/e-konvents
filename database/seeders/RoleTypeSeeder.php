<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleType;

class RoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['kr!', 'com!', 'fil!', 'b!fil!', 'kasieris', 'ekonoms', 'sekretārs', 'oldermanis', 'seniors', 'mag! cant!', 'mag! pauk!', 'major domus'];

        foreach ($types as $type) {
            RoleType::firstOrCreate(['name' => $type]);
        }
    }
}
