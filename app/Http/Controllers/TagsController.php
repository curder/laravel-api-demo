<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use App\Http\Transformers\TagTransformer;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TagsController
 */
class TagsController extends ApiController
{
    protected TagTransformer $tagTransformer;

    /**
     * TagsController constructor.
     */
    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    public function index($lesson_id = null): JsonResponse
    {
        $tags = $this->getTags($lesson_id);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all()),
        ]);
    }

    protected function getTags($lesson_id): Collection
    {
        return $lesson_id ? optional(Lesson::query()->find($lesson_id))->tags : Tag::all();
    }
}
