<?php

namespace App\Http\Controllers;

use App\Models\StudentAccount;
use App\Models\StudentDetails;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Account_SettingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = StudentDetails::where('is_removed', false)->orderBy('last_name');

        if (!empty($search)) {

            $query = StudentAccount::where('student_number', $search)->value('student_id');
            // dd($query);
            $query = StudentDetails::where('id', $query);
        }
        $account = $query->paginate(50);

        return view('settings.account', compact('account'));
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Add validation rules for other input fields
            ]);

            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            } else {
                $imageName = null;
            }


            $student = new studentlist;
            $student->studentno = $request->input('qr_code');
            $student->name = $request->input('name');
            $student->middle = $request->input('middle_name');
            $student->lastname = $request->input('last_name');
            $student->class = $request->input('designation');
            $student->studimg = $imageName;

            $student->save();

            return back();
        } catch (\Exception $e) {
            // Handle the exception
            return back()->with('error', 'An error occurred while storing the student data.');
        }
    }
}
