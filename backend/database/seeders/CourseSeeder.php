<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            [
                'name' => 'PHP',
                'descriptions' => 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.',
            ],
            [
                'name' => 'Java',
                'descriptions' => 'Java is a programming language and computing platform first released by Sun Microsystems in 1995.',
            ],
            [
                'name' => 'C#',
                'descriptions' => 'C# is a general-purpose, multi-paradigm programming language encompassing strong typing, lexically scoped, imperative, declarative, functional, generic, object-oriented, and component-oriented programming disciplines.',
            ]
        ];
        
        Course::insert($data);
        // \DB::table('courses')->insert($data);
    }
}
