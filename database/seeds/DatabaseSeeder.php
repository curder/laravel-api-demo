<?php

use App\Lesson;
use App\Models\Product;
use App\Models\Review;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory( User::class, 5 )->create();
		factory( Product::class, 50 )->create();
		factory( Review::class, 300 )->create();
		factory( Lesson::class, 40 )->create();
	}
}
