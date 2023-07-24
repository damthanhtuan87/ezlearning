<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'PHP',
            'descriptions' => 'PHP is a popular server-side scripting language used for web development.',
        ]);

        Course::create([
            'name' => 'REACT',
            'descriptions' => 'React is a JavaScript library for building user interfaces.',
        ]);

        Course::create([
            'name' => 'VUE',
            'descriptions' => 'Vue.js is a progressive JavaScript framework for building interactive web interfaces.',
        ]);

        Course::create([
            'name' => 'GOLANG',
            'descriptions' => 'Go (Golang) is an open-source programming language developed by Google.',
        ]);

        Course::create([
            'name' => 'LARAVEL',
            'descriptions' => 'Laravel is a PHP framework used for building web applications.',
        ]);

        Course::create([
            'name' => 'NEXT',
            'descriptions' => 'Next.js is a React framework for building server-side rendered (SSR) applications.',
        ]);

        Course::create([
            'name' => 'C',
            'descriptions' => 'C is a general-purpose, procedural programming language.',
        ]);

        Course::create([
            'name' => 'C++',
            'descriptions' => 'C++ is a powerful, general-purpose programming language.',
        ]);

        Course::create([
            'name' => 'JAVA',
            'descriptions' => 'Java is a widely used, object-oriented programming language.',
        ]);

        Course::create([
            'name' => 'NODE',
            'descriptions' => 'Node.js is a JavaScript runtime used for building scalable network applications.',
        ]);

        Course::create([
            'name' => 'SQL',
            'descriptions' => 'SQL (Structured Query Language) is used for managing and manipulating relational databases.',
        ]);
    }
}
