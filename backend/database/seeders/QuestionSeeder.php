<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
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
                'content' => 'PHP is a ________ language.',
                'topic_id' => 1,
                'description' => 'PHP is a server-side scripting language, which is a powerful tool for making dynamic and interactive Web pages.',
            ],
            [
                'content' => 'PHP files have a default file extension of ________.',
                'topic_id' => 1,
                'description' => 'PHP files have a default file extension of ".php".',
            ],
            [
                'content' => 'Which of the following is correct about PHP?',
                'topic_id' => 1,
                'description' => 'All of the above.',
            ],
            // Topic 2
            [
                'content' => 'Which of the following is correct about PHP?',
                'topic_id' => 2,
                'description' => 'All of the above.',
            ],
            // Topic 3
            [
                'content' => 'Which of the following is correct about Java?',
                'topic_id' => 3,
                'description' => 'All of the above.',
            ],
            // Topic 4
            [
                'content' => 'Which of the following is correct about Java?',
                'topic_id' => 4,
                'description' => 'All of the above.',
            ],
            // Topic 5
            [
                'content' => 'Which of the following is correct about C#?',
                'topic_id' => 5,
                'description' => 'All of the above.',
            ],
            // Topic 6
            [
                'content' => 'Which of the following is correct about C#?',
                'topic_id' => 6,
                'description' => 'All of the above.',
            ],
        ];

        \DB::table('questions')->insert($data);
    }
}
