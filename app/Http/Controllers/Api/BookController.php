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
    /**
     * @OA\Get(
     *   path="/books",
     *   operationId="indexBooks",
     *   tags={"Books"},
     *   summary="Listado de libros",
     *   @OA\Response(
     *     response=200,
     *     description="Listado de libros",
     *     @OA\JsonContent(
     *             @OA\Property(
     *                  type="array",
     *                  property="data",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          example="Harry Potter"
     *                      )
     *                  )
     *             ),
     *          )
     *   ),
     *   @OA\Response(
     *     response="404",
     *     description="Pagina no encontrada"
     *   )
     * )
     */
    public function index()
    {
        return BookResource::collection(Book::with(['authors', 'chapters'])->get());
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
