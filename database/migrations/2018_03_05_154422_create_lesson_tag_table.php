<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTagTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'lesson_tag', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->unsignedInteger( 'lesson_id' )->index();
			$table->foreign( 'lesson_id' )->references( 'id' )->on( 'lessons' )->onDelete( 'cascade' );
			$table->unsignedInteger( 'tag_id' )->index();
			$table->foreign( 'tag_id' )->references( 'id' )->on( 'tags' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'lesson_tag' );
	}
}
