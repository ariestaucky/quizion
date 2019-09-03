@extends('layouts.app')

@section('content')
    <div class="modal-header">
        <h1>Title : {{$quiz->quiz->title}}</h1>
    </div>

    <div class="modal-body">
        <fieldset>
            <legend>Detail Info
            </legend>
            <table class="table" >
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>
                        <p>{{$name}}</p>
                    </td>
                </tr>
                <tr>
                    <td>Catagory</td>
                    <td>:</td>
                    <td><p>{{$quiz->quiz->catagory}}</p></td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td>:</td>
                    <td><p>{{$quiz->quiz->subject}}</p></td>
                </tr>
                <tr>
                    <td>Number of Question</td>
                    <td>:</td>
                    <td><p>{{$quiz->quiz->quantity}} Question</p></td>
                </tr>
            </table>
        </fieldset>
        <div class="card">
            @php($score = 0)
            @foreach($quiz_answer as $answer) 
                @if($datas["q_answer$loop->index"] == $answer['answer'])
                    <div class="card-header">
                        <h4>Question {{$loop->index + 1}}</h4>
                    </div>

                    <div class="card-body">
                        <div class="question">
                            <p>{{$answer['question']}}</p>
                        </div>
                        <div class="answer">
                            <h3>Your answer :</h3>
                            @if($datas["q_answer$loop->index"] == "null")
                                <h5 class="ml-4">Not answered</h5>
                            @else
                                @if($quiz->quiz->catagory == 1)
                                    <h5 class="ml-4">{{$answer[$datas["q_answer$loop->index"]]}}</h5>
                                @else
                                    <h5 class="ml-4">{{$answer['answer']}}</h5>
                                @endif
                            @endif
                        </div>
                        <div class="answer">
                            <h3 class="text-success"><i class="fa fa-check-circle-o hijau"></i> CORRECT!</h3> 
                            <h5>
                                @if($answer['exp'] == '')
                                    No Explanation
                                @else
                                    {{$answer['exp']}}
                                @endif
                            </h5> 
                        </div> 
                        @php($score++)
                        <br>
                    </div>
                @else
                    <div class="card-header">
                        <h4>Question {{$loop->index + 1}}</h4>
                    </div>

                    <div class="card-body">    
                        <div class="question">
                            <p>{{$answer['question']}}</p>
                        </div>
                        <div class="answer">
                            <h3>Your answer :</h3>
                            @if($datas["q_answer$loop->index"] == "null")
                                <h5 class="ml-4">Not answered</h5>
                            @else
                                @if($quiz->quiz->catagory == 1)
                                    <h5 class="ml-4">{{$answer[$datas["q_answer$loop->index"]]}}</h5>
                                @else
                                    <h5 class="ml-4">{{$answer['answer']}}</h5>
                                @endif
                            @endif
                        </div>
                        <div class="answer">
                            <h3 class="text-danger"><i class="fa fa-times-circle-o merah"></i> WRONG!</h3> 
                            <h5>
                                @if($answer['exp'] == '')
                                    No Explanation
                                @else
                                    {{$answer['exp']}}
                                @endif
                            </h5> 
                        </div>             
                        <br>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="text-muted">
        <div class="row">
            <div class="col col-sm-4">
                <div class="row">
                    <h3 class="mr-4">RESULT </h3>
                    <h3>
                        @if($score == count($quiz_answer))
                            <strong class="text-success">PERFECT</strong>
                        @elseif($score < count($quiz_answer) || $score > 1)
                            <strong class="text-primary">GOOD JOB</strong>
                        @elseif ($score == 1)
                            <strong class="text-danger">BETTER NEXT TIME</strong>
                        @else
                            <strong class="text-danger">ARE YOU REALLY TRYING?</strong>
                        @endif
                    </h3>
                </div>
            </div>
            <div class="col col-sm-8">
                <div class="row right">
                    <form method="POST" action="/quiz/retry">
                        @csrf
                        @guest
                            <input type="hidden" name="status" value="{{$status}}">
                        @endguest
                        <input type="hidden" name="quiz_id" value="{{$quiz->quiz_id}}">
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="score" value="{{$score}}">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-undo" aria-hidden="true"></i> Retry</button>
                    </form>
                    
                    <form method="POST" action="/quiz/save" class="margin-left">
                        @csrf
                        @guest
                            <input type="hidden" name="status" value="{{$status}}">
                        @endguest
                        <input type="hidden" name="quiz_id" value="{{$quiz->quiz_id}}">
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="score" value="{{$score}}">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check" aria-hidden="true"></i></i> Satisfied</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection