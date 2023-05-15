<?php

namespace App\Http\Controllers;

use App\Models\bookaction;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class BooklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = booklist::where('ishide' , false)->paginate(10); 
        return view('booklist',compact('books'));
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'isbn' => 'required|numeric',
                'author' => 'required',
                'publisher' => 'required',
                'datepublish' => 'required|date',
                'booktitle' => 'required',
                'genre' => 'required',
                'copies' => 'required|numeric|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }

            $book = booklist::create([
                'booktitle' => $request->booktitle,
                'author' => $request->author,
                'datepublish' => $request->datepublish,
                'publisher' => $request->publisher,
                'isbn' => $request->isbn,
                'genre' => $request->genre,
            ]);
            copies::create([
                'bookid' => $book->id,
                'action' => "added",
                'copies' => $request->copies
            ]);

            bookaction::create([
                'bookid' => $book->id,
                'action' => "added",
                'performby' => Auth::user()->name
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Book Added Successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function show(booklist $booklist)
    {
        //
    }

    public function edit(booklist $booklist)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booklist $booklist)
    {
    }

    public function destroy(booklist $booklist)
    {
        //
    }

    public function updatebooks(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'isbn' => 'required|numeric',
                'booktitle' => 'required',
                'author' => 'required',
                'datepublish' => 'required|date',
                'publisher' => 'required',
                'genre' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }

            $book = booklist::find($request->id);
            $book->update([
                'isbn' => $request->isbn,
                'booktitle' => $request->booktitle,
                'author' => $request->author,
                'datepublish' => $request->datepublish,
                'publisher' => $request->publisher,
                'genre' => $request->genre
            ]);
            bookaction::create([
                'bookid' => $book->id,
                'action' => "updated the book",
                'performby' => Auth::user()->name
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Book updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function get_book($data)
    {
        $book = booklist::find($data);
        return compact('book');
    }

    public function get_status($data, $studentid)
    {
        $bookstatus = borrowpage::join('booklists', 'booklists.id', 'borrowpages.bookid')
            ->join('copies', 'copies.bookid', 'borrowpages.bookid')
            ->where('borrowpages.studentid', $studentid)
            ->where('borrowpages.bookid', $data)
            ->orderBy('borrowpages.id', 'desc')->first();
        return compact('bookstatus');
    }
}
