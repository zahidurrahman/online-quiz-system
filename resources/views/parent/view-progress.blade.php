@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="/home"><i class="fa fa-arrow-left" style="margin-right: 10px"></i> </a>
                        <a title="Add Subject" href="{{route('add-subject')}}" class="close">+</a>
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
                            $student_info = DB::table('progress')->where('student_id', $student_id)->get();
                            ?>
                        <ul class="list-group list-group-flush">

                            <?php foreach ($student_info as $student) { ?>
                            <li class="list-group-item">
                                <?php
                                $teacher_info = DB::table('users')->where('id', $student->teacher_id)->first();
                                $teacher_name = $teacher_info->name;
                                ?>
                                <span>Teacher Name - {{$teacher_info->name}}</span><br>
                                 <span>Month - {{$student->month}}</span><br>
                                 <span>Comment - {{$student->comment}}</span><br>
                                  <span>Issued Date - {{$student->dt}}</span><br>

                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
