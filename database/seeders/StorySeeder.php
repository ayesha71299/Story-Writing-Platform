<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Story::create([
            'title' => 'First Story',
            'description' => 'This is a sample story description.',
            'user_id' => 1,
            'status' => 'published',
        ]);
    }
}
