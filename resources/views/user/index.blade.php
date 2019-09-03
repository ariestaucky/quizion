@extends('layouts.app')

@section('content') 
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        
        <div class="row placeholders my-4 w-100">
            <div class="col-xs-6 col-sm-4 placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                <h4>Your Quiz</h4>
                <span class="text-muted">{{count($quiz)}} Quizzes</span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                <h4>Quiz Taken</h4>
                <span class="text-muted">{{count($quiz_taken)}} Quizzes</span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                <h4>People Try Your Quiz</h4>
                <span class="text-muted">{{count($try_quiz)}} People</span>
            </div>
        </div>

        <h2>Activity Report</h2>
        <div class="row my-4 w-100">
            <div class="col-xs-6 col-sm-6">
                <h3>Your Test Performance</h3>
                <div class="table-responsive placeholders">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th rowspan="2">Subject</th>
                                <th rowspan="2">Title</th>
                                <th rowspan="2">Date</th>
                                <th colspan="3">Score</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>1st</th>
                                <th>2st</th>
                                <th>3st</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz_taken as $t)
                            <tr>
                                <td>{{$t->quiz->subject}}</td>
                                <td>{{$t->quiz->title}}</td>
                                <td>{{$t->updated_at->diffforHumans()}}</td>
                                <td>{{$t->score}}</td>
                                <td>{{$t->score1}}</td>
                                <td>{{$t->score2}}</td>
                                <td>
                                    @if($t->attemp == 2)
                                        <a href="#" class="text-muted">Out of Retry</a>
                                    @else
                                        <form action="quiz/start" method="post">
                                            @csrf
                                            <input type="hidden" name="name" value="{{$user->name}}">
                                            <input type="hidden" name="quiz_id" value="{{$t->quiz->id}}">
                                            <button type="submit" class="btn btn-primary no-padding">Retry</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6">
                <h3>Your Quiz Performance</h3>
                <div class="table-responsive placeholders">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th rowspan="2">Subject</th>
                                <th rowspan="2">Title</th>
                                <th rowspan="2">Test Taker</th>
                                <th colspan="3">Score</th>
                                <th rowspan="2">Date</th>
                            </tr>
                            <tr>
                                <th>1st</th>
                                <th>2st</th>
                                <th>3st</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($try_quiz as $try)
                                <tr>
                                    <td>{{$try->subject}}</td>
                                    <td>{{$try->title}}</td>
                                    <td>{{$try->name}}</td>
                                    <td>{{$try->score}}</td>
                                    <td>{{$try->score1}}</td>
                                    <td>{{$try->score2}}</td>
                                    <td>{{Carbon\Carbon::parse($try->date)->diffforHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
