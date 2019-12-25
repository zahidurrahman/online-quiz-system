@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i> </a>
                        {{$pageTitle}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <?php
                        $chapter_id = Session::get('chapter_id');
                        $user_selected_answers = Session::get('user_selected_answers');
                        ?>

                        <span class="text-danger">Total Marks:</span> <strong>{{Session::get('total_marks')}}</strong><br><br>

                        <?php
                        $questions = DB::table('questions')->where('chapter_id', $chapter_id)->get();
                        $counter = 1;
                        $answer_index = 0;
                        ?>

                        <?php foreach($questions as $question) {
                        $options = DB::table('options')->where('question_id', $question->id)->get();
                        ?>
                        {{$counter}}. {{$question->name}}

                        <div style="margin-left: 20px;">
                            <?php
                            $option_counter = 0;
                            foreach($options as $option) { ?>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_1"
                                       @if($user_selected_answers[$answer_index] == "option_1") checked
                                       @else disabled @endif >
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_1}} </label>
                            </div>
                            @if($option->correct_option == "option_1") <?php $correct_answer = $option->option_1; ?> @endif

                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_2"
                                       @if($user_selected_answers[$answer_index] == "option_2") checked
                                       @else disabled @endif >
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_2}}</label>
                            </div>
                            @if($option->correct_option == "option_2") <?php $correct_answer = $option->option_2; ?> @endif

                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_3"
                                       @if($user_selected_answers[$answer_index] == "option_3") checked
                                       @else disabled @endif >
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_3}}</label>
                            </div>
                            @if($option->correct_option == "option_3") <?php $correct_answer = $option->option_3; ?> @endif

                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_4"
                                       @if($user_selected_answers[$answer_index] == "option_4") checked
                                       @else disabled @endif >
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_4}}</label>
                            </div>
                            @if($option->correct_option == "option_4") <?php $correct_answer = $option->option_4; ?> @endif

                            <span class="text-success">Correct Answer:</span> {{$correct_answer}}

                            <?php $option_counter++; } ?>
                        </div>
                        <?php $counter++; $answer_index++;  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
