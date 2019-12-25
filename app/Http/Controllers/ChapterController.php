<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ChapterController extends Controller
{
    public function index($subject_id)
    {
        $pageTitle = 'Chapters';
        return view('chapter.index', compact('pageTitle', 'subject_id'));
    }

    public function add()
    {
        $pageTitle = 'Add Chapter';
        return view('chapter.add', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $teacher_id = $request->input('teacher_id');
        $chapter_name = $request->input('chapter_name');

        try {
            // insert to db
            DB::table('chapters')->insert([
                'subject_id' => $subject_id,
                'teacher_id' => $teacher_id,
                'name' => $chapter_name,
            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('chapters', $subject_id)->with('success', $message);
        else
            return redirect()->route('chapters', $subject_id)->with('error', $message);
    }


    public function edit()
    {
        $pageTitle = 'Edit Chapter';
        return view('chapter.edit', compact('pageTitle'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $chapter_name = $request->input('chapter_name');

        try {
            // insert to db
            DB::table('chapters')->where('id',$id)->update([
                'name' => $chapter_name,
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
