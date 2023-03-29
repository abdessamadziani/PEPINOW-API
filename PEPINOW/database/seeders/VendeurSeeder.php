<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'vendeur@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$2yoodAtWB7TNQ8gt7Z24vee5Ak2I/ZnzKNoeyFS4UoslJxhJburlW', // vendeur
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('vendeur');
    }
}
