<?php

use App\Http\Controllers\adjustmentcontroller;
use App\Http\Controllers\archivedcontroller;
use App\Http\Controllers\Bookhistory;
use App\Http\Controllers\BooklistController;
use App\Http\Controllers\Bookstatus;
use App\Http\Controllers\borrowpage;
use App\Http\Controllers\CopiesController;
use App\Http\Controllers\onlendcontroller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\returnhistory;
use App\Http\Controllers\Returnpage;
use App\Http\Controllers\StudentlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\booklist as ModelsBookList;
use App\Models\copies as ModelsCopies;

Auth::routes();



Route::get('/usermanual', function () {
    $books = ModelsBookList::where('ishide' , false)->get();
    return view('usermanual',compact('books'));
})->middleware(['auth', 'verified'])->name('usermanual');

Route::get('/bookaquired',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('bookaquired',compact('books'));
})->middleware(['auth', 'verified'])->name('bookaquired');


Route::get('/setting',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('setting');
})->middleware(['auth', 'verified'])->name('setting');


Route::middleware('auth','verified')->group(function () {
    

    Route::resource('copies',CopiesController::class);
    Route::resource('books',BooklistController::class);
    Route::resource('borrow',borrowpage::class);
   
    // return view
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/booklist', [BooklistController::class,'index'])->name('booklist');;
    Route::get('/returnpage',[Returnpage::class,'index'])->name('returnpage');
    Route::get('/borrowpage',[borrowpage::class,'index'])->name('borrowpage');
    Route::get('/bookstatus',[Bookstatus::class, 'index'])->name('bookstatus');
    Route::get('/bookhistory',[Bookhistory::class, 'index'])->name('bookhistory');
    Route::get('/adjustmenthistory',[adjustmentcontroller::class, 'index'])->name('adjustmenthistory');
    Route::get('/onlendhistory',[onlendcontroller::class, 'index'])->name('onlendhistory'); 
    Route::get('/returnhistory',[returnhistory::class, 'index'])->name('returnhistory'); 
    Route::get('/archivedhistory',[archivedcontroller::class, 'index'])->name('archivedhistory'); 
    
    Route::get('/myPDF/{data}',[PDFController::class,'generatePDF'])->name('myPDF');
    Route::get('/bookstatus/{data}/{studentid}',[BooklistController::class,'get_status']);
    Route::get('/book/{data}',[BooklistController::class,'get_book']);
    Route::get('/copy/{id}',[CopiesController::class,'get_copies']);
    Route::get('/student/{data}',[StudentlistController::class,'get_student']);
    Route::get('/generate-pdf/{data}', [PDFController::class, 'generatePDF']);
    Route::get('/generate-table', [PDFController::class, 'generateReports']);
    Route::get('/generate-action', [PDFController::class, 'generateAction']);
    Route::get('/generate-tblcopies', [PDFController::class, 'generateCopies']);
    Route::get('/generate-tblborrow/{id}', [PDFController::class, 'generateBorrow']);
    Route::get('/generate-tblreturn/{bookData}/{studentid}', [PDFController::class, 'generateReturn']);
    Route::get('/generate-tbladjustment', [PDFController::class, 'generateAdjustment']);
    Route::get('/generate-tblonlend', [PDFController::class, 'generateOnlend']);
    Route::get('/generate-tblreturnhistory', [PDFController::class, 'generatereturnhistory']);

    Route::post('/return/book',[Returnpage::class, 'update']);
    Route::post('/book/borrow',[borrowpage::class ,'storebookborrow']);
    Route::post('/book/update',[BooklistController::class,'updatebooks'])->name('books.update-book');
    Route::post('/copy/update',[CopiesController::class,'updatecopies'])->name('books.update-copy');
    Route::post('/copy/negativeupdate',[CopiesController::class,'updatecopiesnegative'])->name('books.updatenegative-copy');


});
