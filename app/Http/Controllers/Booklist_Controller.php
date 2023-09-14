<?php

namespace App\Http\Controllers;

use App\Imports\BookListImport;
use App\Imports\UsersImport;
use App\Models\bookaction;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\StudentAccount;
use App\Models\UserStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class Booklist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = booklist::where('ishide', false)->paginate(50);
        return view('books.book_list', compact('books'));
    }

    public function updateback($id)
    {
        $book = booklist::find($id);
        $book->ishide = false;
        $book->save();
        return response()->json([
            'message' => 'Book updated successfully'
        ]);
    }


    public function updateremove($id)
    {
        $book = booklist::find($id);
        bookaction::create([
            'bookid' => $book->id,
            'action' => "remove the book",
            'performby' => Auth::user()->name
        ]);
        $book->ishide = true;
        $book->save();
        return response()->json([
            'message' => 'Book updated successfully'
        ]);
    }

    public function getnumber($id)
    {
        $data = copies::where('bookid', $id)->where('action', 'lessen')->sum('copies');
        $fine = borrowpage::where('bookid', $id)->where('bookstatus', 'fine')->count();
        $minis = $data + $fine;
        $onlend = borrowpage::where('bookid', $id)->where('bookstatus', 'onlend')->count();
        $subtotal =  copies::where('bookid', $id)->where('action', 'added')->sum('copies') + $onlend;
        $total = $subtotal - $minis;
        return $total;
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'copies' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }

            $book = booklist::create([
                'title' => $request->title,
                'author' => $request->author,
                'department' => $request->department,
                'copyright' => $request->copyright,
                'accession' => $request->accession,
                'callnumber'  => $request->callnumber,
                'subject' => $request->subject,
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

    public function updatebooks(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            $book = booklist::find($request->id);
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'department' => $request->department,
                'copyright' => $request->copyright,
                'accession' => $request->accession,
                'subject' => $request->subject,
                'callnumber' => $request->callnumber
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
        $book = BookList::join('copies', 'booklists.id', 'copies.bookid')
            ->where('booklists.id', $data)
            ->where('booklists.ishide', false)
            ->orderBy('booklists.id', 'desc')
            ->first();
        return compact('book');
    }

    public function get_bookarchived($id)
    {
        $book = booklist::where('id', $id)->where('ishide', true)->first();
        return compact('book');
    }

    public function get_bookcopies($data)
    {
        $id = booklist::where('accession', $data)->value('id');
        $totalLessen = copies::where('bookid', $id)
            ->where('action', 'lessen')->sum('copies');

        $totalCopies = copies::where('bookid', $id)
            ->where('action', 'added')
            ->sum('copies');

        $totalFine = borrowpage::where('bookid', $id)
            ->where('bookstatus', 'fine')
            ->count();

        $totalOnLend = borrowpage::where('bookid', $id)
            ->where('bookstatus', 'onlend')
            ->count();

        $minus  = $totalOnLend + $totalFine + $totalLessen;
        $total = $totalCopies - $minus;

        if ($total >= 1) {
            $book = BookList::join('copies', 'booklists.id', 'copies.bookid')
                ->where('booklists.id', $id)
                ->where('booklists.ishide', false)
                ->orderBy('booklists.id', 'desc')
                ->first();

            return compact('book');
        } else {
            $message = 'The book is not available.';
            return compact('message');
        }
    }

    public function get_status($bookid, Request $request)
    {
        $value = [];
        $id = booklist::where('accession', $bookid)->value('id');
        
        if ($request->data) {
            $word = 'employee';
            if (strpos($request->data, $word) !== false) {
                // Employee
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = UserStaff::where('email', $data)->first();
                return borrowpage::join('booklists', 'booklists.id', 'borrowpages.bookid')
                    ->join('copies', 'copies.bookid', 'borrowpages.bookid')
                    ->where('borrowpages.studentid', $value->email)
                    ->where('borrowpages.bookid', $id)
                    ->orderBy('borrowpages.id', 'desc')->first();
            } else {
                // Student
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                return borrowpage::join('booklists', 'booklists.id', 'borrowpages.bookid')
                    ->join('copies', 'copies.bookid', 'borrowpages.bookid')
                    ->where('borrowpages.studentid', $value->student_number)
                    ->where('borrowpages.bookid', $id)
                    ->orderBy('borrowpages.id', 'desc')->first();
            }
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        $file = $request->file('file');
        Excel::import(new BookListImport, $file);
        return redirect('/booklist')->with('success', 'Import completed successfully.');
    }
}
