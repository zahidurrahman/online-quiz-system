@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url('select-teacher')}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i>     </a>
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
                        $subjects = DB::table('subjects')->where('teacher_id', $teacher_id)->get();
                        ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($subjects as $subject) { ?>
                            <li class="list-group-item">
                                <a href="{{ url('select-chapter') }}/{{$teacher_id}}/sub/{{$subject->id}}">{{$subject->name}}</a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
