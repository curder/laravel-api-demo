<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Exceptions\ProductNotBelongsToUserException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductCollection::collection(Product::query()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): Response
    {
        $product = Product::query()->create([
            'name' => $request->name,
            'detail' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);

        return response([
            'data' => new ProductResource($product),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Throwable
     */
    public function update(Request $request, Product $product): Response
    {
        throw_if($request->user()->id !== $product->user_id, new ProductNotBelongsToUserException);

        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());

        return response([
            'data' => new ProductResource($product),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
