<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\DropdownBookResource;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function dropDownAllBooks()
    {
        return DropdownBookResource::collection(Book::all());
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return BookResource::make($book);
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return BookResource::make($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
