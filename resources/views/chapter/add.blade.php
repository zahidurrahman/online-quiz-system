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

                        <form action="{{ route('store-chapter') }}" method="post">
                            @csrf

                            <?php
                            $subjects = DB::table('subjects')->where('teacher_id', Auth::user()->id)->get();
                            ?>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="form-control" id="subject" name="subject_id">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="chapterName">Chapter Name</label>
                                <input type="text" class="form-control" id="chapterName" name="chapter_name">
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
