<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProgressController extends Controller
{

    public function index()
    {
        $pageTitle = 'Progress';
        return view('progress.index', compact('pageTitle'));
    }

    public function add($student_id)
    {
        $pageTitle = 'Add Progress';
        return view('progress.add', compact('pageTitle','student_id'));
    }

    public function store(Request $request)
    {

        $teacher_id = $request->input('teacher_id');
        $student_id = $request->input('student_id');
        $month=date('F');
        $month=strtoupper($month);
        $date_today=date("d/m/Y");

        $comment= $request->input('comment');


        try {
            // insert to db
            DB::table('progress')->insert([
                'teacher_id' => $teacher_id,
                'student_id' => $student_id,
                'month' => $month,
                'dt' => $date_today,
                'comment' => $comment,
            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('add-progress')->with('success', $message);
        else
            return redirect()->route('add-progress')->with('error', $message);
    }


}
