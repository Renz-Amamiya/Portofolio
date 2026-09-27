<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@portfolio.dev',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'bio' => 'System Administrator',
        ]);
        
        \App\Models\User::create([
            'name' => 'John Developer',
            'email' => 'john@portfolio.dev',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'bio' => 'Web Developer',
            'social_links' => json_encode([
                'github' => 'https://github.com/johndev',
                'linkedin' => 'https://linkedin.com/in/johndev',
                'twitter' => 'https://twitter.com/johndev',
            ]),
        ]);
        
        $this->command->info('Admin user created:');
        $this->command->info('Email: admin@portfolio.dev');
        $this->command->info('Password: password123');
    }
}
