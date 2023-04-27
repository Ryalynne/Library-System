<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\copies;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller

{

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

    public function generateBorrow($bookData)
    {
        $bookList = [];
        foreach (json_decode($bookData) as $book) {
          $bookList[] = booklist::find($book);
        }
         $pdf = PDF::loadView('myPDFborrow', compact('bookList'));
         return $pdf->setPaper('0,0,612.00,1008.00', 'landscape')->stream();
    }
}
