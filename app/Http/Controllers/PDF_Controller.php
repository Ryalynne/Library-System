<?php

namespace App\Http\Controllers;
use App\Models\bookaction;
use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\purchasemodel;
use App\Models\StudentAccount;
use App\Models\studentlist;
use App\Models\vendortable;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDF_Controller extends Controller

{
    function __construct()
    {
        ini_set('max_execution_time', 6000); //3 minutes   
    }
    
    public function generatePurchaseOrder($booktitle, $id)
    {
        $bookdata = [];
        $vendor = vendortable::where('id', $id)->value('vendorname');

        foreach (json_decode($booktitle) as $book) {
            $bookDataItem = purchasemodel::find($book);
            if ($bookDataItem) {
                $bookdata[] = $bookDataItem;
            }
        }

        // Check if $bookdata is empty after filtering
        if (empty($bookdata)) {
            // Handle the case when $bookdata is empty (no valid books found)
            return response()->json(['message' => 'No valid books found. Purchase order generation skipped.']);
        }

        $transaction = purchasemodel::where('vendorid', $id)->where('status', 'pending')->latest('transaction')->first();
        $pdf = PDF::loadView('myPDFpurchaseorder', compact('vendor', 'bookdata', 'transaction'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }


    public function generateBadorder($bookid, $quantity)
    {
        $bookList = [];
        $quantitylist = [];

        foreach (json_decode($bookid) as $book) {
            $bookList[] = purchasemodel::find($book);
        }
        foreach (json_decode($quantity) as $qty) {
            $quantitylist[] = $qty;
        }

        // $transaction = purchasemodel::where('bookid', $book)->where('bookstatus', 'onlend')->value('transaction');

        ///duedate need kuhain
        $pdf = PDF::loadView('myPDFBadorder', compact('bookList', 'quantitylist'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //BookList REPORTS

    public function generatePDF($data)
    {
        $book  = booklist::find($data);
        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($book->accession));
        $pdf = PDF::loadView('myPDF', compact('qrcode', 'book'));
        return $pdf->stream();
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

    public function generateBorrow($bookData, $student_number)
    {
        $bookList = [];
        $student = StudentAccount::where('student_number', $student_number)->first();
        $student = $student->student;
        foreach (json_decode($bookData) as $book) {
            $bookList[] = booklist::find($book);
            $transaction = borrowpage::where('bookid', $book)
                ->where('studentid', $student->id)->where('bookstatus', 'onlend')->value('transaction');
            $duedate = borrowpage::where('bookid', $book)
                ->where('studentid', $student->id)->where('bookstatus', 'onlend')->value('duedate');
        }
        ///duedate need kuhain
        $pdf = PDF::loadView('myPDFborrow', compact('bookList', 'transaction', 'student', 'duedate'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
    }


    public function generatereturndamage($bookData, $studentId)
    {
        $bookList = [];
        $student = StudentAccount::where('student_number', $studentId)->first();
        $student = $student->student;

        foreach (json_decode($bookData) as $book) {
            $bookList[] = borrowpage::find($book);
            $transaction = borrowpage::where('bookid', $book)
                ->where('studentid', $student)->where('bookstatus', 'onlend')->value('transaction');
        }
        $pdf = PDF::loadView('myPDFfined', compact('bookList', 'transaction', 'student'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
    }


    public function generateReturn($bookData, $student_number)
    {
        $bookList = [];
        $account = StudentAccount::where('student_number', $student_number)->first();
        $student = $account->student;

        foreach (json_decode($bookData) as $book) {
            $bookList[] = borrowpage::find($book);
            $transaction = borrowpage::where('bookid', $book)
                ->where('studentid', $student->id)->where('bookstatus', 'onlend')->value('transaction');
        }
        $pdf = PDF::loadView('myPDFreturn', compact('bookList', 'transaction', 'student'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
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


    public function generatefinehistory()
    {
        $fine = borrowpage::where('bookstatus', 'fine')->get();
        $pdf = PDF::loadView('myPDFfinedhistory', compact('fine'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

  public function bulkprint()
{
    $books = booklist::all();
    $qrCodesAndBooks = [];
    foreach ($books as $book) {
        if (isset($book->accession)) {
            $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($book->accession));
            $qrCodesAndBooks[] = [
                'qrcode' => $qrcode,
                'book' => $book,
            ];
        }
    }
    $pdf = PDF::loadView('myPDF_BulkQr', compact('qrCodesAndBooks'));
    return $pdf->download('qrlist.pdf');
}

    
}
