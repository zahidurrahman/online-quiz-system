@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i> </a>
                        {{--<a title="Add Question" href="{{route('add-question')}}" class="close">+</a>--}}
                        {{$pageTitle}}
                    </div>

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="countdown text-danger text-center"></div>

                        <form id="quizForm" action="{{ route('generate-result') }}" method="post">
                            @csrf

                            <?php
                            $questions = DB::table('questions')->where('chapter_id', $chapter_id)->get();
                            $total_questions = DB::table('questions')->where('chapter_id', $chapter_id)->count();
                            $counter = 1;
                            ?>

                            <?php foreach($questions as $question) {
                            $options = DB::table('options')->where('question_id', $question->id)->get();
                            ?>
                            {{$counter}}. {{$question->name}}

                            <div style="margin-left: 20px;">
                                <?php
                                $option_counter = 1;
                                foreach($options as $option) { ?>

                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                           id="option_{{$option->id}}_{{$option_counter}}" value="option_1">
                                    <label class="custom-control-label"
                                           for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_1}}</label>
                                </div>
                                <?php $option_counter++ ?>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                           id="option_{{$option->id}}_{{$option_counter}}" value="option_2">
                                    <label class="custom-control-label"
                                           for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_2}}</label>
                                </div>
                                <?php $option_counter++ ?>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                           id="option_{{$option->id}}_{{$option_counter}}" value="option_3">
                                    <label class="custom-control-label"
                                           for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_3}}</label>
                                </div>
                                <?php $option_counter++ ?>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="question_{{$question->id}}"
                                           id="option_{{$option->id}}_{{$option_counter}}" value="option_4">
                                    <label class="custom-control-label"
                                           for="option_{{$option->id}}_{{$option_counter}}">{{$option->option_4}}</label>
                                </div>

                                <?php $option_counter++; } ?>
                            </div>
                            <?php $counter++;  } ?>

                            <input type="hidden" name="student_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="chapter_id" value="{{$chapter_id}}">
                            <input type="hidden" name="total_questions" value="{{$total_questions}}">

                            <br>
                            <button type="submit" class="btn btn-primary"
                                    name="btnSubmit">Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var timer2 = "00:05";
    var interval = setInterval(function () {

        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;

        if (minutes === -1) {
            document.getElementById("quizForm").submit();
        } else {
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }

    }, 1000);
</script>
