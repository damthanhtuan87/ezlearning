<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
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
                'question_id' => 1,
                'content' => 'Server-side',
                'is_correct' => 1,
            ],
            [
                'question_id' => 1,
                'content' => 'Client-side',
                'is_correct' => 0,
            ],
            [
                'question_id' => 1,
                'content' => 'Browser-side',
                'is_correct' => 0,
            ],
            [
                'question_id' => 1,
                'content' => 'Above all',
                'is_correct' => 0,
            ],
            [
                'question_id' => 2,
                'content' => '.html',
                'is_correct' => 0,
            ],
            [
                'question_id' => 2,
                'content' => '.xml',
                'is_correct' => 0,
            ],
            [
                'question_id' => 2,
                'content' => '.php',
                'is_correct' => 1,
            ],
            [
                'question_id' => 2,
                'content' => '.js',
                'is_correct' => 0,
            ],
            [
                'question_id' => 3,
                'content' => 'PHP stands for "PHP: Hypertext Preprocessor"',
                'is_correct' => 0,
            ],
            [
                'question_id' => 3,
                'content' => 'PHP is a widely-used, open source scripting language',
                'is_correct' => 0,
            ],
            [
                'question_id' => 3,
                'content' => 'PHP scripts are executed on the server',
                'is_correct' => 0,
            ],
            [
                'question_id' => 3,
                'content' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'question_id' => 4,
                'content' => 'PHP files can contain text, HTML, CSS, JavaScript, and PHP code',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4,
                'content' => 'PHP code are executed on the server, and the result is returned to the browser as plain HTML',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4,
                'content' => 'PHP files have extension ".php"',
                'is_correct' => 0,
            ],
            [
                'question_id' => 4,
                'content' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'question_id' => 5,
                'content' => 'PHP stands for "PHP: Hypertext Preprocessor"',
                'is_correct' => 0,
            ],
            [
                'question_id' => 5,
                'content' => 'PHP is a widely-used, open source scripting language',
                'is_correct' => 0,
            ],
            [
                'question_id' => 5,
                'content' => 'PHP scripts are executed on the server',
                'is_correct' => 0,
            ],
            [
                'question_id' => 5,
                'content' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'question_id' => 6,
                'content' => 'PHP files can contain text, HTML, CSS, JavaScript, and PHP code',
                'is_correct' => 0,
            ],
            [
                'question_id' => 6,
                'content' => 'PHP code are executed on the server, and the result is returned to the browser as plain HTML',
                'is_correct' => 0,
            ],
            [
                'question_id' => 6,
                'content' => 'PHP files have extension ".php"',
                'is_correct' => 0,
            ],
            [
                'question_id' => 6,
                'content' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'question_id' => 7,
                'content' => 'PHP stands for "PHP: Hypertext Preprocessor"',
                'is_correct' => 0,
            ],
            [
                'question_id' => 7,
                'content' => 'PHP is a widely-used, open source scripting language',
                'is_correct' => 0,
            ],
            [
                'question_id' => 7,
                'content' => 'PHP scripts are executed on the server',
                'is_correct' => 0,
            ],
            [
                'question_id' => 7,
                'content' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'question_id' => 8,
                'content' => 'PHP files can contain text, HTML, CSS, JavaScript, and PHP code',
                'is_correct' => 0,
            ],
        ];

        \DB::table('answers')->insert($data);
    }
}
