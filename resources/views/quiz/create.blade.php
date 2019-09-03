@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-4 py-5 bg-primary text-white text-center ">
            <div class=" ">
                <div class="card-body">
                    <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                    <h2 class="py-3">Have challenging Quiz to share?</h2>
                    <p>need desc here!.</p>
                    <br>
                    <section class="portfolio-experiment">
                        <a href="submitquiz">
                            <span class="text">Submit</span>
                            <span class="line -right"></span>
                            <span class="line -top"></span>
                            <span class="line -left"></span>
                            <span class="line -bottom"></span>
                        </a>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-8 py-5 border">
            <div id="loadbar" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <a href="#" class="intro-banner-vdo-play-btn pinkBg" target="_blank">
                                    <i class="glyphicon glyphicon-play whiteText" aria-hidden="true"></i>
                                    <span class="ripple pinkBg"></span>
                                    <span class="ripple pinkBg"></span>
                                    <span class="ripple pinkBg"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="pb-4">Choose your test?</h4>
            @include('include.flash')
            <form method="POST" action="/subject">
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

                <div class="form-row" id="preparing_quiz">
                <div class="form-group col-md-12">
                    @if(Auth::user())
                        <label for="name" class="col-4 col-form-label">Your Name</label>
                        <input type="text" id="name" class="form-control" value="{{Auth::user()->name}}" disabled>
                        <input type="hidden" name="name" value="{{Auth::user()->name}}">
                    @else
                        <label for="name" class="col-4 col-form-label">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    @endif
                </div>
                    
                <div class="form-group col-md-12">    
                    <label for="inputState" class="col-4 col-form-label">Catagory</label>
                    <select id="inputState" class="form-control" name="catagory" required>
                        <option value="0" disabled selected>Choose ...</option>
                        <option value="1"> Multiple choices</option>
                        <option value="2"> True/False</option>
                    </select>

                    {{-- @error('catagory')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                </div>
                
                <div class="form-group col-md-12">
                    <label for="opts1" class="col-4 col-form-label">Subject</label>
                    <select id="opts1" class="form-control" name="subject" required>
                        <option value="0" disabled selected>Select Option</option>
                        <option value="English">English</option>
                        <option value="Math">Math</option>
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <label for="opts2" class="col-4 col-form-label">Quantity</label>
                    <select id="opts2" class="form-control" name="quantity" required>
                        <option value="0" disabled selected>Select Option</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                </div>
                
                <div class="form-row">
                    <button id="submit" type="submit" class="btn btn-primary">Start</button>
                </div>
            </form>
        </div>
    </div>
@endsection