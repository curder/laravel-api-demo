<?php

test('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('http.controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller')
    ->toBeClasses();

test('models')
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend('Illuminate\Database\Eloquent\Model');

test('providers')
    ->expect('App\Providers')
    ->toHaveSuffix('ServiceProvider')
    ->toBeClasses()
    ->toExtend('Illuminate\Support\ServiceProvider');
