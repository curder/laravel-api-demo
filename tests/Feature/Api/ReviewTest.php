<?php

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;

uses(LazilyRefreshDatabase::class);

it('can show reviews', function () {
    $review = Review::factory()->create();

    getJson('api/products/'.$review->product->id.'/reviews')
        ->assertJsonCount(1, 'data')
        ->assertOk();
});

it('can store product review', function () {
    $product = Product::factory()->create();

    postJson('api/products/'.$product->id.'/reviews')
        ->assertUnauthorized();

    actingAs($product->user, 'api')
        ->postJson('api/products/'.$product->id.'/reviews', [
            'customer' => 'anor',
            'star' => 3,
            'review' => 'best thing on review',
        ])->assertCreated();
    expect(Review::query())
        ->count()->toBe(1)
        ->first()->product_id->toBe($product->id);
});
it('can update product review', function () {
    $review = Review::factory()->for(Product::factory())->create();

    putJson('api/products/'.$review->product->id.'/reviews/'.$review->id)
        ->assertUnauthorized();

    actingAs($review->product->user, 'api')
        ->putJson('api/products/'.$review->product->id.'/reviews/'.$review->id, [
            'customer' => 'new customer',
        ])
        ->assertOk()
        ->assertJsonPath('data.customer', 'new customer');
});

it('can delete self product review', closure: function () {
    $review = Review::factory()->for(Product::factory())->create();

    deleteJson('api/products/'.$review->product->id.'/reviews/'.$review->id)
        ->assertUnauthorized();

    actingAs(User::factory()->create(), 'api')
        ->deleteJson('api/products/'.$review->product->id.'/reviews/'.$review->id)
        ->assertJson(['errors' => 'product not belongs to user.']);

    actingAs($review->product->user, 'api')
        ->deleteJson('api/products/'.$review->product->id.'/reviews/'.$review->id)
        ->assertNoContent();
    expect(Review::query())
        ->count()->toBe(0);
});
