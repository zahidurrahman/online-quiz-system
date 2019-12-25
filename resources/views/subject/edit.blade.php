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
                            //get the subject name for id
                                $id=$_GET["id"];
                                $subject=DB::table("subjects")->select("name")->where('id',$id)->first();
                                if($subject!=null){
                                    $subject_name=$subject->name;
                                }

                        ?>
                        <form action="{{ route('update-subject') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="subjectName">Subject Name</label>
                                <input type="text" class="form-control" id="subjectName" name="subject_name" value="{{$subject_name}}">
                            </div>

                            <input type="hidden" name="id" value="{{$id}}">

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
