<?php

namespace App\Http\Controllers;

use App\Models\bookaction;
use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller

{

    //BookList REPORTS

    public function generatePDF($data)
    {
        $book  = booklist::find($data);
        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($data));
        $pdf = PDF::loadView('myPDF', compact('qrcode', 'book'));
        return $pdf->stream();
        //$pdf = PDF::loadView('myPDF');
        //return $pdf->download('itsolutionstuff.pdf');
    }


    public function generateReports()
    {
        $books = booklist::where('ishide', false)->get();
        $pdf = PDF::loadView('myPDFtbl', compact('books'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generateCopies()
    {
        $books = booklist::where('ishide', false)->get();
        $pdf = PDF::loadView('myPDFtblcopies', compact('books'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //REPORTS ALL
    public function generateAction()
    {
        $books = bookaction::where('ishide', false)->get();
        $pdf = PDF::loadView('myPDFaction', compact('books'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //Process Reports

    // public function generateBorrow($bookData)
    // {
    //     $bookList = [];
    //     foreach (json_decode($bookData) as $book) {
    //         $bookList[] = booklist::find($book);
    //     }
    //     $pdf = PDF::loadView('myPDFborrow', compact('bookList'));
    //     return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    // }
    public function generateBorrow($bookData , $studentId)
    {
        $bookList = [];
        $student = studentlist::where('studentno', $studentId)->value('id');
        $name = studentlist::where('studentno', $studentId)->value('name');
        $middle = studentlist::where('studentno', $studentId)->value('middle');
        $lastname = studentlist::where('studentno', $studentId)->value('lastname');

        foreach (json_decode($bookData) as $book) {
            $bookList[] = booklist::find($book);
            $transaction = borrowpage::where('bookid', $book)
                ->where('studentid', $student)->where('bookstatus', 'onlend')->value('transaction');
        }
        $pdf = PDF::loadView('myPDFborrow', compact('bookList','transaction','name','middle','lastname'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }




    public function generateReturn($bookData)
    {
        $bookList = [];
        foreach (json_decode($bookData) as $book) {
            $bookList[] = borrowpage::find($book);
        }
        $pdf = PDF::loadView('myPDFreturn', compact('bookList'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }



    public function generateAdjustment()
    {
        $adjustment = bookadjusment::where('ishide', false)->get();
        $pdf = PDF::loadView('myPDFadjustment', compact('adjustment'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }
    public function generateOnlend()
    {
        $borrow = borrowpage::where('ishide', false)->where('bookstatus', 'onlend')->get();
        $pdf = PDF::loadView('myPDFonlend', compact('borrow'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generatereturnhistory()
    {
        $books = booklist::where('ishide', false)->get();
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'returned')->get();
        $student = studentlist::where('ishide', false)->get();
        $pdf = PDF::loadView('myPDFreturnhistory', compact('books', 'return', 'student'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generatereturndamage($bookData)
    {
        $bookList = [];
        foreach (json_decode($bookData) as $book) {
            $bookList[] = borrowpage::find($book);
        }
        $pdf = PDF::loadView('myPDFfined', compact('bookList'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generatefinehistory()
    {
        $fine = borrowpage::where('bookstatus', 'fine')->get();
        $pdf = PDF::loadView('myPDFfinedhistory', compact('fine'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }
}
