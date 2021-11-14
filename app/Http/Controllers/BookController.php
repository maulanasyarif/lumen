<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function index()
    {
        $book = Book::all();
        return response()->json($book);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "name" => "required|unique:book",
            "price" => "required",
            "status" => "required"
        ]);
        
        $data = $request->all();
        $book = Book::create($data);

        return response()->json($book);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        
        if(!$book)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $this->validate($request, [
            "name" => "required|unique:book",
            "price" => "required",
            "status" => "required"
        ]);

        $data = $request->all();
        $book->fill($data);
        $book->save($data);

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if(!$book)
        {
            return response()->json(['message' => 'Data not found']);
        }
        
        $book->delete();
        return response()->json(['message' => 'Book has been deleted']);
    }
}