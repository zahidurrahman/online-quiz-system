@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        {{$pageTitle}}
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('store-question') }}" method="post">
                            @csrf

                            <?php
                            $chapters = DB::table('chapters')->where('teacher_id', Auth::user()->id)->get();
                            ?>

                            <div class="form-group">
                                <label for="subject">Chapter</label>
                                <select class="form-control" id="subject" name="chapter_id">
                                    @foreach($chapters as $chapter)
                                        <option value="{{$chapter->id}}">{{$chapter->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="questionName">Question Name</label>
                                <input type="text" class="form-control" id="questionName" name="question_name" required>
                            </div>
                            <div class="form-group">
                                <label for="option_1">Answer 1</label>
                                <input type="text" class="form-control" id="option_1" name="option_1" required>
                            </div>
                            <div class="form-group">
                                <label for="option_2">Answer 2</label>
                                <input type="text" class="form-control" id="option_2" name="option_2" required>
                            </div>
                            <div class="form-group">
                                <label for="option_3">Answer 3</label>
                                <input type="text" class="form-control" id="option_3" name="option_3" required>
                            </div>
                            <div class="form-group">
                                <label for="option_4">Answer 4</label>
                                <input type="text" class="form-control" id="option_4" name="option_4" required>
                            </div>
                            <div class="form-group">
                                <label for="correct_option">Correct Answer</label>
                                <select class="form-control" id="correct_option" name="correct_option" required>
                                    <option disabled selected value="">--Select--</option>
                                    <option value='option_1'>Answer 1</option>
                                    <option value='option_2'>Answer 2</option>
                                    <option value='option_3'>Answer 3</option>
                                    <option value='option_4'>Answer 4</option>
                                </select>
                            </div>

                            <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">

                            <br>
                            <button type="submit" class="btn btn-primary"
                                    name="submit">Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
