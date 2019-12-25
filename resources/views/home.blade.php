@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                       Dashboard
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <ul class="list-group list-group-flush">
                            <?php
                              $role=Auth::user()->role;
                            ?>
                             @if ($role=='teacher')
                            <li class="list-group-item">
                                <a href="{{url('subjects')}}">Quiz Set-Up</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{url('teacher/view-results')}}">View Results</a>
                            </li>
                            @endif
                             @if ($role=='parent')
                              <li class="list-group-item">
                                 <a href="{{url('parent/add')}}">Add Student</a>
                               </li>
                              <li class="list-group-item">
                                  <a href="{{url('parent/view-results')}}">View Results</a>
                              </li>
                             @endif
                              @if ($role=='student')
                              <li class="list-group-item">
                                 <a href="{{url('select-teacher')}}">Do Quiz</a>
                               </li>
                              <li class="list-group-item">
                                  <a href="{{url('results')}}/{{Auth::user()->id}}">View Results</a>
                              </li>
                             @endif

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
