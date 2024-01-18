<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class qrImage extends Controller
{
    public function index($id)
    {
        $book = booklist::find($id);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate($book->accession));
        return view('print_pdf.qrcode_image', compact('qrcode', 'book'));
    }
    
}
