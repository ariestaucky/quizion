@extends('layouts.app')

@section('content')
    <form method="post" action="/quiz/{{$quiz_detail->quiz_id}}/{{$name}}/result" id="post">
    @csrf
    
        <div class="modal-header">
            <div class="row">
                <div class="col-md-12">
                    <h1><strong>{{$quiz_detail->title}}</strong></h1>
                </div>
                <div class="col-md-12">
                    <p class="no-padding">Created By <i>{{$quiz_detail->quiz->author->name}}</i></p>
                </div>
            </div>   
        </div>


        <div class="modal-body">
            <div class="quiz-container">
                <div class="col-xs-3 col-xs-offset-5">
                    <div id="loadbar" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <a href="#" class="intro-banner-vdo-play-btn pinkBg" target="_blank">
                                            <i class="fa fa-cog fa-spin fa-3x fa-fw" aria-hidden="true"></i>
                                            <span class="ripple pinkBg"></span>
                                            <span class="ripple pinkBg"></span>
                                            <span class="ripple pinkBg"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="quiz">
                    @foreach ($q1 as $que)
                        <div class="slide">
                            <h3>Question {{$loop->index + 1}} :</h3>
                            <div class="question"> {{ $que['question'] }} </div>
                            @if($quiz_detail['catagory'] == 1)
                            <div class="quiz answers" data-toggle="buttons">
                                <input type="hidden" type="radio" name="q_answer{{ $option = $loop->index }}" value="null" class="opt" selected></label>
                                <label class="element-animation1 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="op1" class="opt">A. {{$que['op1']}}</label>
                                <label class="element-animation2 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="op2" class="opt">B. {{$que['op2']}}</label>
                                <label class="element-animation3 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="op3" class="opt">C. {{$que['op3']}}</label>
                                <label class="element-animation4 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="op4" class="opt">D. {{$que['op4']}}</label>
                            </div>
                            @else
                                <div class="quiz answers" id="quiz" data-toggle="buttons">
                                    <input type="hidden" type="radio" name="q_answer{{ $option = $loop->index }}" value="null" class="opt" selected></label>
                                    <label class="element-animation1 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="true" class="opt">True</label>
                                    <label class="element-animation2 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="fa fa-check"></i><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <input type="radio" name="q_answer{{ $option = $loop->index }}" value="false" class="opt">False</label>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="modal-footer text-muted block">
            <div class="row">
                <div class="col col-sm-4"></div>
                <div class="col col-sm-8 right">
                    @guest
                        <input type="hidden" name="status" value="{{$status}}">
                    @endguest
                    <button type="button" id="previous" class="btn btn-md" onclick="showPreviousSlide()"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous Question</button>
                    <button type="button" id="next" class="btn btn-primary btn-md" onclick="showNextSlide()">Next Question <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                    <button type="submit" id="submit" class="btn btn-success btn-md"><i class="fa fa-check-square-o" aria-hidden="true"></i> Submit Quiz</button>
                </div>
            </div>
        </div>
    </form>
@endsection