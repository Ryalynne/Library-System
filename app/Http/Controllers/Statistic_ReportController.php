<?php

namespace App\Http\Controllers;

use App\Models\borrowpage;
use Illuminate\Support\Facades\Request;

class Statistic_ReportController extends Controller
{
    function index(Request $request)
    {
        // Define the start and end dates for the month you want to analyze
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Initialize the array to store counts for each day in the month
        $onlendCounts = [];

        // Loop through each day of the month
        for ($day = $startDate; $day <= $endDate; $day->addDay()) {
            // Check if the current day is a weekday (Monday to Friday)
            if ($day->isWeekday()) {
                // Calculate the count for 'onlend' records for the current day
                $count = borrowpage::where('bookstatus', 'returned')
                    ->whereDate('created_at', $day->toDateString())
                    ->count();

                // Store the count in the $onlendCounts array with the date as the key
                $onlendCounts[$day->toDateString()] = $count;
            }
        }

        // Now $onlendCounts should contain counts for 'onlend' records for each weekday in the entire month

        return view("statistic.summary_for_books", compact('onlendCounts'));
    }
}
