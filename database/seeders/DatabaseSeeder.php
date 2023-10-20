<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "admin";
        $user->email= "admin@admin.com";
        $user->password= Hash::make('clave');
        $user->nivel='admin';
        $user->puedeEditar=true;
        $user->save();
        $user = new Admin;
        $user->name = "admin";
        $user->email= "admin@admin.com";
        $user->password= Hash::make('clave');
        $user->nivel='admin';
        $user->save();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
