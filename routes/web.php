<?php

use App\Http\Controllers\BooklistController;
use App\Http\Controllers\borrowpage;
use App\Http\Controllers\CopiesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StudentlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\booklist as ModelsBookList;
use App\Models\copies as ModelsCopies;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('/');

Route::get('/borrowpage',[borrowpage::class,'index'])->middleware(['auth', 'verified'])->name('borrowpage');

Route::get('/booklist', function () {
    $copies = ModelsCopies::where('ishide' , false)->get();
    $books = ModelsBookList::where('ishide' , false)->paginate(10); 
    return view('booklist',compact('books'));
})->middleware(['auth', 'verified'])->name('booklist');

Route::get('/bookstatus', function () {
    $copies = ModelsCopies::where('ishide' , false)->get();
    $books = ModelsBookList::where('ishide' , false)->get();
    return view('bookstatus',compact('books'));
})->middleware(['auth', 'verified'])->name('bookstatus');

Route::get('/usermanual', function () {
    $books = ModelsBookList::where('ishide' , false)->get();
    return view('usermanual',compact('books'));
})->middleware(['auth', 'verified'])->name('usermanual');

Route::get('/bookaquired',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('bookaquired',compact('books'));
})->middleware(['auth', 'verified'])->name('bookaquired');

Route::get('/returnpage',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('returnpage',compact('books'));
})->middleware(['auth', 'verified'])->name('returnpage');

Route::get('/bookhistory',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('bookhistory',compact('books'));
})->middleware(['auth', 'verified'])->name('bookhistory');

Route::get('/setting',function() {
    $books = ModelsBookList::where('ishide' , false)->paginate(10);
    $copies = ModelsCopies::where('ishide' , false)->get();
    return view('setting');
})->middleware(['auth', 'verified'])->name('setting');

Route::middleware('auth','verified')->group(function () {
    
    
    //para maaccess lahat ng resource

    Route::resource('copies',CopiesController::class);
    Route::resource('books',BooklistController::class);
    Route::resource('borrow',borrowpage::class);
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/myPDF/{data}',[PDFController::class,'generatePDF'])->name('myPDF');
    Route::get('/book/{data}',[BooklistController::class,'get_book']);
    Route::get('/copy/{id}',[CopiesController::class,'get_copies']);
    Route::get('/student/{data}',[StudentlistController::class,'get_student']);
    Route::get('/generate-pdf/{data}', [PDFController::class, 'generatePDF']);
  
    //Route::get('/home',[ModelsBookList::class,'totalofcopies']);
    // Route::get('/borrowpage',[ModelsBookList::class,'studentborrow']);

    Route::post('/book/update',[BooklistController::class,'updatebooks'])->name('books.update-book');
    Route::post('/copy/update',[CopiesController::class,'updatecopies'])->name('books.update-copy');
    Route::post('/copy/negativeupdate',[CopiesController::class,'updatecopiesnegative'])->name('books.updatenegative-copy');
});
