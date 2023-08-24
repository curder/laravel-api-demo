<?php
namespace Database\Seeders;

use App\Lesson;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Tag;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder {
	/**
	 * @var array
	 */
	protected $tables = [
		'tags',
		'lessons',
		'lesson_tag'
	];

	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
        // $this->call(UserSeeder::class);

		$this->cleanDatabase();
		factory( User::class, 5 )->create();
		factory( Product::class, 50 )->create();
		factory( Review::class, 300 )->create();

		factory( Lesson::class, 40 )->create();
		factory( Tag::class, 10 )->create();
		$this->call( LessonTagTableSeeder::class );
	}


	protected function cleanDatabase() {
		DB::statement( 'SET FOREIGN_KEY_CHECKS=0' );

		foreach ( $this->tables as $tableName ) {
			DB::table( $tableName )->truncate();
		}

		DB::statement( 'SET FOREIGN_KEY_CHECKS=1' );
	}
}
