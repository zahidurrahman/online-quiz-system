@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i>     </a>
                        <a title="Add Chapter" href="{{route('add-chapter')}}" class="close">+</a>
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
                        $chapters = DB::table('chapters')->where('subject_id', $subject_id)->where('teacher_id', Auth::user()->id)->get();
                        ?>

                        <ul class="list-group list-group-flush">
                            <?php foreach ($chapters as $chapter) { ?>
                            <a href="{{ route('questions', $chapter->id) }}">
                                <li class="list-group-item">{{$chapter->name}}
                                    <a style="float: right" href="/edit?id={{$chapter->id}} ">
                                        Edit
                                    </a>
                                </li>
                            </a>

                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
