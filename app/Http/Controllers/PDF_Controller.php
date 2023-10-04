<?php

namespace App\Http\Controllers;

use App\Models\bookaction;
use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\purchasemodel;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use App\Models\studentlist;
use App\Models\UserStaff;
use App\Models\vendortable;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $pdf = PDF::loadView('print_pdf.myPDFpurchaseorder', compact('vendor', 'bookdata', 'transaction'));
        return $pdf->stream();
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
        $pdf = PDF::loadView('print_pdf.myPDFBadorder', compact('bookList', 'quantitylist'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //BookList REPORTS

    public function booklist_pdf()
    {
        // $books = booklist::where('ishide', false)->get();
        // $pdf = PDF::loadView('myPDFtbl', compact('books'));
        // return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->download('book_list.pdf')->stream();
        $books = booklist::where('ishide', false)->get();
        $pdf = PDF::loadView('print_pdf.myPDFtbl', [
            'books' => $books
        ]);
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->download('book_list.pdf');
    }

    public function generateCopies()
    {
        $books = booklist::where('ishide', false)->get();
        $pdf = PDF::loadView('print_pdf.myPDFtblcopies', compact('books'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //REPORTS ALL
    public function generateAction()
    {
        $books = bookaction::where('ishide', false)->get();
        $pdf = PDF::loadView('print_pdf.myPDFaction', compact('books'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generateBorrow($bookData, $borrower)
    {
        $bookList = [];
        $borrowedby = "";
        if ($borrower) {
            $word = 'employee';
            if (strpos($borrower, $word) !== false) {
                // Employee
                $data = explode(":", $borrower);
                $data = count($data) > 1 ? $data[1] : str_replace($word, '', $borrower);
                $value = UserStaff::where('email', $data)->first();
                $value = $value->staff;
                $designated = $value->job_description;
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = booklist::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                    $duedate = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('duedate');
                }
                $borrowedby =  $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            } else {
                // Student
                $data = explode(".", $borrower);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                $designated = $value->enrollment_assessment ?  $value->enrollment_assessment->year_level() . " " . $value->enrollment_assessment->course->course_code : '';
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = booklist::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                    $duedate = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('duedate');
                }
                $borrowedby = $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            }
        }

        $pdf = PDF::loadView('print_pdf.myPDFborrow', compact('bookList', 'transaction', 'duedate', 'borrowedby'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
    }


    public function generatereturndamage($bookData, $studentId)
    {
        $bookList = [];
        $value = [];
        if ($studentId) {
            $word = 'employee';
            if (strpos($studentId, $word) !== false) {
                // Employee
                $data = explode(":", $studentId);
                $data = count($data) > 1 ? $data[1] : str_replace($word, '', $studentId);
                $value = UserStaff::where('email', $data)->first();
                $value = $value->staff;
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = borrowpage::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                }
                $borrowedby =  $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            } else {
                // Student
                $data = explode(".", $studentId);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = borrowpage::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                }
                $borrowedby =  $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            }
        }


        $pdf = PDF::loadView('print_pdf.myPDFfined', compact('bookList', 'transaction', 'borrowedby'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
    }


    public function generateReturn($bookData, $student_number)
    {
        $bookList = [];
        $value = [];
        if ($student_number) {
            $word = 'employee';
            if (strpos($student_number, $word) !== false) {
                // Employee
                $data = explode(":", $student_number);
                $data = count($data) > 1 ? $data[1] : str_replace($word, '', $student_number);
                $value = UserStaff::where('email', $data)->first();
                $value = $value->staff;
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = borrowpage::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                }
                $borrowedby =  $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            } else {
                // Student
                $data = explode(".", $student_number);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                foreach (json_decode($bookData) as $book) {
                    $bookList[] = borrowpage::find($book);
                    $transaction = borrowpage::where('bookid', $book)
                        ->where('borrower', $data)->where('bookstatus', 'onlend')->value('transaction');
                }
                $borrowedby = $value->first_name . " " . $value->middle_name . " " . $value->last_name;
            }
        }

        $pdf = PDF::loadView('print_pdf.myPDFreturn', compact('bookList', 'transaction', 'borrowedby'));
        return $pdf->setPaper('612.00,1008.00', 'portrait')->stream();
    }



    public function generateAdjustment()
    {
        $adjustment = bookadjusment::where('ishide', false)->get();
        $pdf = PDF::loadView('print_pdf.myPDFadjustment', compact('adjustment'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }
    public function generateOnlend()
    {
        $borrow = borrowpage::where('ishide', false)->where('bookstatus', 'onlend')->get();
        $pdf = PDF::loadView('print_pdf.myPDFonlend', compact('borrow'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    public function generatereturnhistory()
    {
        $books = booklist::where('ishide', false)->get();
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'returned')->get();
        $student = studentlist::where('ishide', false)->get();
        $pdf = PDF::loadView('print_pdf.myPDFreturnhistory', compact('books', 'return', 'student'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }


    public function generatefinehistory()
    {
        $fine = borrowpage::where('bookstatus', 'fine')->get();
        $pdf = PDF::loadView('print_pdf.myPDFfinedhistory', compact('fine'));
        return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }

    //qr code
    public function generatePDF($data)
    {
        $book  = booklist::find($data);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate($book->accession));
        $pdf = PDF::loadView('print_pdf.myPDF', compact('qrcode', 'book'));
        return $pdf->stream();
    }


    public function bulkprint()
    {
        $books = booklist::where('ishide', false)->get();
        $qrCodesAndBooks = [];
        foreach ($books as $book) {
            if (isset($book->accession)) {
                $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate($book->accession));
                $qrCodesAndBooks[] = [
                    'qrcode' => $qrcode,
                    'book' => $book,
                ];
            }
        }
        $pdf = PDF::loadView('print_pdf.myPDF_BulkQr', compact('qrCodesAndBooks'));
        return $pdf->download('qrlist.pdf');
    }


    function print_statistic(Request $request)
    {

        $startingDate = $request->input('startingdate');
        $endDate =  $request->input('enddate');


        $startDate = Carbon::parse($startingDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();


        $onlendCounts = [];


        for ($day = $startDate; $day->lte($endDate); $day->addDay()) {
            if ($day->isWeekday()) {

                $count = borrowpage::whereDate('created_at', $day->toDateString())
                    ->count();

                $onlendCounts[$day->toDateString()] = $count;
            }
        }

        $pdf = PDF::loadView('print_pdf.myPDF_printStatistic', compact('onlendCounts', 'startingDate', 'endDate'));
        return $pdf->download('statistic.pdf');
    }


    function print_statisticR(Request $request)
    {

        $startingDate = $request->input('startingdate');
        $endDate =  $request->input('enddate');


        $startDate = Carbon::parse($startingDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();


        $returnedCounts = [];


        for ($day = $startDate; $day->lte($endDate); $day->addDay()) {
            if ($day->isWeekday()) {

                $count = borrowpage::where('bookstatus', 'returned')
                    ->whereDate('updated_at', $day->toDateString())
                    ->count();

                $returnedCounts[$day->toDateString()] = $count;
            }
        }

        $pdf = PDF::loadView('print_pdf.myPDF_printStatisticR', compact('returnedCounts', 'startingDate', 'endDate'));
        return $pdf->download('statistic.pdf');
    }
}
