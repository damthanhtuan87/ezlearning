<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'course_id' => 1,
                'name' => 'PHP Basic',
                'description' => 'PHP Basic',
                'time_practice' => 10,
            ],
            [
                'course_id' => 1,
                'name' => 'PHP Advanced',
                'description' => 'PHP Advanced',
                'time_practice' => 10,
            ],
            [
                'course_id' => 2,
                'name' => 'Java Basic',
                'description' => 'Java Basic',
                'time_practice' => 10,
            ],
            [
                'course_id' => 2,
                'name' => 'Java Advanced',
                'description' => 'Java Advanced',
                'time_practice' => 10,
            ],
            [
                'course_id' => 3,
                'name' => 'C# Basic',
                'description' => 'C# Basic',
                'time_practice' => 10,
            ],
            [
                'course_id' => 3,
                'name' => 'C# Advanced',
                'description' => 'C# Advanced',
                'time_practice' => 10,
            ]
        ];

        \DB::table('topics')->insert($data);
    }
}
