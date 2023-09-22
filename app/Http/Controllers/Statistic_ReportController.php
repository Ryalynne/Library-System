<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Statistic_ReportController extends Controller
{
    function index(){
        return view("history.statistic_Reports");
    }
}
