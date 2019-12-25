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
                        $students = DB::table('students_of_parents')->where('parent_id', Auth::user()->id)->get();
                        ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($students as $student) {
                            $student_info = DB::table('users')->where('id', $student->student_id)->first();
                            ?>
                            <li class="list-group-item">
                                <a href="{{ url('results') }}/{{$student_info->id}}">{{$student_info->name}}</a>
                                <a style="float:right" href="{{ url('view-progress') }}/{{$student_info->id}}">View Progress</a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
