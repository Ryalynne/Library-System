<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class departmentController extends Controller
{
    //
    function index(){
        return view('department');
    }
}
