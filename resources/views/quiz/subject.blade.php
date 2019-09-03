@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <fieldset>
                <legend>Summary
                    <a href="quiz" class="profile-edit">
                        <button type="button" class="btn btn-primary btn-md edit" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                    </a>
                </legend>
                <table class="table" >
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><p>{{$name}}</p></td>
                    </tr>
                    <tr>
                        <td>Catagory</td>
                        <td>:</td>
                        <td>
                            @if($data['catagory'] == "1")
                                <p>Multiple Choices</p>
                            @else
                                <p>True/False</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>:</td>
                        <td><p>{{$data['subject']}}</p></td>
                    </tr>
                    <tr>
                        <td>Number of Question</td>
                        <td>:</td>
                        <td><p>{{$data['quantity']}} Question</p></td>
                    </tr>
                </table>
            </fieldset>

            <h5>Avalaible Test</h5>
            <form method="POST" action="quiz/start">
                @csrf
                <ul class="list-group">
                @if(count($quizzes) > 0)
                    @foreach($quizzes as $index => $quiz)
                    <li>
                        <label class="radio">{{$quiz->title}} <small class="text-muted">Created by <i>{{$quiz->author->name}}</small></i>
                            <input type="hidden" name="name" value="{{$name}}">
                            @guest
                                <input type="hidden" name="status" value="{{$status}}">
                            @endguest
                            <input type="radio" id="quiz" name="quiz_id" value="{{$quiz->id}}" required onclick="enableButton()">
                            <span class="checkround"></span>
                        </label>
                    {{-- <a href="/quiz/{{$quiz->id}}/{{$name}}" class="list-group-item">{{$quiz->title}} by {{$quiz->author->name}}</a> --}}
                    </li>
                    @endforeach
                @else
                    <p>No avalable quiz</p>
                @endif
                </ul>
                
                <button type="submit" id="start" class="btn btn-primary no-padding margin-top" disabled>START</button>
            </form>

        </div>
    </div>
@endsection