<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class QuizController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {

    }

    public function show(Request $request) 
    {
        $name = $request->name;
        $quiz_detail = Question::detail($request->quiz_id)->first();
        
        foreach ($quiz_detail as $index => $quiz) {
            $q1 = $quiz_detail['question'];
        }

        // $perPage = 1;
        // $current_page = LengthAwarePaginator::resolveCurrentPage();
        // $orders_collection = new Collection($q1); 
        // $current_page_orders = array_slice($q1, ($current_page - 1) * $perPage, $perPage);
        // $orders_to_show = new LengthAwarePaginator($current_page_orders, count($orders_collection), $perPage);
        // $order_to_show = $orders_to_show->withPath($id)->links();
        // dd($request->all());
        if(auth()->check()) {
            return view('quiz.show', compact('quiz_detail', 'q1', 'name'));           
        } else {
            $status = $request->status;
            return view('quiz.show', compact('quiz_detail', 'q1', 'name', 'status'));
        }
    }

    public function subject(Request $request)
    {
        $name = $request->name;
        $NameArray = explode(' ',$name);
        $fname = $NameArray[0];

        $data = $request->validate([
            'name' => 'required|max:20',
            'catagory' => 'required',
            'subject' => 'required',
            'quantity' => 'required',
        ]);
        $quizzes = Quiz::detail($request)->get();

        // dd($fname, $quizzes, $quiz->title);
        
        if(auth()->check()) {
            return view('quiz.subject', compact('data', 'name', 'quizzes'));           
        } else {
            $status = "tester_".trim(strtolower($fname)).time().'-'.mt_rand(0, 100);
            return view('quiz.subject', compact('data', 'name', 'quizzes', 'status')); 
        }
    }
    
    public function result(Request $request, $id, $name)
    {
        $datas = $request->all();
        $quiz = Question::que($id)->first(); 

        foreach($quiz as $index => $kuis) {
            $quiz_answer = $quiz['question'];
        }

        if(auth()->check()) {
            return view('quiz.result', compact('datas', 'quiz_answer', 'quiz', 'name'));
        } else {
            $status = $request->status;
            return view('quiz.result', compact('datas', 'quiz_answer', 'quiz', 'name', 'status'));
        }                  
    }
}