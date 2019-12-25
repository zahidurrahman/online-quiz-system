<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
{
    public function index()
    {
        $pageTitle = 'Subject';
        return view('subject.index', compact('pageTitle'));
    }

    public function add()
    {
        $pageTitle = 'Add Subject';
        return view('subject.add', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $teacher_id = $request->input('teacher_id');
        $subject_name = $request->input('subject_name');

        try {
            // insert to db
            DB::table('subjects')->insert([
                'teacher_id' => $teacher_id,
                'name' => $subject_name,
            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('subjects')->with('success', $message);
        else
            return redirect()->route('subjects')->with('error', $message);
    }

    public function edit()
    {
        $pageTitle = 'Edit Subject';
        return view('subject.edit', compact('pageTitle'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $subject_name = $request->input('subject_name');

        try {
            // insert to db
            DB::table('subjects')->where('id',$id)->update([
                'name' => $subject_name,
            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('subjects')->with('success', $message);
        else
            return redirect()->route('subjects')->with('error', $message);
    }
}
