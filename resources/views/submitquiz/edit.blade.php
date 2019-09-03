@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Quiz</strong></h1>
        </div>
        <form method="post" action="/submitquiz/{{$quiz_detail->id}}/update" id="post">
                @csrf
                @if ($errors->any())
                        <div class="alert alert-danger">
                                <ul>
                                        @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                        @endforeach
                                </ul>
                        </div>
                @endif

                <fieldset>
                    <legend>Quiz Detail</legend>
                    <table class="table" >
                        <tr>
                            <td>Catagory</td>
                            <td>:</td>
                            <td><p>{{$quiz_detail->catagory}}</p></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td>:</td>
                            <td><p>{{$quiz_detail->subject}}</p></td>
                        </tr>
                        <tr>
                            <td>Number of Question</td>
                            <td>:</td>
                            <td><p>{{$quiz_detail->quantity}} Question</p></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>:</td>
                            <td><input type="text" name="title" class="form-control" value="{{ $quiz_detail->title }}" required autofocus></td>
                        </tr>
                    </table>
                </fieldset>

                @foreach($q1 as $quiz)
                <div class="form-row">
                        <div class="form-group col-md-12">
                                <label>Question {{$loop->index +1}}</label>
                                <input type="text" name="q[]" class="form-control" value="{{ $quiz['question'] }}" required autofocus>
                        </div>
                        @if($quiz_detail->catagory == "Multiple Choices")
                                <div class="form-row with-padding">
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op1[]" class="form-control" value="{{ $quiz['op1'] }}" required autofocus>
                                                <label class="padding-left">Option 1</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op2[]" class="form-control" value="{{ $quiz['op2'] }}" required autofocus>
                                                <label class="padding-left">Option 2</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op3[]" class="form-control" value="{{ $quiz['op3'] }}" required autofocus>
                                                <label class="padding-left">Option 3</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op4[]" class="form-control" value="{{ $quiz['op4'] }}" required autofocus>
                                                <label class="padding-left">Option 4</label>
                                                <span class="focus-border"></span>
                                        </div>
                                </div>
                                <div class="form-group col-md-12">
                                        <label>Answer</label>
                                        <select class="form-control" name="answer[]" required>
                                                <option value="0" disabled selected>Select Answer</option>
                                                <option value="op1" {{$quiz["answer"] == 'op1' ? 'selected' : ''}}>Option 1</option>
                                                <option value="op2" {{$quiz["answer"] == 'op2' ? 'selected' : ''}}>Option 2</option>
                                                <option value="op3" {{$quiz["answer"] == 'op3' ? 'selected' : ''}}>Option 3</option>
                                                <option value="op4" {{$quiz["answer"] == 'op4' ? 'selected' : ''}}>Option 4</option>
                                        </select>
                                </div>
                        @else
                                <div class="form-group col-md-12">
                                        <label>Answer</label>
                                        <select class="form-control" name="answer[]" required>
                                                <option value="0" disabled selected>Select Answer</option>
                                                <option value="true" {{$quiz["answer"] == 'true' ? 'selected' : ''}}>True</option>
                                                <option value="false" {{$quiz["answer"] == 'false' ? 'selected' : ''}}>False</option>
                                        </select>
                                </div>
                        @endif
                        <div class="form-group col-md-12">
                                <label>Explenation <small class="text-muted">(<i>Optional</i>)</small></label>
                                <textarea name="exp[]" rows="4" class="form-control" value="{{ old('exp[]') }}" autofocus></textarea>
                        </div>
                </div>
                <hr class="featurette-divider">
                @endforeach
                <div class="btn-group">
                        <input type="hidden" name="catagory" value="{{$quiz_detail->catagory}}">
                        <input type="hidden" name="author_id" value="{{$quiz_detail->author_id}}">
                        <input type="hidden" name="subject" value="{{$quiz_detail->subject}}">
                        <input type="hidden" name="quantity" value="{{$quiz_detail->quantity}}">
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </form>

</main>
@endsection