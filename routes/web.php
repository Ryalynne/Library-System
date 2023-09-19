<?php

use App\Http\Controllers\accountController;
use App\Http\Controllers\adjustmentcontroller;
use App\Http\Controllers\archivedcontroller;
use App\Http\Controllers\backorderController;
use App\Http\Controllers\badorderController;
use App\Http\Controllers\Bookhistory;
use App\Http\Controllers\Booklist_Controller;
use App\Http\Controllers\Borrow_Controller;
use App\Http\Controllers\cancelhistoryController;
use App\Http\Controllers\CopiesController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\finebookshistory;
use App\Http\Controllers\finedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\onlendcontroller;
use App\Http\Controllers\PDF_Controller;
use App\Http\Controllers\pendingpurchaseController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\receivehistoryController;
use App\Http\Controllers\receivepurchaseorderController;
use App\Http\Controllers\returnhistory;
use App\Http\Controllers\Return_Controller;
use App\Http\Controllers\StudentlistController;
use App\Http\Controllers\userController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\statisticReports;
use App\Http\Controllers\subjectController;
use App\Models\StudentDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('copies', CopiesController::class);
    Route::resource('books', Booklist_Controller::class);
    Route::resource('borrow', Borrow_Controller::class);
    Route::get('/department', [departmentController::class, 'index']);
    Route::get('/subject', [subjectController::class, 'index']);
    Route::get('/cancelhistory', [cancelhistoryController::class, 'index']);
    Route::get('/receivehistory', [receivehistoryController::class, 'index']);
    Route::get('/account', [accountController::class, 'index']);
    Route::get('/badorder', [badorderController::class, 'index']);
    Route::get('/backorder', [backorderController::class, 'index']);
    Route::get('/receivepurchaseorder', [receivepurchaseorderController::class, 'index']);
    Route::get('/purchasepending', [pendingpurchaseController::class, 'index']);
    Route::get('/vendormanagement', [vendorController::class, 'index']);
    Route::get('/bookadjustment', [CopiesController::class, 'index']);
    Route::get('/setting', [userController::class, 'index']);
    Route::get('/getcopy/{id}', [Booklist_Controller::class, 'getnumber']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/fined', [finedController::class, 'index']);
    Route::get('/finedhistory', [finebookshistory::class, 'index'])->name('finedhistory');
    Route::get('/booklist', [Booklist_Controller::class, 'index'])->name('booklist');;
    Route::get('/returnpage', [Return_Controller::class, 'index'])->name('returnpage');
    Route::get('/purchase', [purchaseController::class, 'index'])->name('purchase');
    Route::get('/borrowpage', [Borrow_Controller::class, 'index']);
    Route::get('/bookhistory', [Bookhistory::class, 'index'])->name('bookhistory');
    Route::get('/adjustmenthistory', [adjustmentcontroller::class, 'index'])->name('adjustmenthistory');
    Route::get('/onlendhistory', [onlendcontroller::class, 'index'])->name('onlendhistory');
    Route::get('/returnhistory', [returnhistory::class, 'index'])->name('returnhistory');
    Route::get('/archivedhistory', [archivedcontroller::class, 'index'])->name('archivedhistory');
    Route::get('/statisticReports', [statisticReports::class, 'index']);
    Route::get('/student-details', function () {
        return StudentDetails::all();
    });

    //transaction number
    Route::get('/transactionBO/{id}', [badorderController::class, 'get_transaction']);
    Route::get('/transactionB/{id}', [backorderController::class, 'get_transaction']);
    Route::get('/transaction/{id}', [receivepurchaseorderController::class, 'get_transaction']);

    //display search
    Route::get('/getid/{studentno}', [StudentlistController::class, 'get_student']);
    Route::get('/bookstatus/{bookid}/{borrower}', [Booklist_Controller::class, 'get_status']);
    Route::get('/book/{id}', [Booklist_Controller::class, 'get_book']);
    Route::get('/bookarchived/{id}', [Booklist_Controller::class, 'get_bookarchived']);
    Route::get('/bookcopies/{id}', [Booklist_Controller::class, 'get_bookcopies']);
    Route::get('/vendor/{id}', [vendorController::class, 'get_vendor']);
    Route::get('/copy/{id}', [CopiesController::class, 'get_copies']);


    //pdf print
    Route::get('/generate-badorder/{bookid}/{quantity}', [PDF_Controller::class, 'generateBadorder']);
    Route::get('/generate-pdf/{data}', [PDF_Controller::class, 'generatePDF']);
    Route::get('/generate-table', [PDF_Controller::class, 'booklist_pdf']);
    Route::get('/generate-action', [PDF_Controller::class, 'generateAction']);
    Route::get('/generate-tblcopies', [PDF_Controller::class, 'generateCopies']);
    Route::get('/generate-tblborrow/{id}/{studentid}', [PDF_Controller::class, 'generateBorrow']);
    Route::get('/generate-tblreturn/{bookData}/{studentid}', [PDF_Controller::class, 'generateReturn']);
    Route::get('/generate-tbladjustment', [PDF_Controller::class, 'generateAdjustment']);
    Route::get('/generate-tblonlend', [PDF_Controller::class, 'generateOnlend']);
    Route::get('/generate-tblreturnhistory', [PDF_Controller::class, 'generatereturnhistory']);
    Route::get('/generate-tblreturndamage/{bookData}/{studentid}', [PDF_Controller::class, 'generatereturndamage']);
    Route::get('/generate-tblfinehistory', [PDF_Controller::class, 'generatefinehistory']);
    Route::get('/generatepuchaseorder/{id}/{booktitle}', [PDF_Controller::class, 'generatePurchaseOrder']);
    Route::get('/myPDF/{data}', [PDF_Controller::class, 'generatePDF'])->name('myPDF');
    Route::get('/Print_QRList', [PDF_Controller::class, 'bulkprint']);
    //dito
    Route::put('update-received-quantity/{id}', [receivepurchaseorderController::class, 'updateReceivedQuantity'])->name('update-received-quantity');
    Route::put('update-received-quantityB/{id}', [backorderController::class, 'updateReceivedQuantity'])->name('update-received-quantityB');

    //

    Route::get('/gettransaction/{id}', [pendingpurchaseController::class, 'findtransaction']);
    Route::get('/order', [pendingpurchaseController::class, 'redirectToOrder'])->name('order.direct');
    Route::post('/cancelOrder', [pendingpurchaseController::class, 'cancelOrder'])->name('cancelOrder');


    Route::post('/registeraccount', [accountController::class, 'store'])->name('register.account');
    Route::post('/create/purchase', [purchaseController::class, 'createpurchaseOrder']);
    Route::post('/createvendor', [vendorController::class, 'create'])->name('vendor.create');
    Route::post('/removevendor/{id}', [vendorController::class, 'updateremove'])->name('removeVendor.update');
    Route::post('/removebook/{id}', [Booklist_Controller::class, 'updateremove'])->name('removeBook.update');
    Route::post('/removearchived/{id}', [Booklist_Controller::class, 'updateback'])->name('removeArchived.update');
    Route::post('/return/book', [Return_Controller::class, 'update']);
    Route::post('/returndamage/book', [finedController::class, 'store']);
    Route::post('/book/borrow', [Borrow_Controller::class, 'storebookborrow']);
    Route::post('/updateuser', [userController::class, 'update'])->name('updateuser');
    Route::post('/book/update', [Booklist_Controller::class, 'updatebooks'])->name('books.update-book');
    Route::post('/copy/update', [CopiesController::class, 'updatecopies'])->name('books.update-copy');
    Route::post('/copy/negativeupdate', [CopiesController::class, 'updatecopiesnegative'])->name('books.updatenegative-copy');
   
    Route::post('/import', [Booklist_Controller::class , 'import'])->name('import');
  
});
