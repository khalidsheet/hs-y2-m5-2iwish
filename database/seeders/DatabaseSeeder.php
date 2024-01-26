<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Lottery;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // create 10 feedbacks for each user
        \App\Models\User::all()->each(function ($user) {
            \App\Models\Feedback::create([
                'sender_id' => $user->id,
                'receiver_id' => \App\Models\User::inRandomOrder()->first()->id,
                'is_public' => true,
                'message' => 'This is a public feedback.',
            ]);
        });
    }
}
