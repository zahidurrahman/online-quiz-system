@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="margin-right: 10px"></i>     </a>
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
//                                $student_id=$_GET['id'];
                         ?>
                        <form action="{{ route('store-progress') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="option_1">Comment</label>
                                <textarea type="text" class="form-control" id="option_1" name="comment" required>
                                </textarea>
                            </div>
                            <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="student_id" value="{{$student_id}}">

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
