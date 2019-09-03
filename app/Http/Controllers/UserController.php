<?php

namespace App\Http\Controllers;

use App\User;
use App\Quiz;
use App\Test_taker;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $quiz = Quiz::list($user->id);
        $quiz_taken = Test_taker::taken($user->id)->get();
        $try_quiz = Test_taker::people($user->id)->get(25);
 
        // dd($quiz);

        return view('user.index', compact('user', 'quiz', 'quiz_taken', 'try_quiz'));
    }

    public function show($id)
    {
        $user = User::findorFail($id)->first();
        
        return view('user.show', compact('user'));
    }
}
