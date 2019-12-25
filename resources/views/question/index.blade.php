@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i> </a>
                        <a title="Add Question" href="{{route('add-question')}}" class="close">+</a>
                        {{$pageTitle}}
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <?php
                        $questions = DB::table('questions')->where('chapter_id', $chapter_id)->get();
                        $total_questions = DB::table('questions')->where('chapter_id', $chapter_id)->count();
                        $counter = 1;
                        ?>

                        <?php foreach($questions as $question) {
                        $options = DB::table('options')->where('question_id', $question->id)->get();
                        ?>
                        {{$counter}}. {{$question->name}} - <a title="Delete Question"
                                                               href="{{url('/')}}/question/delete/{{$question->id}}/chapter/{{$chapter_id}}">Delete</a>

                        <div style="margin-left: 20px;">
                            <?php
                            $option_counter = 1;
                            foreach($options as $option) { ?>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_1" disabled>
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_1}}</label>
                            </div>
                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_2" disabled>
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_2}}</label>
                            </div>
                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_3" disabled>
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_3}}</label>
                            </div>
                            <?php $option_counter++ ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                       id="option_{{$option->id}}_{{$option_counter}}" value="option_4" disabled>
                                <label class="custom-control-label"
                                       for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_4}}</label>
                            </div>

                            <?php $option_counter++; } ?>
                        </div>
                        <?php $counter++;  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
