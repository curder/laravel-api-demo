<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ProductNotBelongsToUserException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): AnonymousResourceCollection
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request, Product $product): Response
    {
        $review = new Review($request->all());

        $product->reviews()->save($review);

        return response([
            'data' => new ReviewResource($review),
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, Review $review): Response
    {
        $review->update($request->all());

        return response([
            'data' => new ReviewResource($review),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Throwable
     */
    public function destroy(Request $request, Product $product, Review $review): Response
    {
        throw_if($request->user()->id !== $product->user_id, new ProductNotBelongsToUserException);

        $review->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
