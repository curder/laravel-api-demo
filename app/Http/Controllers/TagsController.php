<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Lesson;
use App\Http\Transformers\TagTransformer;

/**
 * Class TagsController
 */
class TagsController extends ApiController
{
    /**
     * @var \App\Http\Transformers\TagTransformer
     */
    protected $tagTransformer;

    /**
     * TagsController constructor.
     */
    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * @return mixed
     */
    public function index($LessonId = null)
    {
        $tags = $this->getTags($LessonId);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all()),
        ]);
    }

    public function show($id)
    {
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getTags($LessonId)
    {
        return $LessonId ? Lesson::findOrFail($LessonId)->tags : Tag::all();
    }
}
