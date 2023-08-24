<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

use function Pest\Laravel\getJson;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;

uses(LazilyRefreshDatabase::class);

it('can fetch products', function () {
    getJson('api/products')
        ->assertOk()
        ->assertJsonCount(0, 'data')
        ->assertJsonStructure(['data', 'links', 'meta']);

    Product::factory()->create();
    getJson('api/products')
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

it('authenticate user can store product', function () {
    $product = [
        'name' => 'iPhone 15',
        'description' => 'The Best ever phone with face ID',
        'price' => 12000,
        'stock' => 10,
        'discount' => 50,
    ];
    postJson('api/products', $product)
        ->assertUnauthorized();

    actingAs(User::factory()->create(), 'api')
        ->assertAuthenticated()
        ->postJson('api/products', $product)
        ->assertCreated()
        ->assertJsonIsObject('data')
        ->assertJsonPath('data.name', $product['name'])
        ->assertJsonStructure(['data']);
    expect(Product::query()->count())->toBe(1);
});

it('can show product', function () {
    $product = Product::factory()->create();
    getJson('api/products/'.$product->id)
        ->assertJsonPath('data.name', $product->name)
        ->assertJsonStructure(['data'])
        ->assertOk();
    expect(Product::query()->count())->toBe(1);
});

it('can update self product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    actingAs($user, 'api')
        ->putJson('api/products/'.$product->id, [
            'description' => 'new description',
        ])
        ->assertJson(['errors' => 'product not belongs to user.']);

    $product2 = Product::factory()->for($user)->create();
    actingAs($user, 'api')
        ->putJson('api/products/'.$product2->id, [
            'description' => 'new description',
        ])->assertJsonPath('data.description', 'new description');
});

it('can delete product', function () {
    $product = Product::factory()->create();

    deleteJson('api/products/'.$product->id)
        ->assertUnauthorized();

    actingAs($product->user, 'api')
        ->deleteJson('api/products/'.$product->id)
        ->assertNoContent();
});
