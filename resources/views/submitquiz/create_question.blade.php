@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Create Question</h1>
        </div>
        <form method="POST" action="/submitquiz/save" id="post">
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
                @for($x=0; $x < $data['quantity']; $x++)
                <div class="form-row">
                        <div class="form-group col-md-12">
                                <label>Question {{$x +1}}</label>
                                <input type="text" name="q[]" class="form-control" value="{{ old('q[]') }}" required autofocus>
                        </div>
                        @if($data['catagory'] == "1")
                                <div class="form-row with-padding">
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op1[]" class="form-control" value="{{ old('op1[]') }}" required autofocus>
                                                <label class="padding-left">Option 1</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op2[]" class="form-control" value="{{ old('op2[]') }}" required autofocus>
                                                <label class="padding-left">Option 2</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op3[]" class="form-control" value="{{ old('op3[]') }}" required autofocus>
                                                <label class="padding-left">Option 3</label>
                                                <span class="focus-border"></span>
                                        </div>
                                        <div class="col-md-12 input-effect form-group">
                                                <input class="effect-16" type="text" placeholder="" name="op4[]" class="form-control" value="{{ old('op4[]') }}" required autofocus>
                                                <label class="padding-left">Option 4</label>
                                                <span class="focus-border"></span>
                                        </div>
                                </div>
                                <div class="form-group col-md-12">
                                        <label>Answer</label>
                                        <select class="form-control" name="answer[]" required>
                                                <option value="0" disabled selected>Select Answer</option>
                                                <option value="op1">Option 1</option>
                                                <option value="op2">Option 2</option>
                                                <option value="op3">Option 3</option>
                                                <option value="op4">Option 4</option>
                                        </select>
                                </div>
                        @else
                                <div class="form-group col-md-12">
                                        <label>Answer</label>
                                        <select class="form-control" name="answer[]" required>
                                                <option value="0" disabled selected>Select Answer</option>
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                        </select>
                                </div>
                        @endif
                        <div class="form-group col-md-12">
                                <label>Explenation <small class="text-muted">(<i>Optional</i>)</small></label>
                                <textarea name="exp[]" rows="4" class="form-control" value="{{ old('exp[]') }}" autofocus></textarea>
                        </div>
                </div>
                <hr class="featurette-divider">
                @endfor
                <div class="btn-group">
                        <input type="hidden" name="catagory" value="{{$data['catagory']}}">
                        <input type="hidden" name="author_id" value="{{$data['author_id']}}">
                        <input type="hidden" name="subject" value="{{$data['subject']}}">
                        <input type="hidden" name="title" value="{{$data['title']}}">
                        <input type="hidden" name="quantity" value="{{$data['quantity']}}">
                        <button type="submit" class="btn btn-primary">Create</button>
                </div>
        </form>
</main>
@endsection