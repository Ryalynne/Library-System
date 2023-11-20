<?php

use App\Http\Controllers\Account_SettingController;
use App\Http\Controllers\Adjustment_HistoryController;
use App\Http\Controllers\Archived_HistoryController;
use App\Http\Controllers\Back_OrderController;
use App\Http\Controllers\Bad_OrderController;
use App\Http\Controllers\Action_HistoryController;
use App\Http\Controllers\Booklist_Controller;
use App\Http\Controllers\Borrow_Controller;
use App\Http\Controllers\Cancel_PurchaseOrder_historyController;
use App\Http\Controllers\Book_InventoryController;
use App\Http\Controllers\Add_DepartmentController;
use App\Http\Controllers\Lost_DamageHistoryController;
use App\Http\Controllers\Lost_damage_Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Onlend_HistoryController;
use App\Http\Controllers\PDF_Controller;
use App\Http\Controllers\Pending_PurchaseController;
use App\Http\Controllers\Purchase_Controller;
use App\Http\Controllers\Receive_PuchaseOrder_historyController;
use App\Http\Controllers\Receive_PurchaseOrderController;
use App\Http\Controllers\Return_HistoryController;
use App\Http\Controllers\Return_Controller;
use App\Http\Controllers\StudentlistController;
use App\Http\Controllers\userController;
use App\Http\Controllers\Vendor_ListController;
use App\Http\Controllers\Statistic_ReportController;
use App\Http\Controllers\Add_SubjectController;
use App\Http\Controllers\EbookController;
use App\Models\StudentDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('copies', Book_InventoryController::class);
    Route::resource('books', Booklist_Controller::class);
    Route::resource('borrow', Borrow_Controller::class);
    Route::get('/ebook', [EbookController::class, 'index']);
    Route::get('/statistic-summary', [Statistic_ReportController::class, 'index'])->name('statistic-summary');
    Route::get('/department', [Add_DepartmentController::class, 'index']);
    Route::get('/subject', [Add_SubjectController::class, 'index']);
    Route::get('/cancelhistory', [Cancel_PurchaseOrder_historyController::class, 'index']);
    Route::get('/receivehistory', [Receive_PuchaseOrder_historyController::class, 'index']);
    Route::get('/account', [Account_SettingController::class, 'index']);
    Route::get('/badorder', [Bad_OrderController::class, 'index']);
    Route::get('/backorder', [Back_OrderController::class, 'index']);
    Route::get('/receivepurchaseorder', [Receive_PurchaseOrderController::class, 'index']);
    Route::get('/purchasepending', [Pending_PurchaseController::class, 'index']);
    Route::get('/vendormanagement', [Vendor_ListController::class, 'index']);
    Route::get('/bookadjustment', [Book_InventoryController::class, 'index']);
    Route::get('/setting', [userController::class, 'index']);
    Route::get('/getcopy/{id}', [Booklist_Controller::class, 'getnumber']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/fined', [Lost_damage_Controller::class, 'index']);
    Route::get('/finedhistory', [Lost_DamageHistoryController::class, 'index'])->name('finedhistory');
    Route::get('/booklist', [Booklist_Controller::class, 'index'])->name('booklist');;
    Route::get('/returnpage', [Return_Controller::class, 'index'])->name('returnpage');
    Route::get('/purchase', [Purchase_Controller::class, 'index'])->name('purchase');
    Route::get('/borrowpage', [Borrow_Controller::class, 'index']);
    Route::get('/bookhistory', [Action_HistoryController::class, 'index'])->name('bookhistory');
    Route::get('/adjustmenthistory', [Adjustment_HistoryController::class, 'index'])->name('adjustmenthistory');
    Route::get('/onlendhistory', [Onlend_HistoryController::class, 'index'])->name('onlendhistory');
    Route::get('/returnhistory', [Return_HistoryController::class, 'index'])->name('returnhistory');
    Route::get('/archivedhistory', [Archived_HistoryController::class, 'index'])->name('archivedhistory');
    Route::get('/statisticReports', [Statistic_ReportController::class, 'index']);
    Route::get('/student-details', function () {
        return StudentDetails::all();
    });
    Route::get('/fetch-data', [Borrow_Controller::class, 'fetchData']);
    Route::get('/get-user/{id}/{user}', [Borrow_Controller::class, 'get_user']);
    Route::get('/get-book', [Borrow_Controller::class, 'fetchBook']);
    //transaction number
    Route::get('/transactionBO/{id}', [Bad_OrderController::class, 'get_transaction']);
    Route::get('/transactionB/{id}', [Back_OrderController::class, 'get_transaction']);
    Route::get('/transaction/{id}', [Receive_PurchaseOrderController::class, 'get_transaction']);

    //display search
    Route::get('/getid/{studentno}', [StudentlistController::class, 'get_student']);
    Route::get('/bookstatus/{bookid}/{borrower}', [Booklist_Controller::class, 'get_status']);
    Route::get('/book/{id}', [Booklist_Controller::class, 'get_book']);
    Route::get('/bookarchived/{id}', [Booklist_Controller::class, 'get_bookarchived']);
    Route::get('/bookcopies/{id}', [Booklist_Controller::class, 'get_bookcopies']);
    Route::get('/vendor/{id}', [Vendor_ListController::class, 'get_vendor']);
    Route::get('/copy/{id}', [Book_InventoryController::class, 'get_copies']);
    Route::get('/findDepsub/{depid}/{subid}', [Booklist_Controller::class, 'get_depsub']);

    //pdf print

    Route::get('/generate-statistic', [PDF_Controller::class, 'print_statistic']);
    Route::get('/generate-statisticR', [PDF_Controller::class, 'print_statisticR']);

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
    Route::put('update-received-quantity/{id}', [Receive_PurchaseOrderController::class, 'updateReceivedQuantity'])->name('update-received-quantity');
    Route::put('update-received-quantityB/{id}', [Back_OrderController::class, 'updateReceivedQuantity'])->name('update-received-quantityB');

    //

    Route::get('/gettransaction/{id}', [Pending_PurchaseController::class, 'findtransaction']);
    Route::get('/order', [Pending_PurchaseController::class, 'redirectToOrder'])->name('order.direct');
    Route::post('/cancelOrder', [Pending_PurchaseController::class, 'cancelOrder'])->name('cancelOrder');


    Route::post('/registeraccount', [Account_SettingController::class, 'store'])->name('register.account');
    Route::post('/create/purchase', [Purchase_Controller::class, 'createpurchaseOrder']);
    Route::post('/createvendor', [Vendor_ListController::class, 'create'])->name('vendor.create');
    Route::post('/removevendor/{id}', [Vendor_ListController::class, 'updateremove'])->name('removeVendor.update');
    Route::post('/removebook/{id}', [Booklist_Controller::class, 'updateremove'])->name('removeBook.update');
    Route::post('/removearchived/{id}', [Booklist_Controller::class, 'updateback'])->name('removeArchived.update');
    Route::post('/return/book', [Return_Controller::class, 'update']);
    Route::post('/returndamage/book', [Lost_damage_Controller::class, 'store']);
    Route::post('/book/borrow', [Borrow_Controller::class, 'storebookborrow']);
    Route::post('/updateuser', [userController::class, 'update'])->name('updateuser');
    Route::post('/book/update', [Booklist_Controller::class, 'updatebooks'])->name('books.update-book');
    Route::post('/copy/update', [Book_InventoryController::class, 'updatecopies'])->name('books.update-copy');
    Route::post('/copy/negativeupdate', [Book_InventoryController::class, 'updatecopiesnegative'])->name('books.updatenegative-copy');
    Route::post('/import', [Booklist_Controller::class, 'import'])->name('import');
    Route::post('/add/department', [Add_DepartmentController::class, 'store']);
    Route::post('/add/subject', [Add_SubjectController::class, 'store']);

    Route::post('/importEbooks', [EbookController::class, 'importEbooks'])->name('importEbooks');


    Route::get('users-export', [Booklist_Controller::class, 'export'])->name('users.export');

});
