<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\LessonTransformer;

/**
 * Class LessonController
 */
class LessonController extends ApiController
{
    /**
     * @var \App\Http\Transformers\LessonTransformer
     */
    protected $lessonTransformer;

    /**
     * LessonController constructor.
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = request('limit', 3);
        $lessons = Lesson::paginate($limit);

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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (! $lesson) {
            return $this->respondNotFound('Lesson dose not exists.');
        }

        return $this->respond([
            'date' => $this->lessonTransformer->transform($lesson),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
