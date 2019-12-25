<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Redirect;

class TeacherController extends Controller
{

    public function viewResults()
    {
        $pageTitle = 'View Results';
        return view('teacher.view-results', compact('pageTitle'));
    }
}
