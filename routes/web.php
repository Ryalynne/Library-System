<?php

use App\Http\Controllers\accountController;
use App\Http\Controllers\adjustmentcontroller;
use App\Http\Controllers\archivedcontroller;
use App\Http\Controllers\backorderController;
use App\Http\Controllers\badorderController;
use App\Http\Controllers\Bookhistory;
use App\Http\Controllers\BooklistController;
use App\Http\Controllers\borrowpage;
use App\Http\Controllers\cancelhistoryController;
use App\Http\Controllers\CopiesController;
use App\Http\Controllers\finebookshistory;
use App\Http\Controllers\finedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\onlendcontroller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\pendingpurchaseController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\receivehistoryController;
use App\Http\Controllers\receivepurchaseorderController;
use App\Http\Controllers\returnhistory;
use App\Http\Controllers\Returnpage;
use App\Http\Controllers\StudentlistController;
use App\Http\Controllers\userController;
use App\Http\Controllers\vendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('copies', CopiesController::class);
    Route::resource('books', BooklistController::class);
    Route::resource('borrow', borrowpage::class);

    Route::get('/cancelhistory', [cancelhistoryController::class, 'index']);
    Route::get('/receivehistory', [receivehistoryController::class, 'index']);
    Route::get('/account', [accountController::class, 'index']);
    Route::get('/badorder', [badorderController::class, 'index']);
    Route::get('/backorder', [backorderController::class, 'index']);
    Route::get('/receivepurchaseorder', [receivepurchaseorderController::class, 'index']);
    Route::get('/usermanual', function () {
        return view('usermanual');
    });
    Route::get('/purchasepending', [pendingpurchaseController::class, 'index']);
    Route::get('/getcopy/{id}', [BooklistController::class, 'getnumber']);
    Route::get('/vendormanagement', [vendorController::class, 'index']);
    Route::get('/setting', [userController::class, 'index']);
    Route::get('/bookaquired', [CopiesController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/fined', [finedController::class, 'index'])->name('fined');
    Route::get('/finedhistory', [finebookshistory::class, 'index'])->name('finedhistory');
    Route::get('/booklist', [BooklistController::class, 'index'])->name('booklist');;
    Route::get('/returnpage', [Returnpage::class, 'index'])->name('returnpage');
    Route::get('/purchase', [purchaseController::class, 'index'])->name('purchase');
    Route::get('/borrowpage', [borrowpage::class, 'index'])->name('borrowpage');
    Route::get('/bookhistory', [Bookhistory::class, 'index'])->name('bookhistory');
    Route::get('/adjustmenthistory', [adjustmentcontroller::class, 'index'])->name('adjustmenthistory');
    Route::get('/onlendhistory', [onlendcontroller::class, 'index'])->name('onlendhistory');
    Route::get('/returnhistory', [returnhistory::class, 'index'])->name('returnhistory');
    Route::get('/archivedhistory', [archivedcontroller::class, 'index'])->name('archivedhistory');
    Route::get('/myPDF/{data}', [PDFController::class, 'generatePDF'])->name('myPDF');


    Route::get('/transactionBO/{id}', [badorderController::class, 'get_transaction']);
    Route::get('/transactionB/{id}', [backorderController::class, 'get_transaction']);
    Route::get('/transaction/{id}', [receivepurchaseorderController::class, 'get_transaction']);

    Route::get('/getid/{studentno}', [StudentlistController::class, 'get_student']);
    Route::get('/bookstatus/{data}/{studentid}', [BooklistController::class, 'get_status']);
    Route::get('/book/{id}', [BooklistController::class, 'get_book']);
    Route::get('/bookarchived/{id}', [BooklistController::class, 'get_bookarchived']);
    Route::get('/bookcopies/{id}', [BooklistController::class, 'get_bookcopies']);
    Route::get('/vendor/{id}', [vendorController::class, 'get_vendor']);
    Route::get('/copy/{id}', [CopiesController::class, 'get_copies']);

    Route::get('/generate-badorder/{bookid}/{quantity}', [PDFController::class, 'generateBadorder']);
    Route::get('/generate-pdf/{data}', [PDFController::class, 'generatePDF']);
    Route::get('/generate-table', [PDFController::class, 'generateReports']);
    Route::get('/generate-action', [PDFController::class, 'generateAction']);
    Route::get('/generate-tblcopies', [PDFController::class, 'generateCopies']);
    Route::get('/generate-tblborrow/{id}/{studentid}', [PDFController::class, 'generateBorrow']);
    Route::get('/generate-tblreturn/{bookData}/{studentid}', [PDFController::class, 'generateReturn']);
    Route::get('/generate-tbladjustment', [PDFController::class, 'generateAdjustment']);
    Route::get('/generate-tblonlend', [PDFController::class, 'generateOnlend']);
    Route::get('/generate-tblreturnhistory', [PDFController::class, 'generatereturnhistory']);
    Route::get('/generate-tblreturndamage/{bookData}/{studentid}', [PDFController::class, 'generatereturndamage']);
    Route::get('/generate-tblfinehistory', [PDFController::class, 'generatefinehistory']);
    Route::get('/generatepuchaseorder/{id}/{booktitle}', [PDFController::class, 'generatePurchaseOrder']);
    //dito
    Route::put('update-received-quantity/{id}', [receivepurchaseorderController::class, 'updateReceivedQuantity'])->name('update-received-quantity');
    Route::put('update-received-quantityB/{id}', [backorderController::class, 'updateReceivedQuantity'])->name('update-received-quantityB');

    //
    // web.php or api.php
    Route::get('/gettransaction/{id}', [pendingpurchaseController::class, 'findtransaction']);
    Route::get('/order', [pendingpurchaseController::class, 'redirectToOrder'])->name('order.direct');
    Route::post('/cancelOrder', [pendingpurchaseController::class, 'cancelOrder'])->name('cancelOrder');

    Route::post('/registeraccount', [accountController::class, 'store'])->name('register.account');
    Route::post('/create/purchase', [purchaseController::class, 'createpurchaseOrder']);
    Route::post('/createvendor', [vendorController::class, 'create'])->name('vendor.create');
    Route::post('/test', [booklistcontroller::class, 'test']);
    Route::post('/removevendor/{id}', [vendorController::class, 'updateremove'])->name('removeVendor.update');
    Route::post('/removebook/{id}', [BooklistController::class, 'updateremove'])->name('removeBook.update');
    Route::post('/removearchived/{id}', [BooklistController::class, 'updateback'])->name('removeArchived.update');
    Route::post('/return/book', [Returnpage::class, 'update']);
    Route::post('/returndamage/book', [finedController::class, 'store']);
    Route::post('/book/borrow', [borrowpage::class, 'storebookborrow']);
    Route::post('/updateuser', [userController::class, 'update'])->name('updateuser');
    Route::post('/book/update', [BooklistController::class, 'updatebooks'])->name('books.update-book');
    Route::post('/copy/update', [CopiesController::class, 'updatecopies'])->name('books.update-copy');
    Route::post('/copy/negativeupdate', [CopiesController::class, 'updatecopiesnegative'])->name('books.updatenegative-copy');
});
