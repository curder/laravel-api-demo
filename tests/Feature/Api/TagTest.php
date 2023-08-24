<?php

use App\Models\Tag;
use App\Models\Lesson;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\getJson;

uses(LazilyRefreshDatabase::class);

it('can show lesson tags', function () {
    $lesson = Lesson::factory()->create();
    $tag = Tag::factory()->create();
    $lesson->tags()->attach($tag);

    getJson('api/lessons/tags/'.$lesson->id)
        ->assertOk()
        ->assertJsonPath('data.0.name', $tag->name);
});

it('can show all tags', function () {
    $tag = Tag::factory()->create();

    getJson('api/lessons/tags')
        ->assertOk()
        ->assertJsonPath('data.0.name', $tag->name);
});
