<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $lesson_ids = \App\Lesson::pluck('id')->toArray();
        $tag_ids = \App\Tag::pluck('id')->toArray();

        foreach (range(1, 30) as $index) {
            DB::table('lesson_tag')->insert([
                'lesson_id' => $faker->randomElement($lesson_ids),
                'tag_id' => $faker->randomElement($tag_ids),
            ]);
        }
    }
}
