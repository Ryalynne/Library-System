<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Account_SettingController extends Controller
{
    public function index()
    {

        // $account = studentlist::where('ishide', false)->paginate(10);
        $account = StudentDetails::where('is_removed', false)->orderBy('last_name')->paginate(20);
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
                $imageName = null; // Set the default value if no image is uploaded
            }

            // Create a new instance of the StudentList model and set the attributes
            $student = new studentlist;
            $student->studentno = $request->input('qr_code');
            $student->name = $request->input('name');
            $student->middle = $request->input('middle_name');
            $student->lastname = $request->input('last_name');
            $student->class = $request->input('designation');
            $student->studimg = $imageName; // Store the image filename in the database

            // Save the student record in the database
            $student->save();

            return back();
        } catch (\Exception $e) {
            // Handle the exception
            return back()->with('error', 'An error occurred while storing the student data.');
        }
        // Redirect or return a response
    }
}
