@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="/home"><i class="fa fa-arrow-left" style="margin-right: 10px"></i>     </a>
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
                        $chapters = DB::table('chapters')->where('teacher_id', $teacher_id)->where('subject_id', $subject_id)->get();
                        ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($chapters as $chapter) { ?>
                            <li class="list-group-item">
                                <a href="{{ url('do-quiz') }}/{{$chapter->id}}">{{$chapter->name}}</a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
