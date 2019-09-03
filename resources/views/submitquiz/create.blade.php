@extends('layouts.app')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="row ">
    <div class="col-md-10 py-5">
      <h4 class="pb-4">What kind of test is it?</h4>
      <form method="POST" action="submitquiz/next">
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
        <div class="form-row">
          <label for="cat" class="col-4 col-form-label">Catagory</label> 
          <div class="form-group col-md-12">    
            <select id="cat" class="form-control" name="catagory" required onchange="showForm()">
              <option value="0" disabled>Choose ...</option>
              <option value="1"> Multiple choices</option>
              <option value="2"> True/False</option>
            </select>
          </div>

          <label for="sub" class="col-4 col-form-label">Subject</label>
          <div id="sub" class="form-group col-md-12">
            <select class="form-control" name="subject" required>
                <option value="0" disabled>Select Option</option>
                <option value="General Knowladge">General Knowladge</option>
                <option value="Social">Social</option>
                <option value="Science">Science</option>
                <option value="Indonesian">Indonesian</option>
                <option value="English">English</option>
                <option value="Math">Math</option>
                <option value="History">History</option>
                <option value="Religion">Religion</option>
                <option value="Technology">Technology</option>
            </select>
          </div>
          
          <label for="q" class="col-4 col-form-label">Question</label>
          <div id="q" class="form-group col-md-12">
            <select class="form-control" name="quantity" required>
                <option value="0" disabled>Select Option</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
          </div>

          <div class="form-group col-md-12">
            <label for="title" class="col-4 col-form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
          </div>
        </div>
          
        <div class="form-row">
            <input type="hidden" name="author_id" value="{{auth()->user()->id}}">
            <button id="submit" type="submit" class="btn btn-primary btn-lg">Create</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection