<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    public function index()
    {
        return AuthorResource::collection(Author::with(['books'])->get());
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return AuthorResource::make($author);
    }

    public function show(Author $author)
    {
        return AuthorResource::make($author);
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return AuthorResource::make($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->noContent();
    }
}
