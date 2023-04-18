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
        // return $pdf->download('itsolutionstuff.pdf');
    }
}
