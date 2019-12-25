<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('subjects', 'SubjectController@index')->name('subjects');
Route::group(['prefix' => 'subjects'], function () {
    Route::get('add', 'SubjectController@add')->name('add-subject');
    Route::post('store', 'SubjectController@store')->name('store-subject');
    Route::get('edit', 'SubjectController@edit')->name('edit-subject');
    Route::post('update', 'SubjectController@update')->name('update-subject');
});

Route::get('chapters/{subject_id}', 'ChapterController@index')->name('chapters');

Route::group(['prefix' => 'chapter'], function () {
    Route::get('add', 'ChapterController@add')->name('add-chapter');
    Route::post('store', 'ChapterController@store')->name('store-chapter');

});

//update chapter name
Route::get('edit', 'ChapterController@edit')->name('edit-chapter');
Route::post('update', 'ChapterController@update')->name('update-chapter');

Route::get('questions/{chapter_id}', 'QuestionController@index')->name('questions');
Route::group(['prefix' => 'question'], function () {
    Route::get('add', 'QuestionController@add')->name('add-question');
    Route::post('store', 'QuestionController@store')->name('store-question');
    Route::get('delete/{question_id}/chapter/{chapter_id}', 'QuestionController@delete')->name('delete-question');
});

// student routes
Route::get('select-teacher', 'StudentController@selectTeacher')->name('select-teacher');
Route::get('select-subject/{teacher_id}', 'StudentController@selectSubject')->name('select-subject');
Route::get('select-chapter/{teacher_id}/sub/{subject_id}', 'StudentController@selectChapter')->name('select-chapter');
Route::get('do-quiz/{chapter_id}', 'StudentController@doQuiz')->name('do-quiz');

// results routes
Route::post('generate-result', 'ResultsController@generateResults')->name('generate-result');
Route::get('view-result', 'ResultsController@viewResult')->name('view-result');
Route::get('results/{student_id}', 'ResultsController@results')->name('results');
Route::get('view-specific-result/{result_id}', 'ResultsController@viewSpecificResult')->name('view-specific-result');

// teacher routes
Route::group(['prefix' => 'teacher'], function () {
    Route::get('view-results', 'TeacherController@viewResults')->name('add-progress');
});

// parent routes
Route::group(['prefix' => 'parent'], function () {
    Route::get('view-results', 'ParentController@viewResults');
    Route::get('add', 'ParentController@addStudent')->name('student-add');
    Route::post('add', 'ParentController@store')->name('store-student');

});

//progress
Route::get('progress/{student_id}', 'ProgressController@add')->name('progress');
Route::post('progress/store', 'ProgressController@store')->name('store-progress');

Route::get('view-progress/{student_id}', 'ParentController@viewProgress')->name('view-progress');
