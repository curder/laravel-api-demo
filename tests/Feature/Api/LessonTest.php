<?php

use App\Models\Lesson;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\getJson;

uses(LazilyRefreshDatabase::class);

it('can show lessons', function () {
    getJson('api/lessons')
        ->assertOk()
        ->assertJsonStructure(['data', 'paginator']);

    Lesson::factory()->create();
    getJson('api/lessons')
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

it('can show lesson', function () {
    $lesson = Lesson::factory()->create();

    getJson("api/lessons/{$lesson->id}")
        ->assertOk()
        ->assertJsonStructure(['data']);
});

it('can create lesson', function () {
    $data = Lesson::factory()->raw();

    getJson('api/lessons', ['json' => $data])
        ->assertCreated()
        ->assertJsonStructure(['data']);
});

it('can update lesson', function () {
    getJson('api/lessons/100')
        ->assertNotFound()
        ->assertJsonPath('error.message', 'Lesson dose not exists.');

    $lesson = Lesson::factory()->create();

    getJson('api/lessons/'.$lesson->id)
        ->assertOk()
        ->assertJsonStructure(['data']);
});
