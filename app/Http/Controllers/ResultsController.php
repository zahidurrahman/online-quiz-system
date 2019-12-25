<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;

class ResultsController extends Controller
{
    public function viewResult()
    {
        $pageTitle = 'View Result';
        return view('result.view-result', compact('pageTitle'));
    }

    public function generateResults(Request $request)
    {
        $student_id = $request->input('student_id');
        $chapter_id = $request->input('chapter_id');

        $subject_info = DB::table('chapters')->where('id', $chapter_id)->first();
        $subject_id = $subject_info->subject_id;
        $teacher_id = $subject_info->teacher_id;
        $per_right_answer_marks = 1;
        $total_marks = 0;

        //duplicate quiz restrict
        $check_quiz = DB::table('results')->where('student_id', $student_id)->where('teacher_id', $teacher_id)
            ->where('subject_id',$subject_id)
            ->where('chapter_id',$chapter_id)
            ->first();
        if($check_quiz!=null){
            return redirect()->route('home')->with('error', 'Already Done quiz');
        }else{
            $user_selected_answers = array();
            $questions = DB::table('questions')->where('chapter_id', $chapter_id)->get();
            foreach ($questions as $question) {
                $user_selected_answer = $request->input('question_' . $question->id);
                array_push($user_selected_answers, $user_selected_answer);
            }

            $counter = 0;
            foreach ($questions as $question) {
                $options = DB::table('options')->where('question_id', $question->id)->get();
                foreach ($options as $option) {

                    if ($user_selected_answers[$counter] == $option->correct_option) {
                        $total_marks += $per_right_answer_marks;
                    }
                }
                echo "<br>";

                $counter++;
            }

            // store to db
            DB::table('results')->insert([
                'student_id' => $student_id,
                'teacher_id' => $teacher_id,
                'subject_id' => $subject_id,
                'chapter_id' => $chapter_id,
                'total_marks' => $total_marks,
                'answers' => json_encode($user_selected_answers),
            ]);

            return Redirect::route('view-result')->with(['chapter_id' => $chapter_id, 'total_marks' => $total_marks, 'user_selected_answers' => $user_selected_answers]);
        }


    }

    public function results($student_id)
    {
        $pageTitle = 'Results';
        return view('result.results', compact('pageTitle', 'student_id'));
    }

    public function viewSpecificResult($result_id)
    {
        $result_data = DB::table('results')->where('id', $result_id)->first();

        $total_marks = $result_data->total_marks;
        $user_selected_answers = $result_data->answers;
        $user_selected_answers = json_decode($user_selected_answers);

        return Redirect::route('view-result')->with(['chapter_id' => $result_data->chapter_id, 'total_marks' => $total_marks, 'user_selected_answers' => $user_selected_answers]);
    }
}
