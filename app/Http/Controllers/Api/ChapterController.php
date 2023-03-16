<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Http\Resources\ChapterResource;

class ChapterController extends Controller
{
    public function index()
    {
        return ChapterResource::collection(Chapter::with(['book'])->paginate(2));
    }

    public function store(StoreChapterRequest $request)
    {
        $chapter = Chapter::create($request->validated());

        return ChapterResource::make($chapter);
    }

    public function show(Chapter $chapter)
    {
        return ChapterResource::make($chapter);
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->validated());

        return ChapterResource::make($chapter);
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return response()->noContent();
    }
}
