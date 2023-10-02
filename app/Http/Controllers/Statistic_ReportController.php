<?php

namespace App\Http\Controllers;

use App\Models\borrowpage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Statistic_ReportController extends Controller
{
    // function index(Request $request)
    // {

    //     $startDate = now()->startOfMonth();
    //     $endDate = now()->endOfMonth();

    //     $onlendCounts = [];

    //     for ($day = $startDate; $day <= $endDate; $day->addDay()) {
    //         if ($day->isWeekday()) {
    //             $count = borrowpage::whereDate('created_at', $day->toDateString())
    //                 ->count();

    //             $onlendCounts[$day->toDateString()] = $count;
    //         }
    //     }

    //     $startDate = now()->startOfMonth();
    //     $endDate = now()->endOfMonth();

    //     $returnedCounts = [];

    //     for ($day = $startDate; $day <= $endDate; $day->addDay()) {
    //         if ($day->isWeekday()) {
    //             $count = borrowpage::where('bookstatus', 'returned')
    //                 ->whereDate('created_at', $day->toDateString())
    //                 ->count();

    //             $returnedCounts[$day->toDateString()] = $count;
    //         }
    //     }



    //     return view("statistic.summary_for_books", compact('onlendCounts' ,'returnedCounts'));
    // }


    function index(Request $request)
    {
       
        $startingDate = $request->input('startingdate');
        $endDate =  $request->input('enddate');

   
        $startDate = Carbon::parse($startingDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();


        $onlendCounts = [];
        $returnedCounts = [];

       
        for ($day = $startDate; $day->lte($endDate); $day->addDay()) {
            if ($day->isWeekday()) {

                $count = borrowpage::whereDate('created_at', $day->toDateString())
                    ->count();

                $onlendCounts[$day->toDateString()] = $count;

                $count1 = borrowpage::where('bookstatus', 'returned')
                    ->whereDate('updated_at', $day->toDateString())
                    ->count();

                $returnedCounts[$day->toDateString()] = $count1;
            }
        }

        return view("statistic.summary_for_books", compact('onlendCounts', 'returnedCounts'));
    }
}
