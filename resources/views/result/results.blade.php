@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="/home"><i class="fa fa-arrow-left" style="margin-right: 10px"></i> </a>
                        {{--<a title="Add Subject" href="{{route('add-subject')}}" class="close">+</a>--}}
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

                        <?php
                        $results = DB::table('results')->where('student_id', $student_id)->get();
                        ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($results as $result) {
                            $teacher = DB::table('users')->where('id', $result->teacher_id)->first();
                            $subject = DB::table('subjects')->where('id', $result->subject_id)->first();
                            $chapter = DB::table('chapters')->where('id', $result->chapter_id)->first();
                            $submission_time = date("d M, Y h:i A", strtotime($result->submission_time));
                            ?>
                            <li class="list-group-item">
                                <a href="{{ url('view-specific-result') }}/{{$result->id}}">{{$chapter->name}}</a> ({{$subject->name}} >> by {{$teacher->name}} >> at {{$submission_time}})

                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
