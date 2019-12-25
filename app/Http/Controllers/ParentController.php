<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;

class ParentController extends Controller
{

    public function viewResults()
    {
        $pageTitle = 'View Results';
        return view('parent.view-results', compact('pageTitle'));
    }

    public function viewProgress($student_id)
    {
        $pageTitle = 'View Progress';
        return view('parent.view-progress', compact('pageTitle','student_id'));
    }

    public function addStudent()
    {
        $pageTitle = 'Add Student';
        return view('parent.add', compact('pageTitle'));
    }

    public function store(Request $request)
    {

        $parent_id = $request->input('parent_id');
        $student_id = $request->input('student_id');
        try {
            // insert to db
            DB::table('students_of_parents')->insert([
                'parent_id' => $parent_id,
                'student_id' => $student_id,

            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('home')->with('success', $message);
        else
            return redirect()->route('home')->with('error', $message);
    }


}
