<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;

class QuestionController extends Controller
{
    public function index($chapter_id)
    {
        $pageTitle = 'Questions';
        return view('question.index', compact('pageTitle', 'chapter_id'));
    }

    public function add()
    {
        $pageTitle = 'Add Question';
        return view('question.add', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $chapter_id = $request->input('chapter_id');
        $question_name = $request->input('question_name');
        $option_1 = $request->input('option_1');
        $option_2 = $request->input('option_2');
        $option_3 = $request->input('option_3');
        $option_4 = $request->input('option_4');
        $correct_option = $request->input('correct_option');

        try {
            // add question
            $question_id = DB::table('questions')->insertGetId([
                'chapter_id' => $chapter_id,
                'name' => $question_name,
            ]);

            // add options
            DB::table('options')->insert([
                'question_id' => $question_id,
                'option_1' => $option_1,
                'option_2' => $option_2,
                'option_3' => $option_3,
                'option_4' => $option_4,
                'correct_option' => $correct_option,
            ]);

            $success = true;
            $message = "Successfully Inserted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('questions', $chapter_id)->with('success', $message);
        else
            return redirect()->route('questions', $chapter_id)->with('error', $message);
    }

    public function delete($question_id, $chapter_id)
    {
        try {
            // delete question and answers
            DB::table('questions')->delete($question_id);
            DB::table('options')->where('question_id', $question_id)->delete();

            $success = true;
            $message = "Successfully Deleted";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // return response
        if ($success)
            return redirect()->route('questions', $chapter_id)->with('success', $message);
        else
            return redirect()->route('questions', $chapter_id)->with('error', $message);
    }
}
