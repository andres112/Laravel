<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create user without persisting to DB with make()
        User::factory(1)->make();
        // Create 1 user persisting in DB with create()
        User::factory(1)->create();
        // Create 2 unverified users persisting in DB with create()
        User::factory(2)->unverified()->create();
        // Create 20 tasks persisting in DB with create()
        Task::factory(20)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
