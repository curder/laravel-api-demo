<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Transformers\LessonTransformer;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class LessonController
 */
class LessonController extends ApiController
{
    protected LessonTransformer $lessonTransformer;

    /**
     * LessonController constructor.
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $limit = request('limit', 3);
        /** @var LengthAwarePaginator $lessons */
        $lessons = Lesson::query()->paginate($limit);

        return $this->respondWithPagination($lessons, ['data' => $this->lessonTransformer->transformCollection($lessons->all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $lesson = Lesson::query()->find($id);

        if (! $lesson) {
            return $this->respondNotFound('Lesson dose not exists.');
        }

        return $this->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_OK)
            ->respond([
                'data' => $this->lessonTransformer->transform($lesson),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
