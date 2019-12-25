<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;

class StudentController extends Controller
{
    public function selectTeacher()
    {
        $pageTitle = 'Select Teacher';
        return view('student.select-teacher', compact('pageTitle'));
    }

    public function selectSubject($teacher_id)
    {
        $pageTitle = 'Select Subject';
        return view('student.select-subject', compact('pageTitle', 'teacher_id'));
    }

    public function selectChapter($teacher_id, $subject_id)
    {
        $pageTitle = 'Select Subject';
        return view('student.select-chapter', compact('pageTitle', 'teacher_id', 'subject_id'));
    }

    public function doQuiz($chapter_id)
    {
        $pageTitle = 'Do Quiz';
        return view('student.questions', compact('pageTitle', 'chapter_id'));
    }
}
